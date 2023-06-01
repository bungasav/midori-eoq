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
      <div class=" card-header d-flex justify-content-between">
          <h5>Production List</h5>
          <a href="{{ route('production-create') }}" class="  btn btn-outline-primary btn-md">Create</a>
        </div>
        <div class="table-responsive text-nowrap">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Reference</th>
                <th>Date</th>
                <th>Production By User</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($Productions as $production)
              <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>
                <a href="{{url('/production/'.(string)$production->ProductionId).'/edit'}}">{{$production->Reference}}</a></strong></td>
                <td>{{$production->CreatedDate}}</td>
                <td>{{$production->UserName}}</td>
                <td> <span class="badge bg-label-primary me-1">{{$production->Status}}</span></td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
  <!--/ Transactions -->
</div>
@endsection
