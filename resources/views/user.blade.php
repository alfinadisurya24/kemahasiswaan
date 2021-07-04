<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a class="btn btn-primary" href="/user/create">Create</a>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userData as $val)
                                    <tr>
                                        <td>{{ $val->name }}</td>
                                        <td>{{ $val->email }}</td>
                                        <td>{{ $val->phone }}</td>
                                        <td>{{ $val->username }}</td>
                                        <td>{{ $val->role_name }}</td>
                                        <td>
                                            <a class="btn btn-info" href="/user/update/{{ $val->id }}">Update</a>
                                            {{-- <a class="btn btn-danger" href="">Delete</a> --}}
                                            <form action="{{ url('/user/delete/master/data') }}" method="POST" style="display: inline">
                                                @csrf
                                                <input type="hidden" name="id_hidden" value="{{ $val->id }}">
                                                <button type="submit" onclick="return confirm('Anda Yakin Data diHapus?')" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
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
