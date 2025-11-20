<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'name' => 'Nama Acara',
            'description' => 'Deskripsi Acara',
            'lokasi' => 'Lokasi Acara',
            'date_range' => 'Rentang Tanggal',
            'start_time' => 'Waktu Mulai',
            'end_time' => 'Waktu Selesai',
            'category' => 'Kategori Acara',
            'color' => 'Warna Penanda',
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
            'description' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'date_range' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'category' => 'required|string',
            'color' => 'required|string',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $dateRange = $this->input('date_range');
            if(!$dateRange) return;

            $dates = array_map('trim', explode(' - ', $dateRange));
            if(count($dates) !== 2) {
                $validator->errors()->add('date_range', 'Tanggal tidak lengkap');
                return;
            }

            $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $dates[0]);
            $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $dates[1]);

            if(!$startDate || !$endDate) {
                $validator->errors()->add('date_range', 'Format tanggal tidak valid');
                return;
            }

            if($endDate->lt($startDate)) {
                $validator->errors()->add('date_range', 'Tanggal selesai harus setelah tanggal mulai');
            }
        });
    }

    protected function prepareForValidation()
    {
        $dateRange = $this->input('date_range');
        if ($dateRange) {
            $dates = array_map('trim', explode(' - ', $dateRange));
            if (count($dates) === 2) {
                $this->merge([
                    'start_date' => $dates[0],
                    'end_date' => $dates[1],
                ]);
            }
        }
    }
}
