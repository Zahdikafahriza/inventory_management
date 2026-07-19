<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockOpnameUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('update stock_opname') || $this->user()?->can('create stock_opname');
    }

    public function rules(): array
    {
        return [
            'catatan'        => ['nullable', 'string', 'max:255'],
            'items'          => ['required', 'array'],
            // Setiap nilai hasil SO: boleh kosong (belum dihitung) atau integer >= 0.
            'items.*'        => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'items.*.integer' => 'Jumlah hasil SO harus berupa angka.',
            'items.*.min'     => 'Jumlah hasil SO tidak boleh negatif.',
        ];
    }
}
