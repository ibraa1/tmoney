<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
        return [
            'montant' => 'required|numeric',
            'type' => 'required|in:transfert,retrait',
            'devise' => 'required|exists:devises,id',
            'date' => 'required',
            'remise' => 'nullable|numeric',
            'typeRemise' => 'required|in:aucun,pourcentage,valeur',
            'paysId' => 'required|exists:payss,id',
            'clientId' => 'required|exists:users,id',
            'receveurId' => 'required|exists:users,id',
            'commission' => 'nullable|numeric',
            'isChecked' => 'nullable',
        ];
    }
}
