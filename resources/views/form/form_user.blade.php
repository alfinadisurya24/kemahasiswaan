@php
    $action = Request::segment(2);
@endphp

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ ucfirst($action) }} User
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/mahasiswa"><i class="fa fa-users"></i> User</a></li>
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
                        <form method="POST" action="{{ url('/user/'.$action.'/master/data') }}">
                            @csrf
                            {{-- <div class="box-body"> --}}
                            <input type="hidden" name="id" value="{{$field->id}}">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{$field->name}}" placeholder="* name" >
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" value="{{$field->email}}" placeholder="* email" >
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="number" class="form-control" name="phone" value="{{$field->phone}}" placeholder="* phone" >
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" value="{{$field->username}}" placeholder="* phone" >
                            </div>
                            <div class="form-group">
                                <label for="password">Password {{ ($action == 'update') ? '(optional)' : '' }} </label>
                                <input type="password" class="form-control" name="password" value="" placeholder="* password" >
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" name="role" >
                                    @if ($action == 'create')
                                        <option disabled selected>Pilih prodi</option>
                                    @endif
                                    @foreach ($role as $opt)
                                        <option value="{{ $opt->id }}" {{ $field->role_id == $opt->id ? 'selected' : '' }}>{{ $opt->name }}</option>
                                    @endforeach
                                </select>
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
