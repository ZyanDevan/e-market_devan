@extends('home')

@push('style')

@endpush

@section('content')

<section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Pelanggan</h3>

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
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormPelanggan">
    Tambah Pelanggan
  </button>
  <!-- table -->
  <table class="table table-sm" id="tbl-pelanggan">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Kode Pelanggan</th>
        <th scope="col">Nama</th>
        <th scope="col">Alamat</th>
        <th scope="col">No_telp</th>
        <th scope="col">Email</th>
        <th scope="col">Tools</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pelanggan as $p)
        <tr>
            <td>{{ $i = !isset($i)?$i=1:++$i }}</td>
            <td>{{ $p->kode_pelanggan }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->alamat }}</td>
            <td>{{ $p->no_telp }}</td>
            <td>{{ $p->email }}</td>
            <td>
                <button class="btn" data-toggle="modal" data-target="#modalFormPelanggan" data-mode="edit" data-id="{{ $p->id }}" data-kode_pelanggan="{{ $p->kode_pelanggan }}", data-nama="{{ $p->nama }}", data-alamat="{{ $p->alamat }}", data-no_telp="{{ $p->no_telp }}", data-email="{{ $p->email }}"><i class="fas fa-edit"></i></button>
                <form action="pelanggan/{{ $p->id }}" style="display: inline" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-delete" data-kode_pelanggan="{{ $p->kode_pelanggan }}"><i class="fas fa-trash"></i></button>
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
@include('pelanggan.form')
</section>
@endsection

@push('script')
<script>
$(function() {
        $('.alert-success').fadeTo(2000,500).slideUp(500, function(){
            $('.alert-success').slideUp(500)
        })

    $('#tbl-pelanggan').DataTable()
    // dialog hapus data
    $('.btn-delete').on('click', function(e) {
      let kode_pelanggan = $(this).closest('tr').find('td:eq(1)').text();
      Swal.fire({
        icon: 'error',
        title: 'Hapus Data',
        html: `Apakah data <b> ${kode_pelanggan} </b>akan dihapus?`,
        confirmButtonText: 'Ya',
        denyButtonText: 'Tidak',
        showDenyButton: true,
        focusConfirm: false
      }).then((result) => {
        if (result.isConfirmed) $(e.target).closest('form').submit()
        else swal.close()
      })
    })


    $('#modalFormPelanggan').on('show.bs.modal', function(e){
        const btn = $(e.relatedTarget)
        console.log(btn.data('mode'))
        const mode = btn.data('mode')
        const kode_pelanggan= btn.data('kode_pelanggan')
        const nama= btn.data('nama')
        const alamat= btn.data('alamat')
        const no_telp= btn.data('no_telp')
        const email= btn.data('email')
        const id = btn.data('id')
        const modal = $(this)
        if(mode === 'edit'){
            modal.find('.modal-title').text('Edit Data Pelanggan')
            modal.find('#kode_pelanggan').val(kode_pelanggan)
            modal.find('#nama').val(nama)
            modal.find('#alamat').val(alamat)
            modal.find('#no_telp').val(no_telp)
            modal.find('#email').val(email)
            modal.find('.modal-body form').attr('action','{{ url("pelanggan") }}/'+id)
            modal.find('#method').html('@method("PATCH")')
        }else{
            modal.find('.modal-title').text('Input Data Pelanggan')
            modal.find('#kode_pelanggan').val('')
            modal.find('#nama').val('')
            modal.find('#alamat').val('')
            modal.find('#no_telp').val('')
            modal.find('#email').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action','{{ url("pelanggan") }}')
        }
    })
  })
    </script>
@endpush