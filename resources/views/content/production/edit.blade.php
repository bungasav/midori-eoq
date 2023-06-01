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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/production">Production</a>
          </li>
          <li class="breadcrumb-item active">Detail</li>
        </ol>
      </nav>
    <div class="card">
        <div class="mb-4">
            <h5 class="card-header">Detail Production {{$production->Reference}}</h5>
            <div class="card-body">
       
              <div>
                <p> Product List </p>
                <table class="table table-bordered" id="tableProduct">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                  @foreach($productionDetails as $product) 
                  <tr> 
                    <td>
                    {{$product->ProductName}}
                  </td>  
                  <td>
                  {{$product->Quantity}}
                  </td>  
                </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
</div>
@endsection
