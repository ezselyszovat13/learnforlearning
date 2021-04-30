<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoCalculationFormRequest extends FormRequest
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
            'semester' => 'required|between:1,2'
        ];
    }

    // '(Mező.)szabály' => 'Egyéni üzenet'
    // A szabályokat angolul megtalálod itt: resources/lang/en/validation.php
    public function messages() {
        return [
            'required' => 'Meg kell adnod ezt az opciót!',
            'between:1,2' => 'Nem megfelelő érték!',
        ];
    }
}
