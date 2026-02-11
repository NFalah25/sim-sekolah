<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
            'judul' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ];
    }

    public function attributes()
    {
        return [
            'judul' => 'Judul Berita',
            'description' => 'Deskripsi Berita',
            'content' => 'Konten Berita',
            'image' => 'Gambar Berita',
        ];
    }
}
