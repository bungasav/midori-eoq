@php
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
          <li class="breadcrumb-item active">Create</li>
        </ol>
      </nav>
    <div class="card">
        <div class="mb-4">
            <h5 class="card-header">Create Order</h5>
            <div class="card-body">
                <form id="formCreateOrder" class="mb-3" action="{{url('/order/store')}}" method="POST">
                  @csrf

                  @if($errors->any())
                  @foreach($errors->all() as $err)
                  <div class="alert alert-danger" role="alert">
                    {{ $err }}
                  </div>
                  @endforeach
                  @endif

              <div class="mb-3">
                    <label for="role" class="form-label">Supplier</label>
                    <select id="supllierOption " name="supplier" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                      @foreach($suppliers as $suplier)
                        <option value="{{$suplier->SupplierId}}">{{$suplier->Name}}</option>
                      @endforeach
                    </select>
                </div>

                <div class="mb-3">
                  <label for="role" class="form-label">Product</label>
                  <select id="productOption" name="product" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                    <option value="0">select product </option>

                    @foreach($products as $product)
                      <option value="{{$product->ItemId}}">{{$product->Name}}</option>
                    @endforeach
                  </select>
              </div>
              <div>
                <p> Product List </p>
                <table class="table table-bordered" id="tableProduct">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Jumlah</th>
                      <th>Harga</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0"> </tbody>
                </table>
              </div>
              <div class="mt-5">
                <button class="btn btn-primary d-grid w-100" type="submit">Submit</button>
              </div>
            </form>
          </div>
      </div>
</div>
<script type="module">
  var productList =  @json($products);
  var selectedProduct = {}


  window.onChangeTableProduct =  function (event,id,quantity){
    selectedProduct[id][quantity] = parseInt(event.value) 
  }

  window.deleteProductItem = function(id) {
    selectedProduct[id] = undefined
    createTable()
  }

  var createTable = function(){

    const elementRow = Object.keys(selectedProduct).map((key,index) => {

      let product = selectedProduct[key]

      if(product){
        return`
        <tr> 
          <td>
          <input type="hidden" name="item[${index}][id]"  value="${product.ItemId}"/>
          ${product.Name}
        </td>  
        <td>      
          <div class="">
            <input type="number" class="form-control" name="item[${index}][quantity]" value="${product.quantity}" required onchange="onChangeTableProduct(this,${product.ItemId},'quantity')" />
          </div>
        </td>  
        <td> 
          <div class="">
            <input type="number" class="form-control" name="item[${index}][basePrice]" value="${product.basePrice}"  required  onchange="onChangeTableProduct(this,${product.ItemId},'basePrice')" />
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

  $('#productOption').change(function() {
    const productId = $(this).val()

    const getDataByValue = productList.find(function(product){
      return  product.ItemId == productId
    } )
    selectedProduct = {...selectedProduct,[productId]:getDataByValue }
    if(productId !== 0){
      $('#productOption').val(0)
    }
    createTable();
  });
  
</script>
@endsection
