@extends('admin.layouts.layout')
@section('contents')
 <div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-9 order-sm-1 order-1 col-12 ">
        <h3 class="title-responsive"> <a href="#" onclick="goBack()"> <i class="anticon anticon-left text-primary "></i> </a> Customer Transaction Details </h3>
    </div>
    <div class="col-md-3 order-sm-3 order-2 col-6 ">
        <div class="dropdown dropdown-animated scale-left">
            @if($transaction->status == 'Completed')
            <span type="button" class=" badge-success br-50 px-4 py-2" data-toggle="dropdown">
                <span>Status: Completed</span>
            </span>
            @else
            <span type="button" class=" badge-pending br-50 px-4 py-2" data-toggle="dropdown">
                <span>Status: Pending</span>
            </span>
            @endif
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
<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-9 order-sm-1 order-1 col-12 ">
        <h4 class="title-responsive"> Account Details </h4>
    </div>
</div> 
    <div class="row pb-3">
        <div class="col-md-6 col-lg-4 col-6">
            <div class="card bg-primary-light br-tl-br-50">
                <div class="card-body flex-column align-items-center justify-content-center">
                    <div class="">
                        <div class="bg-primary p-5 d-flex justify-content-center align-items-center br-tl-br-20 icon-box">
                            <img src="{{asset('assets/icons/cash-out.png')}}">
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
        <div class="col-md-6 col-lg-4 col-6">
            <div class="card bg-primary-light br-tl-br-50">
                <div class="card-body flex-column align-items-center justify-content-center">
                    <div class="">
                        <div class="bg-primary p-5 d-flex justify-content-center align-items-center br-tl-br-20 icon-box">
                            <img src="{{asset('assets/icons/donate.png')}}">
                        </div>
                        <p class="m-b-0 text-primary" style="font-size: 10px">Total Donated </p>
                    
                        <h2 class="m-b-0 text-primary">
                            <span>$ {{$user_donated_amount}}</span>
                        </h2>
                        <p class="text-primary" style="font-size: 10px">+ {{$this_week_donation}} $ this week</p>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-6">
            <div class="card bg-primary-light br-tl-br-50">
                <div class="card-body flex-column align-items-center justify-content-center">
                    <div class="">
                        <div class="bg-primary p-5 d-flex justify-content-center align-items-center br-tl-br-20 icon-box">
                            <img src="{{asset('assets/icons/money-bag.png')}}">
                        </div>
                        <p class="m-b-0 text-primary" style="font-size: 10px">Current Balance</p>
                    
                        <h2 class="m-b-0 text-primary">
                            <span>$ {{$transaction->customer->current_balance}} </span>
                        </h2>
                        <p class="text-primary" style="font-size: 10px">+ {{$this_week_total_cashout_amount}} $ this week</p>
                    </div>    
                </div>
            </div>
        </div>
  </div>
<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-9 order-sm-1 order-1 col-12 ">
        <h4 class="title-responsive"> Transaction Details </h4>
    </div>
</div>
<div class="row flex-column  ">
    <div class="table-responsive">
        <div class="table-responsive  ">
                <table class="table table-sm ">
                    <tbody>
                        <form method="POST" action="{{route('admin.transaction.update', ['id' => $transaction->id])}}"  enctype="multipart/form-data" class="mt-5">
                             @csrf
                             @method('PUT')
                        <tr>
                            <th></th>
                            <th>Transaction Data</th>
                        </tr>
                        <tr>
                            <th>Request ID</th>
                            <td><input type="text" name="company_name" value="{{$transaction->request_id}}" class="form-control" readonly=""> </td>
                        </tr>
                        <tr>
                            <th>Customer Name</th>
                            <td><input type="text" name="name" value="{{$transaction->customer->user->name}}" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <th>Request Date</th>
                            <td><input type="text" name="email" value="{{$transaction->request_date}}" class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <th>E Transfer No</th>
                            <td><input type="text" name="contact" value="{{$transaction->e_transfer_no}}" class="form-control" readonly></td>
                        </tr>
                        
                        @if($transaction->status == 'Pending' OR $transaction->status == 'Completed')
                        <tr>
                            <th>Transaction Amount</th>
                            <td><input type="text" name="amount" value="{{$transaction->amount}} " class="form-control" ></td>
                        </tr>
                        <tr>
                            <th>Transaction Date</th>
                            <td><input type="date" name="date" value="{{$transaction->transaction_date}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Transaction ID</th>
                            <td><input type="text" name="transaction_id" value="{{$transaction->transaction_no}} " class="form-control"></td>
                        </tr>
                        <tr>
                            <th> </th>
                            
                            <td>
                                 <div class="form-group col-md-6  ">
                                    <button type="submit" class="btn  btn-primary"  >Save Transaction Info</button>
                                </div>
                            </div>
                            </td>
                        </tr>
                        @else
                        <tr>
                            <th>Transaction Amount</th>
                            <td><input type="text" name="amount" value="{{$transaction->amount}} " class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <th>Transaction Date</th>
                            <td><input type="text" name="e_transfer_no" value="{{$transaction->transaction_date}} " class="form-control" readonly></td>
                        </tr>
                        <tr>
                            <th>Transaction ID</th>
                            <td><input type="text" name="e_transfer_no" value="{{$transaction->transaction_no}} " class="form-control" readonly></td>
                        </tr>
                        @endif
                        </form>
                    </tbody>
                </table>
            </div>
    </div>
</div>
@endsection