@extends('admin.masterlayout')
@section('pagecontent')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <!--li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li-->
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>₦{{ number_format($totalToday) }}</h3>

            <p>Sales Today</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>₦{{ number_format($totalThisMonth) }}</h3>

            <p>Sales: last 30 days</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">&nbsp; <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{ $totalStaff }}</h3>

            <p>Members of Staff</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">&nbsp;<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>₦{{ number_format($allTimeSales) }}</h3>

            <p>All-time Sales</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">&nbsp; <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>


      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>₦{{ number_format($pettyCashBalance) }}</h3>

            <p>Petty Cash Balance</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">&nbsp; <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{ number_format($gas_level) }}kg</h3>

            <p>Reservoir</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">&nbsp; <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Most recent sales</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Date </th>
              <th scope="col">Cost</th>
              <th scope="col">Quantity</th>
              <th scope="col">Comments</th>
            </tr>
          </thead>
          <tbody>
            @foreach($all_sales as $sales)
            <tr>
            <td>{{ $loop->iteration }}
              <td>{{ $sales->created_at }}</td>
              <td>{{ $sales->cost }}</td>
              <td>{{ $sales->quantity }}</td>
              <td>{{ $sales->comments = "NULL" ? $sales->comments : "" }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        {{ $all_sales->links() }}
        Footer
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection