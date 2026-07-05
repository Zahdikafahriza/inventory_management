<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class MasterReferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'admin';
    }

    protected function masterTable(): string
    {
        $type = $this->route('type');
        $config = config("master-references.$type");

        abort_if(!$config, Response::HTTP_NOT_FOUND);

        return $config['table'];
    }

    public function rules(): array
    {
        $table = $this->masterTable();
        $ignoreId = $this->route('id');

        $unique = Rule::unique($table, 'nama');
        if ($ignoreId) {
            $unique->ignore($ignoreId);
        }

        return [
            'nama'      => ['required', 'string', 'max:191', $unique],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nama.unique'   => 'Nilai ini sudah ada, gunakan nama lain.',
        ];
    }
}
