@extends('admin.layouts.layout')
@php
   $role = Auth::user()->role;
@endphp 
@section('contents')
<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-6 order-sm-1 order-1 col-7">
        <h1>Pickup List</h1>
    </div>
    <div class="col-md-4 order-sm-2 order-3 ">
        <form id="searchForm" method="GET" action="{{ route('pickup.search') }}">
            <div class="input-affix m-b-10">
                <input type="text" class="form-control" placeholder="Search by name" name="search">
                <i class="suffix-icon anticon anticon-search" id="searchIcon"></i>
            </div>
        </form>
    </div>
    <div class="col-md-2 order-sm-3 order-2 col-5 ">
        <div class="dropdown dropdown-animated scale-left">
            <button type="button" class="btn btn-primary" data-toggle="dropdown">
                <i class="fas fa-sliders-h"></i>
            <!-- <img src="assets/icons/filter-icon.png"> -->
            <span>Filter</span>
            </button>
            <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('pickups.filter', ['sort' => 'latest']) }}">Latest Pickups</a>
                  <a class="dropdown-item" href="{{ route('pickups.filter', ['sort' => 'completed']) }}">Completed Pickups</a>
                  <a class="dropdown-item" href="{{ route('pickups.filter', ['sort' => 'pending']) }}">Pending Pickups</a>
    
            </div>
        </div>
    </div>
</div>
<div class="row flex-column d-none d-sm-block">
    <div class="table-responsive">
        <div class="table-responsive d-none d-sm-block">
                <table class="table table-sm text-center">
                    <thead>
                        <tr class="bg-primary">
                            <th scope="col" class="text-white">ID</th>
                            <th scope="col" class="text-white">Customer Name</th>
                            <th scope="col" class="text-white">Phone Number</th>
                            <th scope="col" class="text-white">Pickup Quantity</th>
                            <th scope="col" class="text-white">Pickup Date</th>
                            <th scope="col" class="text-white">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($pickups) > 0)
                        @foreach($pickups as $pickup)
                            <tr>
                                <th scope="row"> {{$loop->iteration}}</th>
                                <td>{{$pickup->customer->user->name}}</td>
                                <td>{{$pickup->pickup_contact}}</td>
                                <td>{{$pickup->total_items}}</td>
                                <td>{{$pickup->pickup_date}}</td>
                                <td>
                                @if($pickup->status == 'Completed')
                                <span class="badge badge-pill badge-success mr-3">Completed</span>
                                @else
                                <span class="badge badge-pill badge-pending mr-3">Pending</span>
                                @endif
                                <a href='{{route("$role.pickup.view",["id"=>$pickup->id])}}' class="badge badge-pill badge-green"><i class="fas fa-external-link-alt    br-100"></i></a></td>
                            </tr>
                            @endforeach
                            @else
                                <td>No record found</td>
                            @endif
                    </tbody>
                </table>
            </div>
    </div>
</div>
<div class="">
@if(count($pickups) > 0)
@foreach($pickups as $pickup)
<div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
     <div class="d-flex justify-content-between" >
         <p class="text-black"><b>ID: </b>{{$loop->iteration}}</p>
         <p class="text-black"><i class="far fa-calendar-alt"></i> {{$pickup->pickup_date}}</p>
     </div>
     <div class="d-flex justify-content-between" >
         <h5 class="text-primary">{{$pickup->customer->user->name}}</h5>
         <h5 class="text-primary">{{$pickup->total_items}}</h5>
     </div>
     <div class="d-flex justify-content-between" >
         <p class="text-black"><i class="anticon anticon-phone text-primary"></i>{{$pickup->pickup_contact}}</p>
         <div class="" >
            @if($pickup->status == 'Completed')
            <span class="badge badge-pill badge-success mr-3">Completed</span>
            @else
            <span class="badge badge-pill badge-pending mr-3">Pending</span>
            @endif
          <a href='{{route("$role.pickup.view",["id"=>$pickup->id])}}' class="badge badge-pill badge-green"><i class="fas fa-external-link-alt    br-100"></i></a></td>
         </div>
     </div>
</div>
@endforeach
{{ $pickups->links('vendor.pagination.default') }}
@else
 <p>No record found</p>
@endif
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the search form and search icon elements
        var searchForm = document.getElementById('searchForm');
        var searchIcon = document.getElementById('searchIcon');

        // Add a click event listener to the search icon
        searchIcon.addEventListener('click', function() {
            // Submit the search form when the search icon is clicked
            searchForm.submit();
        });
    });
</script> 