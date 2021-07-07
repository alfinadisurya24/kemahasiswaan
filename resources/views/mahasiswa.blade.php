<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Mahasiswa
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mahasiswa</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        @if (session('role') == 1)
                        <a class="btn btn-primary" href="/mahasiswa/create">Create</a>
                        @endif
                        <a class="btn btn-primary" href="/mahasiswa/export_pdf">PDF</a>
                        @if (session('message'))
                            <div class="alert alert-success alert-dismissible" style="margin-top: 10px; margin-bottom: 0;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><center>{{ session('message') }}</center></strong>
                            </div>
                        @endif
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Alamat</th>
                                    @if (session('role') != 3)
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataMhs as $item)
                                    <tr>
                                        <td>{{ $item->nim }}</td>
                                        <td>{{ $item->nama_mhs }}</td>
                                        <td>{{ $item->nama_prodi }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        @if (session('role') != 3)
                                        <td>
                                            <a class="btn btn-info" href="/mahasiswa/update/{{ $item->idMhs }}">Update</a>
                                            {{-- <a class="btn btn-danger"  href="/mahasiswa/delete/data">Delete</a> --}}
                                            <form action="{{ url('/mahasiswa/delete/data') }}" method="POST" style="display: inline">
                                                @csrf
                                                <input type="hidden" name="id_hidden" value="{{ $item->idMhs }}">
                                                <button type="submit" onclick="return confirm('Anda Yakin Data diHapus?')" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<script>
    $(function () {
      $('#example2').DataTable()
    });
</script>
