<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifySpecFormRequest extends FormRequest
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
            'spec' => 'required|in:A,B,C,NOTHING'
        ];
    }

    // '(Mező.)szabály' => 'Egyéni üzenet'
    // A szabályokat angolul megtalálod itt: resources/lang/en/validation.php
    public function messages() {
        return [
            'required' => 'Ki kell választanod a specializációt!',
            'in:A,B,C,NOTHING' => 'Nem megfelelő érték!',
        ];
    }
}
