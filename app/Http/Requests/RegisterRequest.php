<?php

namespace App\Http\Requests;

use App\Domain\VOs\Cpf;
use App\Domain\VOs\Phone;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'size:11', 'unique:users,cpf'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'size:11'],
            'gender' => ['required', 'integer', 'exists:genders,id'],
            'blood_type' => ['required', 'integer', 'exists:blood_types,id'],
            'emergency_contact_name' => ['required', 'string', 'max:255'],
            'emergency_contact_phone' => ['required', 'string', 'size:11'],
            'allergies' => ['nullable', 'string', 'max:2000'],
            'medications' => ['nullable', 'string', 'max:2000'],
            'diseases' => ['nullable', 'string', 'max:2000'],
            'surgeries' => ['nullable', 'string', 'max:2000'],
            'password' => ['required', 'string', 'confirmed', 'min:6'],
            'public_password' => ['required', 'string', 'min:4'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'O nome é obrigatório.',
            'last_name.required' => 'O sobrenome é obrigatório.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.size' => 'O CPF deve ter 11 dígitos.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'email.required' => 'O email é obrigatório.',
            'email.unique' => 'Este email já está cadastrado.',
            'phone.required' => 'O telefone é obrigatório.',
            'phone.size' => 'O telefone deve ter 11 dígitos (celular).',
            'gender.required' => 'O gênero é obrigatório.',
            'blood_type.required' => 'O tipo sanguíneo é obrigatório.',
            'emergency_contact_name.required' => 'O nome do contato de emergência é obrigatório.',
            'emergency_contact_phone.required' => 'O telefone do contato de emergência é obrigatório.',
            'emergency_contact_phone.size' => 'O telefone do contato de emergência deve ter 11 dígitos (celular).',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
            'password.confirmed' => 'A confirmação de senha não confere.',
            'public_password.required' => 'A senha de acesso público é obrigatória.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'cpf' => Cpf::formatAsNumber($this->cpf),
            'phone' => Phone::formatAsNumber($this->phone),
            'emergency_contact_phone' => Phone::formatAsNumber($this->emergency_contact_phone),
        ]);
    }
}
