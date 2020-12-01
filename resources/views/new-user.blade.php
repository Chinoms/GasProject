@extends('admin.masterlayout')
@section('pagecontent')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Staff</h1>
                </div>
                <!--div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div-->
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Title</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="box-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <form action="{{route('savestaff')}}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{old('email')}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Basic Salary</label>
                                    <input type="number" name="salary" value="{{old('salary')}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Staff Type</label>
                                    <select name="staff_type" class="form-control">
                                        <option disabled selected>Select staff type</option>
                                        @foreach($usersType as $types)
                                       <option value="{{$types->id}}"> {{$types->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Surname</label>
                                    <input type="text" name="lname" value="{{old('lname')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" value="{{old('password')}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Referral Code (Automatically Generated)</label>
                                    <input type="text" name="ref_code" readonly value="{{$ref_code}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <div class="col"></div> <input type="submit" class="btn btn-primary float-right" value="Register New Staff">
                                </div>

                            </div>



                        </div>
                    </form>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{-- Footer--}}
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection