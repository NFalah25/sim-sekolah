<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStructureRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'icon' => 'required|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Nama Struktur',
            'description' => 'Deskripsi',
            'image' => 'Gambar Struktur',
            'icon' => 'Ikon Struktur',
        ];
    }
}
