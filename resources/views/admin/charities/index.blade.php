@extends('admin.layouts.layout')
@section('contents')

<div class="row mb-3">
    <div class="col-md-6 order-sm-1 order-1 col-7 mt-2" >
        <h1 class="title-responsive">All Charity Types</h1>
    </div>
    <div class="col-12 col-md-4 order-sm-2 order-3  mt-3  " >
        <!-- <div class="input-affix  ">
            <input type="text" class="form-control" placeholder="Search" name="search">
            <i class="suffix-icon anticon anticon-search"></i>
        </div> -->
        <form id="searchForm" method="GET" action="{{ route('charities.search') }}">
            <div class="input-affix  ">
            <input type="text" class="form-control" placeholder="Search" name="search">
                <i class="suffix-icon anticon anticon-search" id="searchIcon"></i>
            </div>
            <!-- <button type="submit" class="btn btn-primary">Search</button> -->
        </form>
    </div>
    <div class="col-md-2 order-sm-3 order-2 col-5 d-flex justify-content-end align-items-center mt-2" >
        <a  href="{{route('charities.create')}}" class="btn btn-primary mr-2">
                <i class="fas plus">+</i>
                <span class="hide-xs">Add New</span>
        </a>
        <!-- <div class="dropdown dropdown-animated scale-left">
            <button type="button" class="btn btn-primary" data-toggle="dropdown">
                <i class="fas fa-sliders-h"></i> -->
            <!-- <img src="assets/icons/filter-icon.png"> -->
            <!-- <span>Filter</span>
            </button>
            <div class="dropdown-menu">
                <button class="dropdown-item" type="button">Sort By Lates Funds</button>
                <button class="dropdown-item" type="button">Sort By Higest Funds</button>
            </div>
        </div> -->
    </div>
</div>
<div class="pb-3 " style="border-top:2px solid #219653;"></div>
<div class="row flex-column d-none d-sm-block">
    <div class="table-responsive">
        <table class="table table-sm text-center">
            <thead>
                <tr class="bg-primary">
                    <th scope="col" class="text-white">ID</th>
                    <th scope="col" class="text-white">Image</th>
                    <th scope="col" class="text-white">Charity Name</th>
                    <th scope="col" class="text-white">Short Description</th>
                    <th scope="col" class="text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($charities) > 0)
                @foreach($charities as $charity)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><img src='{{asset("assets/images/charities/$charity->image")}}'  alt="" height="200px" width="200px"></td>
                    <td>{{$charity->name}}</td>
                    <td width="400px">{!!$charity->short_desc!!}</td>
                    <td>
                        
                        <a href="{{ route('charities.edit', ['id' => $charity->id]) }}" class="badge badge-pill badge-blue"><i class="fas fa-edit    br-100"></i></a>
                        <a href="#" data-toggle="modal" data-target="#charityDelete{{$charity->id}}" class="badge badge-pill badge-red"><i class="fas fa-trash-alt   br-100"></i> </a>

                        <!-- Modal -->
                        <div class="modal fade" id="charityDelete{{$charity->id}}">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <form id="charity-delete-form-{{ $charity->id }}" action="{{ route('charities.destroy', ['id' => $charity->id]) }}" method="post" style="">
                                @csrf
                                @method('POST')
                                
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation!</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <i class="anticon anticon-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- <input type="text" name="" value="{{$charity->id}}"> -->
                                        <p>Are you sure to Delete this charity record!</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-primary">Yes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>                        
                    </td>
                </tr>
                @endforeach
                @else
                    <td>No record found</td>
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="">
     @foreach($charities as $charity)
    <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
         <div class="d-flex justify-content-between" >
             <p class="text-black"><b>ID:</b> {{$loop->iteration}}</p>
         </div>
         <div class="d-flex justify-content-between" >
             <h3 class="text-primary">{{$charity->name}}</h3>
         </div>
         <div>
             <p class="text-black"><b>Descriptions:</b>{!!$charity->short_desc!!}</p>
         </div>
         <div class="d-flex justify-content-end align-items-center" >
                <a href="{{ route('charities.edit', ['id' => $charity->id]) }}" class="badge badge-pill badge-blue"><i class="fas fa-edit    br-100"></i></a>
                <a href="#" data-toggle="modal" data-target="#MobilecharityDelete{{$charity->id}}" class="badge badge-pill badge-red"><i class="fas fa-trash-alt   br-100"></i> </a>

                        <!-- Modal -->
                        <div class="modal fade" id="MobilecharityDelete{{$charity->id}}" >
                            <div class="modal-dialog modal-dialog-left"  >
                                <div class="modal-content"  >
                                <form id="charity-delete-form-{{ $charity->id }}" action="{{ route('charities.destroy', ['id' => $charity->id]) }}" method="post" style="">
                                @csrf
                                @method('POST')
                                
                                    <div class="modal-header"   >
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation!</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <i class="anticon anticon-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- <input type="text" name="" value="{{$charity->id}}"> -->
                                        <p>Are you sure to Delete this charity record!</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-primary">Yes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
         </div>
    </div>
    @endforeach
    {{ $charities->links('vendor.pagination.default') }}
</div>

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
@endsection