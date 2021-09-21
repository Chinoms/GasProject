@extends('admin.masterlayout')
@section('pagecontent')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gas Purchase History</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">View history of purchases</h3>

                <div class="card-tools">

                </div>
            </div>
            <div class="card-body">
                <div class="box-body">

                    <div class="table-responsive-sm table-striped">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Cost</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                    <th>Trans. ID</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allTransactions as $transaction)
                                @php
                                $purchaseTime = \Carbon\Carbon::parse($transaction->created_at);
                                $timeofPurchase = $purchaseTime->format('d-M-Y');
                                if($transaction->is_paid == 0){
                                $text = "Mark as paid";
                                $link = $transaction->id;
                                $cssClass = "btn btn-success dropdown-toggle";
                                } else{
                                $text = "Paid";
                                $link = "#";
                                $cssClass = "btn btn-danger disabled";
                                }
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>₦{{ number_format($transaction->cost) }}</td>
                                    <td>{{ number_format($transaction->quantity) }} kg</td>
                                    <td>{{ $timeofPurchase }}</td>
                                    <td>{{ $transaction->trans_id }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="{{ $cssClass }}" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               {{$text}}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="mark-as-paid/{{$transaction->id}}/payment-method/Cash">Paid with Cash</a>
                                                <a class="dropdown-item" href="mark-as-paid/{{$transaction->id}}/payment-method/POS">Paid with POS</a>
                                                <a class="dropdown-item" href="mark-as-paid/{{$transaction->id}}/payment-method/Transfer">Paid via Transfer</a>
                                            </div>
                                        </div>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{$allTransactions->links() }}
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection