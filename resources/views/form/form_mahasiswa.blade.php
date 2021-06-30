@php
    $action = Request::segment(2);
@endphp

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ ucfirst($action) }} Mahasiswa
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/mahasiswa"><i class="fa fa-users"></i> Mahasiswa</a></li>
            <li class="active">{{ ucfirst($action) }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- form start -->
                        <form role="form" method="" action="">
                            <div class="box-body">
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input type="text" class="form-control" name="nim" value="{{ $field->nim }}" placeholder="* nim" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ $field->name }}" placeholder="* nama" required>
                            </div>
                            <div class="form-group">
                                <label for="prodi">Prodi</label>
                                <select class="form-control" name="prodi" required>
                                    @if ($action == 'create')
                                        <option disabled selected>Pilih prodi</option>
                                    @endif
                                    @foreach ($prodi as $opt)
                                        <option value="{{ $opt->id }}" {{ $field->id == $opt->id ? 'selected' : '' }}>{{ $opt->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $field->email }}" placeholder="* email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ $field->phone }}" placeholder="* phone" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3" placeholder="* alamat" required>{{ $field->address }}</textarea>
                            </div>


                            {{-- <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <input type="file" id="exampleInputFile">

                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                            <div class="checkbox">
                                <label>
                                <input type="checkbox"> Check me out
                                </label>
                            </div>
                            </div> --}}
                            <!-- /.box-body -->

                            <div class="box-footer">
                            <button type="submit" class="btn btn-primary">{{ $action }}</button>
                            </div>
                        </form>
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
