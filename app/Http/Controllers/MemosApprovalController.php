<?php

namespace App\Http\Controllers;

use App\Models\Memos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemosApprovalController extends Controller
{
    public function index()
    {
        $statuses = Memos::STAGES;
        $memos = Memos::orderBy('date', 'desc')->paginate(10);

        return view('approvals.index', compact('statuses', 'memos'));
    }

    public function filterByStatus($status)
    {
        $statuses = Memos::STAGES;
        $memos = Memos::where('status', $status)
                      ->orderBy('date', 'desc')
                      ->paginate(10);

        return view('approvals.index', compact('statuses', 'memos', 'status'));
    }

    public function show(Memos $memo)
    {
        return view('approvals.show', compact('memo'));
    }

    public function moveToNextStage(Request $request, Memos $memo)
    {
        $currentStatus = $memo->status;
        $stages = Memos::STAGES;
        $currentIndex = array_search($currentStatus, $stages);
        
        if ($currentIndex < count($stages) - 1) {
            $memo->update(['status' => $stages[$currentIndex + 1]]);
            return redirect()->route('approvals.index')->with('success', 'Memo moved to next stage successfully');
        }
        
        return redirect()->route('approvals.index')->with('error', 'Memo is already at the final stage');
    }

    public function moveToPreviousStage(Request $request, Memos $memo)
    {
        $currentStatus = $memo->status;
        $stages = Memos::STAGES;
        $currentIndex = array_search($currentStatus, $stages);
        
        if ($currentIndex > 0) {
            $memo->update(['status' => $stages[$currentIndex - 1]]);
            return redirect()->route('approvals.index')->with('success', 'Memo moved to previous stage successfully');
        }
        
        return redirect()->route('approvals.index')->with('error', 'Memo is already at the first stage');
    }

    /**
     * Store Minutes + Signature
     */
    public function addMinutes(Request $request, Memos $memo)
    {
        $request->validate([
            'minute_to' => 'required|string|max:255',
            'minutes' => 'required|string',
            'signature' => 'required|string', // base64 string
            'date' => 'required|date',
        ]);

        $signaturePath = null;

        if ($request->signature) {
            // decode base64 signature
            $image = str_replace('data:image/png;base64,', '', $request->signature);
            $image = str_replace(' ', '+', $image);
            $imageName = 'signature_' . time() . '.png';

            // store in storage/app/public/signatures
            Storage::disk('public')->put('signatures/' . $imageName, base64_decode($image));

            $signaturePath = 'signatures/' . $imageName;
        }

        $memo->update([
            'minute_to' => $request->minute_to,
            'minutes' => $request->minutes,
            'minute_signature' => $signaturePath,
            'minute_date' => $request->date,
        ]);

        return response()->json(['success' => true]);
    }
}
