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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/product">Product</a>
          </li>
          <li class="breadcrumb-item active">Update</li>
        </ol>
      </nav>
    <div class="card">
        <div class="mb-4">
            <h5 class="card-header">Update Product</h5>
            <div class="card-body">
               <form id="formCreateItem" class="mb-3" action="{{url('/product/'.(string)$item->ItemId)}}" method="post">
                @csrf
                  {{ method_field('PUT') }}
                  @if($errors->any())
                  @foreach($errors->all() as $err)
                  <div class="alert alert-danger" role="alert">
                    {{ $err }}
                  </div>
                  @endforeach
                  @endif

              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Jelly"  value="{{ old('name', $item->Name) }}"/>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="tel" class="form-control" name="description" placeholder="Ukuran sedang kemasan baru, expired 2024"  value="{{ old('description', $item->Description) }}"/>
              </div>
              <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="tel" class="form-control" name="stock" placeholder="10"  value="{{ old('stock', $item->UnitInStock) }}"/>
              </div>
              <div class="mb-3">
                <label for="measurement" class="form-label">Measurement</label>
                <input type="tel" class="form-control" name="measurement" placeholder="Pcs"  value="{{ old('measurement', $item->UnitOfMeasurement) }}"/>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Submit</button>
              </div>
            </form>
          </div>
      </div>
</div>

@endsection
