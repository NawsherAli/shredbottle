@extends('admin.layouts.layout')
@section('contents')
 <div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-9 order-sm-1 order-1 col-12 ">
        <h3 class="title-responsive"> <a href="{{route('profile.request.index')}}"> <i class="anticon anticon-left text-primary "></i> </a> Profile Request Details </h3>
    </div>
    <div class="col-md-3 order-sm-3 order-2 col-6 ">
        <div class="dropdown dropdown-animated scale-left">
            <!-- <button type="button" class="btn badge-pending br-50" data-toggle="dropdown">
             <span>Status: Pending</span>
            </button> -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class=" ">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="d-flex align-items-center">
                        <div class="text-center text-sm-left ">
                            <div class="avatar avatar-image" style="width: 150px; height:150px">
                                <img src="{{asset('assets/images/avatars/'.$old_data->profile_image)}}" alt="">
                            </div>
                        </div>
                        <div class="text-center text-sm-left m-v-15 p-l-30">
                            <h2 class="m-b-5 title-responsive">{{$old_data->name}}!</h2>
                            <p class="text-dark m-b-20">{{$old_data->role}}</p>
                            <!-- <button class="btn btn-primary">View Profile</button> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class=" d-md-block d-none    col-1" style="border-left:1px solid #219653;"></div>
                        <div class="col-12 d-sm-none" style="border-top:1px solid #219653;"></div>

                        <div class="col">
                            <ul class="list-unstyled m-t-10">
                                <li class="row">
                                    <p class=" col-3 font-weight-semibold text-dark m-b-5">
                                        <!-- <i class="m-r-10 text-primary anticon anticon-mail"></i> -->
                                        <span class="text-primary">Contact: </span> 
                                    </p>
                                    <p class="col font-weight-semibold text-black">{{$old_data->contact}}</p>
                                </li>
                                <li class="row">
                                    <p class=" col-3 font-weight-semibold text-dark m-b-5">
                                        <!-- <i class="m-r-10 text-primary anticon anticon-phone"></i> -->
                                        <span class="text-primary">Email: </span> 
                                    </p>
                                    <p class="col font-weight-semibold text-black"> {{$old_data->email}}</p>
                                </li>
                                <li class="row">
                                    <p class="col-3 font-weight-semibold text-dark m-b-5">
                                        <!-- <i class="m-r-10 text-primary anticon anticon-compass"></i> -->
                                        <span class="text-primary">Address: </span> 
                                    </p>
                                    <p class="col font-weight-semibold text-black"> {{$old_data->fundraiser->address}}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
</div>
<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-9 order-sm-1 order-1 col-12 ">
        <h4 class="title-responsive"> Complete Request Details </h4>
    </div>
</div>
<div class="row flex-column  ">
    <div class="table-responsive">
        <div class="table-responsive  ">
                <table class="table table-sm ">
                    <tbody>
                        <tr>
                            <th></th>
                            <th>Old Data</th>
                            <th>Update to</th>
                        </tr>
                        <tr>
                            <th>Company Name</th>
                            <td>{{$old_data->fundraiser->company_name}}</td>
                            <td>{{$request_data->company_name}}</td>
                        </tr>
                        <tr>
                            <th>User Name</th>
                            <td>{{$old_data->name}}</td>
                            <td>{{$request_data->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$old_data->email}}</td>
                            <td>{{$request_data->email}}</td>
                        </tr>
                        <tr>
                            <th>Contact</th>
                            <td>{{$old_data->contact}}</td>
                            <td>{{$request_data->contact}}</td>
                        </tr>
                        <tr>
                            <th>Charity Type</th>
                            <td>{{$old_data->fundraiser->charity_type}}</td>
                            <td>{{$request_data->charity_type}}</td>
                        </tr>
                        <tr>
                            <th>Charity Type</th>
                            <td>{{$old_data->e_transfer_no}}</td>
                            <td>{{$request_data->e_transfer_no}}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{$old_data->fundraiser->address}}</td>
                            <td>{{$request_data->address}}</td>
                        </tr>
                        <tr>
                            <th>Vision & Mission</th>
                            <td>{{$old_data->fundraiser->vision_mission}}</td>
                            <td>{{$request_data->vission_mission}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
</div>
<form method="POST" action="{{route('request.update', ['id' => $request_data->id])}}"  enctype="multipart/form-data" class="mt-5">
 @csrf
 @method('PUT')
     <div class="form-group col-md-6  ">
        <button type="submit" class="btn  btn-primary"  >Update Profile</button>
    </div>
</div>
</form>
@endsection