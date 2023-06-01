@php
$isNavbar = false;
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
          <h5>Order List</h5>
          <a href="{{ route('order-create') }}" class="  btn btn-outline-primary btn-md">Create</a>
        </div>
        <div class="table-responsive text-nowrap">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Reference</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th>Supplier</th>
                <th>Order By User</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($Orders as $order)
              <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>
                  <a href="{{url('/order/'.(string)$order->OrderId).'/edit'}}">{{$order->OrderReference}}</a>
                </strong></td>
                <td>{{$order->OrderDate}}</td>
                <td>
                  {{$order->TotalAmount}}
                </td>
                <td>{{$order->SupplierName}}</td>
                <td>{{$order->UserName}}</td>
                <td> 
                  @if($order->Status =='APPROVED')
                    <span class="badge bg-label-primary me-1">{{$order->Status}}</span>
                    @elseif($order->Status =='REJECTED')
                    <span class="badge bg-label-danger me-1">{{$order->Status}}</span>
                    @else
                    <span class="badge bg-label-warning me-1">{{$order->Status}}</span>
                  @endif
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
          <div class="mt-4">
            {!! $Orders->links('component.pagination') !!}
          </div>
        </div>
      </div>
  <!--/ Transactions -->
</div>
@endsection
