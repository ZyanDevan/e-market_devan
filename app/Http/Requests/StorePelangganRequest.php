<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePelangganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kode_pelanggan' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required'
        ];
    }
    public function messages()
    {
        return[
            'kode_pelanggan.required' => 'Data Kode harus diisi!',
            'nama.required' => 'Data Nama harus diisi!',
            'alamat' => 'Data Alamat harus diisi!',
            'no_telp.required' => 'Data No_telp harus diisi!',
            'email.required' => 'Data Email harus diisi!'
        ];
    }
}
