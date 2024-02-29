@extends('admin.layouts.layout')
@section('contents')
 <div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-6 order-sm-1 order-1 col-8">
        <h1>Profile Requests</h1>
    </div>
    <div class="col-md-4 order-sm-2 order-3 ">
        <form id="searchForm" method="GET" action="{{ route('profile.request.search') }}">
            <div class="input-affix m-b-10">
                <input type="text" class="form-control" placeholder="Search" name="search">
                <i class="suffix-icon anticon anticon-search" id="searchIcon"></i>
            </div>
        </form>
    </div>
    <div class="col-md-2 order-sm-3 order-2 col-4 ">
        <div class="dropdown dropdown-animated scale-left">
            <button type="button" class="btn btn-primary" data-toggle="dropdown">
                <i class="fas fa-sliders-h"></i>
            <!-- <img src="assets/icons/filter-icon.png"> -->
            <span>Filter</span>
            </button>
            <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('requests.filter', ['sort' => 'latest']) }}">Latest Requests</a>    
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
                            <th scope="col" class="text-white">Company Name</th>
                            <th scope="col" class="text-white">Email</th>
                            <th scope="col" class="text-white">Contact</th>
                            <th scope="col" class="text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($requests) > 0)
                        @foreach($requests as $request)
                            <tr>
                                <th scope="row"> {{$loop->iteration}}</th>
                                <td>{{$request->user->name}}</td>
                                <td>{{$request->company_name}}</td>
                                <td>{{$request->email}}</td>
                                <td>{{$request->contact}}</td>
                                <td>
                                <a href='{{route("profile.request.view",["id"=>$request->id])}}' class="badge badge-pill badge-green"><i class="fas fa-external-link-alt    br-100"></i></a></td>
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
@if(count($requests) > 0)
@foreach($requests as $request)
<div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">

     <div class="d-flex justify-content-between" >
         <p class="text-black"><b>ID: </b>{{$request->id}}</p>
         <p class="text-black"><i class="far fa-envalope"></i> {{$request->user->email}}</p>
     </div>
     <div class="d-flex justify-content-between" >
         <h5 class="text-primary">{{$request->user->name}}</h5>
         <h5 class="text-primary">{{$request->company_name}}</h5>
     </div>
     <div class="d-flex justify-content-between" >
         <p class="text-black"><i class="anticon anticon-phone text-primary"></i>{{$request->contact}}</p>
         <div class="" >
            
          <a href='{{route("profile.request.view",["id"=>$request->id])}}' class="badge badge-pill badge-green"><i class="fas fa-external-link-alt    br-100"></i></a>
         </div>
     </div>
</div>
@endforeach
{{ $requests->links('vendor.pagination.default') }}
@else
 <p class="d-block d-sm-none">No record found</p>
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