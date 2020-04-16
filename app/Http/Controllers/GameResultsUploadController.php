<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameResultsUploadController extends Controller
{
    /**
     * Show a form to upload file with results
     * @param Request $request
     */
    public function show(Request $request)
    {
        return view('theme.file-upload-form');
    }

    public function uploadResults(Request $request)
    {
        // this does not need view
        return redirect()->to('dashboard');
    }
}
