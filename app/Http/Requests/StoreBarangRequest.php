<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
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
            'kode_barang' => 'required',
            'produk_id' => 'required',
            'nama_barang' => 'required',
            'satuan' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'ditarik' => 'required',
            'user_id' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'kode_barang.required' => 'Data Kode Barang harus diisi!',
            'produk_id.required' => 'Data Produk ID harus diisi!',
            'nama_barang.required' => 'Data Nama Barang harus diisi!',
            'satuan.required' => 'Data Satuan harus diisi!',
            'harga_jual.required' => 'Data Harga Jual harus diisi!',
            'stok.required' => 'Data Stok harus diisi!',
            'ditarik.required' => 'Data Ditarik harus diisi!',
            'user_id.required' => 'Data User ID harus diisi!'
        ];
    }
}
