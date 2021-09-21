@extends('admin.masterlayout')
@section('pagecontent')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Office Expenditure</h1>
                </div>
                
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Money Spent For Daily Activities</h3>

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
                                    <th>Amount</th>
                                    <th>Narration</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pettyCash as $purchase)
                                @php
                                $purchaseTime = \Carbon\Carbon::parse($purchase->created_at);
                                $timeofPurchase = $purchaseTime->format('d-M-Y');
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>₦{{ number_format($purchase->amount) }}</td>
                                    <td>{{ $purchase->description }}</td>
                                    <td>{{ $timeofPurchase }}</td>
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
            {{$pettyCash->links() }}
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection