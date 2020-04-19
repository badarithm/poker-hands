<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * File size should
     * @return array
     */
    public function rules()
    {
        return [
          'result_file' => 'required|file|max:512|mimes:txt'
        ];
    }
}
