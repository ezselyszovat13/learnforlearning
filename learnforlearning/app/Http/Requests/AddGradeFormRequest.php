<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddGradeFormRequest extends FormRequest
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
            'subject' => 'required',
            'grade' => 'required|numeric|between:1,5'
        ];
    }

    // '(Mező.)szabály' => 'Egyéni üzenet'
    // A szabályokat angolul megtalálod itt: resources/lang/en/validation.php
    public function messages() {
        return [
            'required' => 'Meg kell adnod ezt az opciót!',
            'between' => 'A megadott értéknek 1 és 5 között kell lennie!',
            'numeric' => 'Egy számot kell itt megadnod!'
        ];
    }
}
