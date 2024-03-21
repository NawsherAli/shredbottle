@extends('fundraiser.layouts.layout')
@php
   $role = Auth::user()->role;
   $image = Auth::user()->profile_image;
@endphp 
@section('contents')
<div class="row">
    <div class="col-12">
        <div class=" ">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="d-flex align-items-center">
                        <div class="text-center text-sm-left ">
                            <div class="avatar avatar-image" style="width: 150px; height:150px">
                                <img src='{{asset("assets/images/avatars/$image")}}' alt="">
                            </div>
                        </div>
                        <div class="text-center text-sm-left m-v-15 p-l-30">
                            <h2 class="m-b-5 title-responsive">Hello, {{ Auth::user()->name }}</h2>
                            <p class="text-dark m-b-20">{{ Auth::user()->role }} {{$fundraiser->company_name}}</p>
                            <a href="{{route('fundraiser.profile.edit')}}" class="btn btn-primary">View Profile</a>
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
                                        <span class="text-dark">Location: </span> 
                                    </p>
                                    <p class="col font-weight-semibold text-black">Northwest Area</p>
                                </li>
                                <li class="row">
                                    <p class=" col-3 font-weight-semibold text-dark m-b-5">
                                        <!-- <i class="m-r-10 text-primary anticon anticon-phone"></i> -->
                                        <span class="text-dark">User ID: </span> 
                                    </p>
                                    <p class="col font-weight-semibold text-black"> STB00{{ Auth::user()->id }}</p>
                                </li>
                                <li class="row">
                                    <p class="col-3 font-weight-semibold text-dark m-b-5">
                                        <!-- <i class="m-r-10 text-primary anticon anticon-compass"></i> -->
                                        <span class="text-dark">Address: </span> 
                                    </p>
                                    <p class="col-9 font-weight-semibold text-black"> {{ optional($fundraiser)->address}}</p>
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
<div class="row pb-3">
    <div class="col-md-6 col-lg-2 col-6">
        <div class="card bg-primary-light br-tl-br-50">
            <div class="card-body flex-column align-items-center justify-content-center">
                <div class="">
                    <div class="bg-primary p-5 d-flex justify-content-center align-items-center br-tl-br-20 icon-box">
                        <img src="../assets/icons/star.png">
                    </div>
                    <p class="m-b-0 text-primary" style="font-size: 10px">Goal</p>
                
                    <h2 class="m-b-0 text-primary">
                        <span>${{$fundraiser->goal}} </span>
                    </h2>
                    <p class="text-primary" style="font-size: 10px">${{$user_cashout_amount}} cashout</p>
                </div>    
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-2 col-6">
        <div class="card bg-primary-light br-tl-br-50">
            <div class="card-body flex-column align-items-center justify-content-center">
                <div class="">
                    <div class="bg-primary p-5 d-flex justify-content-center align-items-center br-tl-br-20 icon-box">
                        <img src="../assets/icons/donate.png">
                    </div>
                    <p class="m-b-0 text-primary" style="font-size: 10px">Pending Donations</p>
                
                    <h2 class="m-b-0 text-primary">
                        <span>${{$pending_donations}} </span>
                    </h2>
                    <p class="text-primary" style="font-size: 10px">+{{$thisweekpendingdonation}}$ this week</p>
                </div>    
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-2 col-6">
        <div class="card bg-primary-light br-tl-br-50">
            <div class="card-body flex-column align-items-center justify-content-center">
                <div class="">
                    <div class="bg-primary p-5 d-flex justify-content-center align-items-center br-tl-br-20 icon-box">
                        <img src="../assets/icons/cash-out.png">
                    </div>
                    <p class="m-b-0 text-primary" style="font-size: 10px">Total Balance</p>
                
                    <h2 class="m-b-0 text-primary">
                        <span>${{$fundraiser->current_balance}}</span>
                    </h2>
                    <p class="text-primary" style="font-size: 10px">+{{$thisweekdonation}} this week</p>
                </div>    
            </div>
        </div>
    </div>
     <div class="col-md-6 col-lg-6 col-6">
        <div class="card border-primary1 br-tl-br-50 ">
            <div class="card-body flex-column align-items-center justify-content-center">
                <div class="">
                    <div class="p-5 d-flex justify-content-center align-items-center">
                        <h2 class="title-responsive">Quick Actions</h2>
                     </div> 
                    <div class="p-5 d-flex justify-content-center align-items-center">
                        @if($fundraiser->current_balance >= 30)
                        <a href="#" onclick="fundraiserClaimBalance({{ $fundraiser->id }})" class="btn btn-primary btn-responsive-text">Claim Balance </a>
                        @else
                        <a href="#" class="btn btn-responsive-text badge-pending">Claim Balance </a>
                        @endif

                     </div> 
                     <p>You can claim your balance when your amount is 150 dollers</p>
                    <!-- <div class="p-5 d-flex justify-content-center align-items-center">
                        <button class="btn btn-primary btn-responsive-text">View Fundraisers</button>
                     </div> 
                     <p></p> -->
                </div>    
            </div>
        </div>
    </div>                      
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between" style="padding: 0px">
           <ul class="nav nav-tabs" id="myTab" role="tablist" >
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" style="padding: 0px">Latest Donations</a>
                </li>
            </ul>
        <a href="{{route('fundraiser.donations')}}" class="btn btn-primary">View All Donations</a> 
        </div>
           
    <div class="tab-content m-t-15" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

             <div class="table-responsive d-none d-sm-block">
                <table class="table table-sm text-center">
                        <thead>
                            <tr class="bg-primary">
                                <th scope="col" class="text-white">ID</th>
                                <th scope="col" class="text-white">Donor Name</th>
                                <th scope="col" class="text-white">Donation Amount</th>
                                <th scope="col" class="text-white">Charity Type</th>
                                <th scope="col" class="text-white">Charity Name</th>
                                <th scope="col" class="text-white">Number of Items Donated</th>
                                <th scope="col" class="text-white">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($donations) > 0)
                            @foreach($donations as $donate)
                            <tr>
                                <th scope="row"> {{$loop->iteration}}</th>
                                <td>{{$donate->donor->user->name}}</td>
                                <td>{{$donate->amount}}</td>
                                <td>{{$donate->charity_type}}</td>
                                <td>{{$donate->charity->company_name}}</td>
                                <td>{{$donate->no_of_items}}</td>
                                <td>
                                @if($donate->status == 'Completed')
                                <span class="badge badge-pill badge-success mr-3">Completed</span>
                                @else
                                <span class="badge badge-pill badge-pending mr-3">Pending</span>
                                @endif
                                @if($role == 'admin')
                                <a href='{{route("$role.donations.donor.view",["id"=>$donate->donor->user->id])}}' class="badge badge-pill badge-green"><i class="fas fa-external-link-alt    br-100"></i></a>
                                @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                                <tr><td>No Record Found</td> </tr>
                            @endif
                        </tbody>
                    </table>

            </div>
            <div class="">
                    @if(count($donations) > 0)
                    @foreach($donations as $donate)
                    <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
                         <div class="d-flex justify-content-between" >
                             <p class="text-black"><b>ID:</b> {{$donate->id}}</p>
                             <p class="text-black"><i class="far fa-calendar-alt"></i> {{$donate->created_at}}</p>
                         </div>
                         <div class="d-flex justify-content-between" >
                             <h3 class="text-primary">{{$donate->donor->user->name}}</h3>
                             <h3 class="text-primary">${{$donate->amount}}</h3>
                         </div>
                         <div class="d-flex justify-content-between" >
                             <p class="text-black"><b>Charity Type:</b> {{$donate->charity_type}}</p>
                             <p class="text-black"><b>Charity Name:</b> {{$donate->charity->company_name}}</p>
                         </div>
                         <div class="" >
                                @if($donate->status == 'Completed')
                                <span class="badge badge-pill badge-success mr-3">Completed</span>
                                @else
                                <span class="badge badge-pill badge-pending mr-3">Pending</span>
                                @endif
                              @if($role == 'admin')
                              <a href='{{route("$role.donations.donor.view",["id"=>$donate->donor->user->id])}}' class="badge badge-pill badge-green"><i class="fas fa-external-link-alt    br-100"></i>
                              @endif
                              </a>
                        </div>
                    </div>
                    @endforeach
                    {{ $donations->links('vendor.pagination.default') }}
                    @endif
                </div>
        </div>
    </div>
    </div>
    
</div>
<form id="claim-balace-form-{{ $fundraiser->id }}" action="{{ route('admin.claim.balance.request', ['id' => $fundraiser->id]) }}" method="post" style="display: none;">
    @csrf
    @method('POST')
    <input type="text" hidden name="user_id" value="{{Auth::user()->id}}">
</form>

<script>
    function fundraiserClaimBalance(customerId) {
        if (confirm('Are you sure to submit claim balance request!')) {
            document.getElementById('claim-balace-form-' + customerId).submit();
        }
    }
</script>
@endsection