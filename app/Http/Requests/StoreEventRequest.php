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

            [$startDate, $endDate] = $dates;

            if(Carbon::hasFormat('YYYY-MM-DD', $startDate) || Carbon::hasFormat('YYYY-MM-DD', $endDate)) {
                $validator->errors()->add('date_range', 'Format tanggal tidak valid');
                return;
            }

            if(Carbon::parse($endDate)->lt(Carbon::parse($startDate))) {
                $validator->errors()->add('date_range', 'Tanggal mulai tidak boleh lebih besar dari tanggal selesai');
            }

        });
    }

    protected function prepareForValidation()
    {
        if($this->has('date_range')){
            $dateRange = array_map('trim', explode('-', $this->input('date_range')));
            if(count($dateRange) === 2) {
                $startDate = $dateRange[0];
                $endDate = $dateRange[1];
            }
        }

    }
}
