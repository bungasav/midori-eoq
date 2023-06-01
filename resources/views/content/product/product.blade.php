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
          <h5>Product List</h5>
          <a href="{{ route('product-create') }}" class="  btn btn-outline-primary btn-md">Create</a>
        </div>
        <div class="table-responsive text-nowrap">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Stock</th>
                <th>Measurement</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($Products as $item)
              <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>{{$item->Name}}</strong></td>
                <td>{{$item->Description}}</td>
                <td>
                  {{$item->UnitInStock}}
                </td>
                <td>{{$item->UnitOfMeasurement}}</td>
                <td> <span class="badge bg-label-primary me-1">{{$item->Status}}</span></td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{url('/product/'.(string)$item->ItemId).'/edit'}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                      <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{url('/product/'.(string)$item->ItemId).'/delete'}}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="dropdown-item">Delete</button>
                        </form>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
          <div class="mt-4">
            {!! $Products->links('component.pagination') !!}
          </div>
        </div>
      </div>
  <!--/ Transactions -->
</div>
@endsection
