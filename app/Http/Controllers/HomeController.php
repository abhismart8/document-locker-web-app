<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UploadRepository;

class HomeController extends Controller
{
    protected $uploadRepository;

    public function __construct(UploadRepository $uploadRepository){
        $this->uploadRepository = $uploadRepository;
    }

    public function index(Request $request)
    {
        $uploads = $this->uploadRepository->getUploads(Auth::user()->id, ['created_at', 'desc'])->get();

        return view('index', [
            'uploads' => $uploads
        ]);
    }
}
