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
                            function calcNewCost() {
                                let qtycost = document.getElementById('qtycost').value;
                                let cost = document.getElementById('cost');
                                let rate = document.getElementById('rate').value;
                                let mode = document.getElementById('mode').value;
                                let qty = document.getElementById('qty'); //without value
                                let qtyvalue = document.getElementById('qtycost').value; //with value
                                if (mode == "kg") {
                                    let newCost = qtycost * rate;
                                    //alert(newCost);
                                    qty.value = qtycost;
                                    cost.value = newCost;
                                } else {
                                    //calculate by monetary value

                                    let newCost = qtycost / rate;
                                    let quantity = qtyvalue / rate;

                                    qty.value = quantity;
                                    cost.value = qtycost;
                                }


                            }

                            function changeByRate() {
                                //let quantity = document.getElementById('qty').value;
                                let cost = document.getElementById('cost'); //without the value
                                //let rate = document.getElementById('rate').value;
                                //new calc
                                let qtyCost = document.getElementById('qtycost').value
                                let rate = document.getElementById('rate')
                                let mode = document.getElementById('mode')
                                let qty = document.getElementById('qty');

                                if (mode == "kg") {
                                    let qtyValue = qtyCost / mode;
                                    let costValue = qtyCost
                                    cost.value = costValue
                                    qty.value = qtyValue

                                }


                                // let newCost = quantity * rate;
                                // cost.value = newCost;

                                let comments = document.getElementById('comments')
                                if (rate == 440) {
                                    comments.value = "Dealer | "
                                } else {
                                    comments.value = "Regular | "
                                }
                            }


                            function calcDiscount() {
                                let originalAmount = document.getElementById("cost").value;
                                let discount = document.getElementById("discount").value;
                                let newCost = originalAmount - discount
                                cost.value = newCost;
                            }

                            function calcChange() {
                                let moneyPaid = document.getElementById("moneypaid").value;
                                let totalCost = document.getElementById("cost").value;
                                let totalChange = moneyPaid - totalCost
                                change.value = totalChange
                            }
                        </script>

                        <div class="row">
                            <label>Mode of Purchase</label>
                            <select name="mode" id="mode" type="text" class="form-control mb-2" required onChange="calcNewCost()">
                                <option value="kg">Weight</option>
                                <option value="cost">Monetary Value</option>
                            </select>

                            <label>Quantity or Cost</label>
                            <input type="text" name="qtycost" id="qtycost" class="form-control mt- mb-2 bg-navy" placeholder="Enter Quantity or Cost" onChange="calcNewCost()">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" id="qty" name="quantity" readonly placeholder="Enter quantity without a unit. Eg.: 8" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input type="text" id="cost" name="cost" class="form-control bg-indigo" readonly>

                                </div>
                                <div class="form-group">
                                    <label>Money Paid</label>
                                    <input type="number" id="moneypaid" name="moneypaid" class="form-control" onchange="calcChange()">

                                </div>
                                <div class="form-group">
                                    <label>Referral Code</label>
                                    <input type="text" id="refcode" name="refcode" class="form-control">

                                </div>

                                <div class="form-group">
                                    <label>Customer</label>
                                    <select class="js-example-basic-single form-control" name="phone">
                                        <option>Select Customer</option>
                                        @foreach($customers as $customer)
                                        <option value="{{$customer->phone_number}}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rate (Cost per kg.)</label>
                                    <!-- input type="number" name="rate" id="rate" value="{{-- $rate --}}" readonly class="form-control"-->
                                    <select name="rate" id="rate" class="form-control" onchange="calcNewCost()">
                                        @foreach($prices as $price)
                                        <option value="{{ $price->value }}">{{ $price->name }} - {{ $price->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Discount</label>
                                    <input type="number" id="discount" name="discount" value="0" class="form-control" onchange="calcDiscount()">
                                </div>
                                <div class="form-group">
                                    <label>Change</label>
                                    <input type="number" id="change" name="change" class="form-control bg-maroon" readonly>
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