@extends('admin.layouts.layout')
@section('contents')
 <div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-9 order-sm-1 order-1 col-12 ">
        <h3 class="title-responsive"> <a href="#" onclick="goBack()"> <i class="anticon anticon-left text-primary "></i> </a> Transaction Details </h3>
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
                                <img src="{{asset('assets/images/avatars/'.$transaction->customer->user->profile_image)}}" alt="">
                            </div>
                        </div>
                        <div class="text-center text-sm-left m-v-15 p-l-30">
                            <h2 class="m-b-5 title-responsive">{{$transaction->customer->user->name}}!</h2>
                            <p class="text-dark m-b-20">{{$transaction->customer->user->role}}</p>
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
                                    <p class="col font-weight-semibold text-black">{{$transaction->customer->user->contact}}</p>
                                </li>
                                <li class="row">
                                    <p class=" col-3 font-weight-semibold text-dark m-b-5">
                                        <!-- <i class="m-r-10 text-primary anticon anticon-phone"></i> -->
                                        <span class="text-primary">Email: </span> 
                                    </p>
                                    <p class="col font-weight-semibold text-black"> {{$transaction->customer->user->email}}</p>
                                </li>
                                <li class="row">
                                    <p class="col-3 font-weight-semibold text-dark m-b-5">
                                        <!-- <i class="m-r-10 text-primary anticon anticon-compass"></i> -->
                                        <span class="text-primary">Address: </span> 
                                    </p>
                                    <p class="col font-weight-semibold text-black"> {{$transaction->customer->address}}</p>
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
 

@endsection