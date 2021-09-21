@extends('admin.masterlayout')
@section('pagecontent')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Check Sales History</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Select a user and dates to get data</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="box-body">
                    <div class="row">
                        <form action="view-incentive" method="POST">
                            @csrf
                            <div class="form-row col-lg-12">
                                <div class="col">
                                    <label>Select User</label>
                                    <select class="form-control" name="user_id">
                                        <option selected disabled>Select One</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->lname }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" name="start">
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" class="form-control" name="end">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>&nbsp; </label>
                                        <input type="submit" class="form-control btn btn-primary">
                                    </div>
                                </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>

    </section>

    <section class="content">




        <div class="card">
            <div class="card-header">
                <strong>Total sales through staff: ₦ {{ $total_sales->total_cost ?? '' }}
                | Sales Bonus:<strong>₦{{ $percentage ??'' }}</strong><br>
                <strong>From: {{ $from ?? '' }} | To: {{ $to  ?? ''}}</strong>
               
            </div>
            <div class="card-body">
                <div class="box-body">
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name of Staff </th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_sales as $listSale)
                                @php
                                $saleTime = \Carbon\Carbon::parse($listSale->created_at);
                                $timeOfSale = $saleTime->format('d-M-Y');
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $listSale->name }} {{ $listSale->lname }}</td>
                                    <td>{{ $timeOfSale }}</td>
                                    <td>{{ number_format($listSale->cost) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- $all_sales->links() --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection