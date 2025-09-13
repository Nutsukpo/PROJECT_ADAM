<?php

namespace App\Http\Controllers;

use App\Models\memos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class MemosController extends Controller
{
    public function show(memos $memo)
    {
        $this->authorize('view', $memo);
        return view('memos.show', ['memo' => $memo]);
    }

    // Display a list of memos
    public function index()
    {
        $memos = Memos::all();
        return view('memos.index', ['memos' => $memos]);
    }

    // Show the form to create a new memo
    public function create()
    {
        return view('memos.create');
    }

    // Store a new memo in the database
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'to' => 'required|string',
            'from' => 'required|string',
            'date'=> 'required|string',
            'subject' => 'required|string',
            'body' => 'nullable|string',
            'amount' => 'nullable|numeric',
            'currency' => 'nullable|string|max:5',
            'items' => 'nullable|array',
            'status' => 'nullable|string|in:draft,validated,review,commit,authorize,approved,processed,disbursed,credited,finalize',
            'name_of_employee'=> 'required|string',
            'signature' => 'nullable|string' // base64 signature
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $memoData = [
            'to' => $data['to'],
            'from' => $data['from'],
            'date' => $data['date'],
            'subject' => $data['subject'],
            'body' => $data['body'] ?? null,
            'amount' => $data['amount'] ?? null,
            'currency' => $data['currency'] ?? 'GHS',
            'items' => isset($data['items']) ? json_encode($data['items']) : null,
            'status' => $data['status'] ?? 'draft',
            'name_of_employee' => $data['name_of_employee'],
            
        ];

        // Handle signature saving
        if (!empty($data['signature'])) {
            $image = str_replace('data:image/png;base64,', '', $data['signature']);
            $image = str_replace(' ', '+', $image);
            $imageName = time() . '_' . uniqid() . '.png';
            Storage::disk('public')->put('signatures/' . $imageName, base64_decode($image));
            $memoData['signature'] = 'signatures/' . $imageName;
        }

        Memos::create($memoData);

        return redirect()->intended('memos')->with('messages', 'Memo added successfully');
    }

    // Show the form to edit a memo
    public function edit($id)
    {
        $memo = Memos::findOrFail($id);
        return view('memos.edit', ['memo' => $memo]);
    }

    // Update an existing memo
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'to' => 'required|string',
            'from' => 'required|string',
            'date'=> 'required|string',
            'subject' => 'required|string',
            'body' => 'nullable|string',
            'amount' => 'nullable|numeric',
            'currency' => 'nullable|string|max:5',
            'items' => 'nullable|array',
            'status' => 'nullable|string|in:draft,validated,review,commit,authorized,approved,processed,disbursed,credited,finalize',
            'name_of_employee'=> 'required|string',
            'signature' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $memo = Memos::findOrFail($id);
        $memo->to = $data['to'];
        $memo->from = $data['from'];
        $memo->date = $data['date'];
        $memo->subject = $data['subject'];
        $memo->body = $data['body'];
        $memo->amount = $data['amount'];
        $memo->currency = $data['currency'] ?? 'GHS';
        $memo->items = isset($data['items']) ? json_encode($data['items']) : null;
        $memo->status = $data['status'] ?? $memo->status;
        $memo->name_of_employee= $data['name_of_employee'];

        // If new signature is provided, replace the old one
        if (!empty($data['signature'])) {
            // Optionally delete old signature file
            if ($memo->signature && Storage::disk('public')->exists($memo->signature)) {
                Storage::disk('public')->delete($memo->signature);
            }

            $image = str_replace('data:image/png;base64,', '', $data['signature']);
            $image = str_replace(' ', '+', $image);
            $imageName = time() . '_' . uniqid() . '.png';
            Storage::disk('public')->put('signatures/' . $imageName, base64_decode($image));
            $memo->signature = 'signatures/' . $imageName;
        }

        $memo->save();

        return redirect()->intended('memos')->with('messages','Memo updated successfully');
    }

    // Delete a memo
    public function delete($id){
        $memo = Memos::findOrFail($id);

        // Delete signature file if exists
        if ($memo->signature && Storage::disk('public')->exists($memo->signature)) {
            Storage::disk('public')->delete($memo->signature);
        }

        $memo->delete();
        return redirect()->intended('memos')->with('messages','Memo deleted successfully');
    }

    // View a single memo's details
    public function watch($id)
    {
        $memo = Memos::findOrFail($id);
        return view('memos.watch', ['memo' => $memo]);
    }


public function downloadPDF($id)
{
    $memo = Memos::findOrFail($id);

    $pdf = Pdf::loadView('memos.watch', compact('memo'))
              ->setPaper('A4', 'portrait');

    return $pdf->download("memo_{$memo->id}.pdf");
}

public function downloadWord($id)
{
    $memo = Memos::findOrFail($id);

    $phpWord = new PhpWord();
    $section = $phpWord->addSection();


    // Add letterhead image (make sure the path is correct)
    $letterHeadPath = public_path('img/LETTER HEAD.jpeg');
    if (file_exists($letterHeadPath)) {
        $section->addImage(
            $letterHeadPath,
            [
                'width' => 600,  // adjust size to fit page
                'height' => 100,
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
            ]
        );
    }

    $section->addText("TO: {$memo->to}");
    $section->addText("FROM: {$memo->from}");
    $section->addText("DATE: {$memo->date}");
    $section->addText("SUBJECT: {$memo->subject}");
    $section->addText(strip_tags($memo->body));
    // $section->addText(" {$memo->signature}");
    

    if ($memo->signature) {
        $signaturePath = public_path('storage/' . $memo->signature);
        if (file_exists($signaturePath)) {
            $section->addImage($signaturePath, ['width' => 150, 'height' => 50]);
        }
        $section->addText(" {$memo->name_of_employee}");
        $section->addText(" {$memo->from}");
    }

    $fileName = "memo_{$memo->id}.docx";
    $tempPath = storage_path($fileName);

    $writer = IOFactory::createWriter($phpWord, 'Word2007');
    $writer->save($tempPath);

    return response()->download($tempPath)->deleteFileAfterSend(true);
}

public function addMinutes(Request $request, $id)
{
    $request->validate([
        'minute_to' => 'required|string|max:255',
        'minutes' => 'required|string',
        'minute_date' => 'required|date',
        'minute_signature' => 'required|string', // base64 string
    ]);

    $memo = Memos::findOrFail($id);

    // Handle signature saving
    if ($request->minute_signature) {
        $image = $request->minute_signature; // data:image/png;base64,....
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = uniqid() . '.png';
        Storage::disk('public')->put('signatures/' . $imageName, base64_decode($image));
        $memo->minute_signature = 'signatures/' . $imageName;
    }

    // Save other fields
    $memo->minute_to = $request->minute_to;
    $memo->minutes = $request->minutes;
    $memo->minute_date = $request->minute_date;

    $memo->save();

    return redirect()->route('approvals.show', $memo->id)
                     ->with('success', 'Minutes added successfully.');
}

}
