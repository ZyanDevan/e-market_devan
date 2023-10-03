@extends('home')

@push('style')

@endpush

@section('content')

<section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Produk</h3>

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
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormProduk">
    Tambah Produk 
  </button>
  <!-- table -->
  <table class="table table-sm" id="tbl-produk">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama Produk</th>
        <th scope="col">Tools</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($produk as $p)
        <tr>
            <td>{{ $i = !isset($i)?$i=1:++$i }}</td>
            <td>{{ $p->nama_produk }}</td>
            <td>
                <button class="btn" data-toggle="modal" data-target="#modalFormProduk" data-mode="edit" data-id="{{ $p->id }}" data-nama_produk="{{ $p->nama_produk }}"><i class="fas fa-edit"></i></button>
                <form action="produk/{{ $p->id }}" style="display: inline" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-delete" data-nama_produk="{{ $p->nama_produk }}"><i class="fas fa-trash"></i></button>
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
@include('produk.form')
</section>
@endsection

@push('script')
<script>
$(function() {
  $('#tbl-data-produk').DataTable()

        $('.alert-success').fadeTo(2000,500).slideUp(500, function(){
            $('.alert-success').slideUp(500)
        })

    $('#tbl-produk').DataTable()
    // dialog hapus data
    $('.btn-delete').on('click', function(e) {
      let nama_produk = $(this).closest('tr').find('td:eq(1)').text();
      Swal.fire({
        icon: 'error',
        title: 'Hapus Data',
        html: `Apakah data <b> ${nama_produk} </b>akan dihapus?`,
        confirmButtonText: 'Ya',
        denyButtonText: 'Tidak',
        showDenyButton: true,
        focusConfirm: false
      }).then((result) => {
        if (result.isConfirmed) $(e.target).closest('form').submit()
        else swal.close()
      })
    })


    $('#modalFormProduk').on('show.bs.modal', function(e){
        const btn = $(e.relatedTarget)
        console.log(btn.data('mode'))
        const mode = btn.data('mode')
        const nama_produk = btn.data('nama_produk')
        const id = btn.data('id')
        const modal = $(this)
        if(mode === 'edit'){
            modal.find('.modal-title').text('Edit Data Produk')
            modal.find('#nama_produk').val(nama_produk)
            modal.find('.modal-body form').attr('action','{{ url("produk") }}/'+id)
            modal.find('#method').html('@method("PATCH")')
        }else{
            modal.find('.modal-title').text('Input Data Produk')
            modal.find('#nama_produk').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action','{{ url("produk") }}')
        }
    })
  })
    </script>
@endpush