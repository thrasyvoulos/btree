<?php


namespace App\Http\Requests;


use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BtreeRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'file' =>  'required|mimes:txt|max:2048'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
