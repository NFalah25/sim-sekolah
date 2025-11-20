<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes()
    {
        return [
            'name' => 'Nama',
            'image' => 'Gambar',
            'email' => 'Email',
            'phone' => 'Nomor Telepon',
            'motivation' => 'Kata Kata Motivasi',
            'nip' => 'NIP',
            'drive' => 'Tautan Google Drive',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'nullable|string|max:20|unique:teachers,phone',
            'motivation' => 'nullable|string|max:100',
            'nip' => 'nullable|integer|unique:teachers,NIP',
            'drive' => 'nullable|url|max:255',
        ];
    }
}
