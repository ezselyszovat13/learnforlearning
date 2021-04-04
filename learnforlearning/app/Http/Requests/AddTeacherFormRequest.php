<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTeacherFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Ezzel lehet tiltani a requestet
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Szabályok
        return [
            'tname' => 'required',
            'subject2' => 'required',
        ];
    }

    // '(Mező.)szabály' => 'Egyéni üzenet'
    // A szabályokat angolul megtalálod itt: resources/lang/en/validation.php
    public function messages() {
        return [
            'required' => 'Meg kell adnod ezt az opciót!',
        ];
    }
}
