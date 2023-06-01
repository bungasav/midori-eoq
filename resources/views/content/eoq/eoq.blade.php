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
        <h5 class="card-header">EOQ</h5>
        <div class="table-responsive text-nowrap">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Item Name</th>
                <th>Price</th>
                <th>Jumlah Pesanan</th>
                <th>Biaya Penyimpanan</th>
                <th>Permintaan per Periode</th>
                <th>Biaya tiap Pemesanan</th>
                <th>EOQ</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($EOQ as $e)
              <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$e->ItemName}}</strong></td>
                <td>{{$e->ItemPrice}}</td>
                <td>{{$e->D}}</td>
                <td>{{$e->H}}</td>
                <td>{{$e->C}}</td>
                <td>{{$e->R}}</td>
                <td>{{$e->EOQ}}</td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
  <!--/ Transactions -->
</div>
@endsection
