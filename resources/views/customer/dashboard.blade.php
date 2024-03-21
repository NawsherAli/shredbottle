@extends('customer.layouts.layout')
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
                                    <img src="{{asset('assets/images/avatars/'.Auth::user()->profile_image)}}" alt="">
                                </div>
                            </div>
                            <div class="text-center text-sm-left m-v-15 p-l-30">
                                <h2 class="m-b-5 title-responsive">Hello, {{ Auth::user()->name }}!</h2>
                                <p class="text-dark m-b-20">{{ Auth::user()->role }}</p>
                                <a href="{{route('customer.profile.edit')}}" class="btn btn-primary">View Profile</a>
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
                                            <span class="text-primary">User ID: </span> 
                                        </p>
                                        <p class="col font-weight-semibold text-black">STB00{{ Auth::user()->id }}</p>
                                    </li>
                                    <li class="row">
                                        <p class=" col-3 font-weight-semibold text-dark m-b-5">
                                            <!-- <i class="m-r-10 text-primary anticon anticon-phone"></i> -->
                                            <span class="text-primary">Email: </span> 
                                        </p>
                                        <p class="col font-weight-semibold text-black"> {{ Auth::user()->email }}</p>
                                    </li>
                                    <li class="row">
                                        <p class="col-3 font-weight-semibold text-dark m-b-5">
                                            <!-- <i class="m-r-10 text-primary anticon anticon-compass"></i> -->
                                            <span class="text-primary">Address: </span> 
                                        </p>
                                        <p class="col-9 font-weight-semibold text-black"> {{ optional($customer)->address}}</p>
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
                            <img src="../assets/icons/cash-out.png">
                        </div>
                        <p class="m-b-0 text-primary" style="font-size: 10px">Total Cashed Out</p>
                    
                        <h2 class="m-b-0 text-primary">
                            <span>${{$user_cashout_amount}} </span>
                        </h2>
                        <p class="text-primary" style="font-size: 10px">+{{$this_week_total_cashout}}$ this week</p>
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
                        <p class="m-b-0 text-primary" style="font-size: 10px">Total Donated </p>
                    
                        <h2 class="m-b-0 text-primary">
                            <span>${{$user_donated_amount}}</span>
                        </h2>
                        <p class="text-primary" style="font-size: 10px">+{{$this_week_donation}}$ this week</p>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-2 col-6">
            <div class="card bg-primary-light br-tl-br-50">
                <div class="card-body flex-column align-items-center justify-content-center">
                    <div class="">
                        <div class="bg-primary p-5 d-flex justify-content-center align-items-center br-tl-br-20 icon-box">
                            <img src="../assets/icons/money-bag.png">
                        </div>
                        <p class="m-b-0 text-primary" style="font-size: 10px">Total Balance</p>
                    
                        <h2 class="m-b-0 text-primary">
                            <span>${{ $customer->current_balance }}</span>
                        </h2>
                        <p class="text-primary" style="font-size: 10px">+{{$this_week_total_cashout_amount}} $ this week</p>
                    </div>    
                </div>
            </div>
        </div>
         <div class="col-md-6 col-lg-6 col-6">
            <div class="card border-primary1 br-tl-br-50">
                <div class="card-body flex-column align-items-center justify-content-center">
                    <div class="">
                        <div class="p-5 d-flex justify-content-center align-items-center">
                            <h2 class="title-responsive">Quick Actions</h2>
                         </div> 
                        <div class="p-5 d-flex justify-content-center align-items-center">
                            @if($customer->current_balance >= 3)
                                <a href="#" onclick="customerClaimBalance({{ $customer->id }})" class="btn btn-primary btn-responsive-text">Claim Balance </a>
                                @else
                                <a href="#" class="btn btn-responsive-text badge-pending">Claim Balance </a>
                            @endif
                         </div> 
                        <div class="p-5 d-flex justify-content-center align-items-center">
                            <a href="{{route('customer.fundraiser.index')}}" class="btn btn-primary btn-responsive-text">View Fundraisers</a>
                         </div> 
                         <p></p>
                    </div>    
                </div>
            </div>
        </div>                      
    </div>
<!-- Latest Pickups and donations -->
@include('common-components.latest-pickup-donations')
<form id="claim-balace-form-{{ $customer->id }}" action="{{ route('admin.claim.balance.request', ['id' => $customer->id]) }}" method="post" style="display: none;">
    @csrf
    @method('POST')
    <input type="text" hidden name="user_id" value="{{Auth::user()->id}}">
</form>

<script>
    function customerClaimBalance(customerId) {
        if (confirm('Are you sure to submit claim balance request!')) {
            document.getElementById('claim-balace-form-' + customerId).submit();
        }
    }
</script>
@endsection