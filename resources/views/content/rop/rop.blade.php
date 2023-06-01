@php
 ;
$menuTemplate = false;
@endphp


@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')

<div class="row">
    <div class="card">
        <h5 class="card-header">ROP</h5>
        <div class="table-responsive text-nowrap">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Item Name</th>
                <th>Order Count</th>
                <th>Waktu Tunggu</th>
                <th>Safety Stock</th>
                <th>ROP</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($ROP as $r)
              <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$r->Name}}</strong></td>
                <td>{{$r->OrderCount}}</td>
                <td>{{$r->OrderCount}}</td>
                <td>{{$r->safety_stock}}</td>
                <td>{{$r->ROP}}</td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
  <!--/ Transactions -->
</div>
@endsection
