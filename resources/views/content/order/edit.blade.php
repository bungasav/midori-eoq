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
            <a href="/order">Order</a>
          </li>
          <li class="breadcrumb-item active">Detail</li>
        </ol>
      </nav>
    <div class="card">
        <div class="mb-4">
            <h5 class="card-header">Detail Order {{$order->OrderReference}}</h5>
            <!-- <button type="button" class="btn btn-danger" fdprocessedid="oyvlb3">Danger</button>
            <button type="button" class="btn btn-danger" fdprocessedid="oyvlb3">Danger</button> -->
            <div class="card-body">
            <div class="mb-3">
                <label for="Status" class="form-label">Status</label>
                <input type="text" class="form-control" name="Status" value="{{ old('Status', $order->Status) }}"/>
              </div>
            <div class="mb-3">
                <label for="supplier" class="form-label">Supplier</label>
                <input type="text" class="form-control" name="supplier" value="{{ old('supplier', $order->Name) }}"/>
              </div>
              <div>
                <p> Product List </p>
                <table class="table table-bordered" id="tableProduct">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Jumlah</th>
                      <th>Harga</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                  @foreach($orderDetails as $product) 
                  <tr> 
                    <td>
                    {{$product->ProductName}}
                  </td>  
                  <td>
                  {{$product->Quantity}}
                  </td>  
                  <td> 
                  {{$product->BasePrice}}
                  </td>  
                </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
</div>
<script type="module">
  var productList =  @json($orderDetails);
  createTable();
  var createTable = function(){

    const elementRow = Object.keys(productList).map((key,index) => {

      let product = productList[key];

      if(product){
        return`
        <tr> 
          <td>
          <input type="hidden" name="item[${index}][id]"  value="${product.ItemId}"/>
          ${product.ProductName}
        </td>  
        <td>      
          <div class="">
            <input type="number" class="form-control" name="item[${index}][quantity]" value="${product.Quantity}" required onchange="onChangeTableProduct(this,${product.ItemId},'quantity')" />
          </div>
        </td>  
        <td> 
          <div class="">
            <input type="number" class="form-control" name="item[${index}][basePrice]" value="${product.BasePrice}"  required  onchange="onChangeTableProduct(this,${product.ItemId},'basePrice')" />
          </div>  
        </td>  
        <td> <i class="bx bx-trash text-danger mb-2" onClick="deleteProductItem(${product.ItemId})"></i> </td>  
      </tr>
    `;
      }else {
        return ''
      }
    });

    $('#tableProduct tbody').html(elementRow);
  }
  
</script
@endsection
