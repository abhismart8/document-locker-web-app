<?php

namespace App\Repositories;

use Log;
use Illuminate\Support\Str;
use App\Models\Upload;

class UploadRepository
{
    public function upload($request, $userId){
        $request->validate([
            'file' => 'required|mimes:pdf|max:20480',
        ]);
  
        $fileName = $request->file->getClientOriginalName();  
   
        $request->file->move(public_path('uploads'), $fileName);

        $path = 'uploads/'.$fileName;

        // uploading file in db
        $upload = Upload::create([
            'id' => Str::uuid()->toString(), 
            'user_id' => $userId, 
            'name' => $fileName,
            'path' => $path
        ]);
   
        return response()->json(['status' => 'success', 'data' => $upload->refresh(),
        'message' => 'File uploaded successfully']);
    }

    public function getUploads($userId, $sort=null){
        return Upload::users($userId)
        ->sorting($sort);
    }

    public function getUpload($id){
        return Upload::find($id);
    }
}
