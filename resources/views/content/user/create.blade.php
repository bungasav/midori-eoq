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
            <a href="/user">User</a>
          </li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
      </nav>
    <div class="card">
        <div class="mb-4">
            <h5 class="card-header">Create User</h5>
            <div class="card-body">
                <form id="formCreateUser" class="mb-3" action="{{url('/user/store')}}" method="POST">
                  @csrf

                  @if($errors->any())
                  @foreach($errors->all() as $err)
                  <div class="alert alert-danger" role="alert">
                    {{ $err }}
                  </div>
                  @endforeach
                  @endif

              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" placeholder="name@example.com" />
              </div>
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" placeholder="john doe" />
              </div>
              <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select id="roleOption" name="role" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                </select>
              </div>
              <div class="mb-3">
                <label for="phoneNumber" class="form-label">PhoneNumber</label>
                <input type="tel" class="form-control" name="phoneNumber" placeholder="0810128312" />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <!-- <a href="{{url('auth/forgot-password-basic')}}">
                    <small>Forgot Password?</small>
                  </a> -->
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Submit</button>
              </div>
            </form>
          </div>
      </div>
</div>

<script type="module">
  $(document).ready(function() {
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "GET",
            url: "/role",
            dataType: 'json',
            success: function (data) {
                console.log(data)
                var listRole = data.map((role) => {
                  return `<option value="${role.RoleId}">${role.Name}</option>`
                })
                $('#roleOption').append(listRole)

                // jQuery('#myForm').trigger("reset");
                // jQuery('#formModal').modal('hide')
            },
            error: function (data) {
                console.log(data);
            }
        });
      console.log($.ajax);
  });
</script>
@endsection
