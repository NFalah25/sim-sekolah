<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
    public function attributes()
    {
        return [
            'name' => 'Judul agenda',
            'description' => 'Deskripsi Agenda',
            'lokasi' => 'Lokasi Agenda',
            'date' => 'Tanggal',
            'start_time' => 'Waktu Mulai',
            'end_time' => 'Waktu Selesai',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lokasi' => 'required|string|max:255',
            'date' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
        ];
    }
}
