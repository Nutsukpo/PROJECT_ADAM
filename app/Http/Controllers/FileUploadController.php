<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Files;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function create()
    {
        return view('fileupload.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'files' => 'required|mimes:pdf,doc,docx,jpeg,png,jpg,gif|max:2048',
        ]);

        $uploadedFile = $request->file('file');
        $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
        $filePath = $uploadedFile->storeAs('uploads', $fileName, 'public');

        $files = Files::create([
            'file_name' => $fileName,
            'file_path' => '/storage/' . $filePath,
        ]);

        return redirect()->route('fileupload.show', $files->id)->with('success', 'File uploaded successfully.');
    }

    public function watch($id){
        //find user records with the id provided
        $files= employees::find($id);
        // return the edit.blade.php which is in the students folder and pass the data to it
        return view('employees.watch',['employee'=>$employee]);
    }

    public function index()
    {
        $files = Files::all();
        return view('fileupload.index', compact('files'));
    }
}
