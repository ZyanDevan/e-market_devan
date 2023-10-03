<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;
use PDOException;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data['barang'] = Barang::get();

            return view('barang.index')->with($data);

        } catch (QueryException | Exception | PDOException $error){
            return "terjadi kesalahan".$error->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarangRequest $request)
    {
        try {
             DB::beginTransaction();
            Barang::create($request -> all());

             DB::commit();

            return redirect('barang')-> with('success', 'Data barang berhasil di tambahkan!');

         }  catch (QueryException | Exception | PDOException $error) {
             DB::rollBack();
             $this->failResponse($error->getMessage(), $error->getCode());
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBarangRequest  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        $barang->update($request->all());

        return redirect('barang',)->with('success', 'update data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        try {
            $barang->delete();

            return redirect('barang')->with('success', 'Data berhasil di hapus!');                       

        } catch (QueryException | Exception | PDOException $error){
            DB::rollback();
            return "terjadi kesalahan".$error->getMessage();
        }
    }
}
