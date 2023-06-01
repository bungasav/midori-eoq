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
            <a href="/supplier">Supplier</a>
          </li>
          <li class="breadcrumb-item active">Update</li>
        </ol>
      </nav>
    <div class="card">
        <div class="mb-4">
            <h5 class="card-header">Update Supplier</h5>
            <div class="card-body">
            <form id="formCreateSupplier" class="mb-3" action="{{url('/supplier/'.(string)$supplier->SupplierId)}}" method="post">
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
                <input type="text" class="form-control" name="name" placeholder="john doe"  value="{{ old('name', $supplier->Name) }}"/>
              </div>
              <div class="mb-3">
                <label for="Address" class="form-label">Address</label>
                <input type="tel" class="form-control" name="Address" placeholder="Jalan Soekarno Hatta"  value="{{ old('Address', $supplier->Address) }}"/>
              </div>
              <div class="mb-3">
                <label for="phoneNumber" class="form-label">PhoneNumber</label>
                <input type="tel" class="form-control" name="phoneNumber" placeholder="0810128312" value="{{ old('phoneNumber', $supplier->PhoneNumber) }}"/ />
              </div>
              <div class="mb-3">
                <label for="BankName" class="form-label">Bank Name</label>
                <input type="tel" class="form-control" name="BankName" placeholder="BCA"  value="{{ old('BankName', $supplier->BankName) }}"//>
              </div>
              <div class="mb-3">
                <label for="AccountNumber" class="form-label">Bank Account Number</label>
                <input type="tel" class="form-control" name="AccountNumber" placeholder="991111"  value="{{ old('AccountNumber', $supplier->AccountNumber) }}"//>
              </div>
              <div class="mb-3">
                <label for="AccountName" class="form-label">Bank Account Name</label>
                <input type="tel" class="form-control" name="AccountName" placeholder="john doe"  value="{{ old('AccountName', $supplier->AccountName) }}"//>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Submit</button>
              </div>
            </form>
          </div>
      </div>
</div>

@endsection
