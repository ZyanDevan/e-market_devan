@extends('home')

@push('style')

@endpush

@section('content')

<section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Barang</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session ('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
          </button>
      </div>

    @endif

    @if($errors->any())

      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
          @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

          @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

    @endif
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormBarang">
    Tambah Barang
  </button>
  <!-- table -->
  <table class="table table-sm" id="tbl-barang">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Kode Barang</th>
        <th scope="col">produk id</th>
        <th scope="col">Nama Barang</th>
        <th scope="col">Satuan</th>
        <th scope="col">Harga Jual</th>
        <th scope="col">Stok</th>
        <th scope="col">Ditarik</th>
        <th scope="col">User ID</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($barang as $p)
        <tr>
            <td>{{ $i = !isset($i)?$i=1:++$i }}</td>
            <td>{{ $p->kode_barang }}</td>
            <td>{{ $p->produk_id }}</td>
            <td>{{ $p->nama_barang }}</td>
            <td>{{ $p->satuan }}</td>
            <td>{{ $p->harga_jual }}</td>
            <td>{{ $p->stok }}</td>
            <td>{{ $p->ditarik }}</td>
            <td>{{ $p->user_id }}</td>
            <td>
                <button  class="btn" data-toggle="modal" data-target="#modalFormBarang" data-mode="edit" data-id="{{ $p->id }}" data-kode_barang="{{ $p->kode_barang }}" data-produk_id="{{ $p->produk_id }}", data-nama_barang="{{ $p->nama_barang }}", data-satuan="{{ $p->satuan }}", data-harga_jual="{{ $p->harga_jual }}", data-stok="{{ $p->stok }}", data-ditarik="{{ $p->ditarik }}", data-user_id="{{ $p->user_id }}"><i class="fas fa-edit"></i></button>
                <form action="barang/{{ $p->id }}" style="display: inline" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-delete" data-kode_barang="{{ $p->kode_barang }}"><i class="fas fa-trash"></i></button>
                </td>
            </form>
        </tr>
      @endforeach
    </tbody>
  </table>

  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    Footer
  </div>
  <!-- /.card-footer-->
</div>
<!-- /.card -->
@include('barang.form')
</section>
@endsection

@push('script')
<script>

        $('.alert-success').fadeTo(2000,500).slideUp(500, function(){
            $('.alert-success').slideUp(500)
        })

    //$('#tbl-barang').DataTable()
    // dialog hapus data
    $('.btn-delete').on('click', function(e) {
      let kode_barang = $(this).closest('tr').find('td:eq(1)').text();
      Swal.fire({
        icon: 'error',
        title: 'Hapus Data',
        html: `Apakah data <b> ${kode_barang} </b>akan dihapus?`,
        confirmButtonText: 'Ya',
        denyButtonText: 'Tidak',
        showDenyButton: true,
        focusConfirm: false
      }).then((result) => {
        if (result.isConfirmed) $(e.target).closest('form').submit()
        else swal.close()
      })
    })


    $('#modalFormBarang').on('show.bs.modal', function(e){
        const btn = $(e.relatedTarget)
        console.log(btn.data('mode'))
        const mode = btn.data('mode')
        const kode_barang= btn.data('kode_barang')
        const produk_id= btn.data('produk_id')
        const nama_barang= btn.data('nama_barang')
        const satuan= btn.data('satuan')
        const harga_jual= btn.data('harga_jual')
        const stok = btn.data('stok')
        const ditarik = btn.data('ditarik')
        const user_id = btn.data('user_id')
        const id = btn.data('id')
        const modal = $(this)
        console.log(mode)
        if(mode === 'edit'){
            modal.find('.modal-title').text('Edit Data Barang')
            modal.find('#kode_barang').val(kode_barang)
            modal.find('#produk_id').val(produk_id)
            modal.find('#nama_barang').val(nama_barang)
            modal.find('#satuan').val(satuan)
            modal.find('#harga_jual').val(harga_jual)
            modal.find('#stok').val(stok)
            modal.find('#ditarik').val(ditarik)
            modal.find('#user_id').val(user_id)
            modal.find('.modal-body form').attr('action','{{ url("barang") }}/'+id)
            modal.find('#method').html('@method("PATCH")')
        }else{
            modal.find('.modal-title').text('Input Data Barang')
            modal.find('#kode_barang').val('')
            modal.find('#produk_id').val('')
            modal.find('#nama_barang').val('')
            modal.find('#satuan').val('')
            modal.find('#harga_jual').val('')
            modal.find('#stok').val('')
            modal.find('#ditarik').val('')
            modal.find('#user_id').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action','{{ url("barang") }}')
        }
    })

    </script>
@endpush