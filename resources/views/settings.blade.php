@extends('admin.masterlayout')
@section('pagecontent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>System Settings</h1>
                </div>
                <!--div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">System Settings</li>
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
                <h3 class="card-title">Settings</h3>

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
                    <form action="{{route('update-settings')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cost of gas per kg</label>
                                    <input type="number" name="rate" value="{{ $rate->value }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Incentive percentage for Manager</label>
                                    <input type="number" name="sales_percentage_one" value="{{ $sales_percentage_one->value }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Incentive percentage for Others</label>
                                    <input type="number" name="sales_percentage_four" value="{{ $sales_percentage_four->value }}" class="form-control">
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Incentive percentage for Cashier</label>
                                    <input type="number" name="sales_percentage_three" value="{{ $sales_percentage_three->value }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Incentive percentage for Marketer</label>
                                    <input type="number" name="sales_percentage_two" value="{{ $sales_percentage_two->value }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="col"></div> <input type="submit" class="btn btn-primary float-right" value="Update Settings">
                                </div>
                            </div>
                            <!-- /.col -->
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