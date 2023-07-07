<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user),
            ],
            'password' => [
                'nullable',
                'string',
                'min:12',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{12,}$/',
            ],
            'role' => 'required|in:agent,client,admin,superAdmin',
            'adresse' => 'required|string|max:255',
            'numero_tel' => 'required|string|max:255',
            'pays' => 'required|exists:payss,id',
            'ville' => 'required|exists:villes,id',
            'image' => 'nullable|image|mimes:jpeg,png,gif,jpg,heic|max:5120'
        ];
    }
}
