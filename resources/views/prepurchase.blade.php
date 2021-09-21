@extends('admin.masterlayout')
@section('pagecontent')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>POS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">POS</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Record Sale</h3>

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
                    <form action="{{route('savesale')}}" method="post">
                        @csrf

                        <script>
                            function calcCost() {
                                let qty = document.getElementById("qty").value;
                                let rate = document.getElementById("rate").value;
                                let cost = document.getElementById("cost");
                                let totalCost = qty * rate;
                                cost.value = totalCost;
                            }

                            function calcChange(){
                                let moneyPaid = document.getElementById("moneypaid").value;
                                let totalCost = document.getElementById("cost").value;
                                let totalChange = moneyPaid - totalCost
                                change.value = totalChange
                            }
                        </script>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" id="qty" name="quantity" placeholder="Enter quantity without a unit. Eg.: 8" class="form-control" onchange="calcCost()">
                                </div>
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input type="number" id="cost" name="cost" class="form-control" readonly>

                                </div>
                                <div class="form-group">
                                    <label>Money Paid</label>
                                    <input type="number" id="moneypaid" name="moneypaid" class="form-control" onchange="calcChange()">

                                </div>
                                <div class="form-group">
                                    <label>Referral Code</label>
                                    <input type="text" id="refcode" name="refcode" class="form-control">

                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rate (Cost per kg.)</label>
                                    <input type="number" name="rate" id="rate" value="{{ $rate }}" readonly class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Customer's Phone Number</label>
                                    <input type="text" id="phone" name="phone" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Change</label>
                                    <input type="number" id="change" name="change" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Comments</label>
                                    <input type="text" id="comments" name="comments" class="form-control" placeholder="Comments (if any)">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <div class="col"></div> <input type="submit" class="btn btn-primary float-right" value="Record Purchase">
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