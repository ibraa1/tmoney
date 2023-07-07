<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompenseRequest extends FormRequest
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
            'dateInitiation' => 'required',
            'montant' => 'required|numeric',
            'deviseId' => 'required|exists:devises,id',
            'type' => 'required|in:retraitBalance,commission,transfertBalance',
            'modePaiement' => 'required|in:autres,espèce,mobileMoney,transfert,balance',
        ];
    }
}
