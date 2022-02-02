<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UploadRepository;

class UploadController extends Controller
{
    protected $uploadRepository;

    public function __construct(UploadRepository $uploadRepository){
        $this->uploadRepository = $uploadRepository;
    }

    public function upload(Request $request)
    {
        return $this->uploadRepository->upload($request, Auth::user()->id??null);
    }
}
