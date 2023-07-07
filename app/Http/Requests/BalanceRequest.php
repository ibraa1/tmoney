<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BalanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $min = $this->input('min');
        $max = $this->input('max');
        return [
            'montantTotalComission' => 'required|numeric',
            'devise' => 'required|exists:devises,id',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'montant' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($min, $max) {
                    if ($value < $min || $value > $max) {
                        $fail("Le champ $attribute doit être compris entre $min et $max.");
                    }
                },
            ],
        ];
    }
}
