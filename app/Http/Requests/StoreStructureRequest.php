<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStructureRequest extends FormRequest
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
        // dd($this->all());
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'icon' => 'required|string|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Judul Struktur',
            'description' => 'Deskripsi Struktur',
            'image' => 'Gambar Struktur',
            'icon' => 'Ikon Struktur',
        ];
    }
}
