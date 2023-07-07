<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RetraitRequest extends FormRequest
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
            'transacId' => 'required|exists:transactions,id',
            'devise' => 'required|exists:devises,id',
            'date' => 'required',
            'paysId' => 'required|exists:payss,id',
            'code' => 'required',
            'clientId' => 'required|exists:users,id',
            'receveurId' => 'required|exists:users,id',
        ];
    }
}
