<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Http\Services\FileUploadService;
use Illuminate\Http\Request;

class GameResultsUploadController extends Controller
{
    private $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Show a form to upload file with results
     * @param Request $request
     */
    public function show(Request $request)
    {
        return view('theme.file-upload-form');
    }

    public function uploadResults(FileUploadRequest $request)
    {
        $this->fileUploadService->uploadFile($request->result_file);
        return redirect()->to('dashboard')->with('message', 'Your file was uploaded.');
    }
}
