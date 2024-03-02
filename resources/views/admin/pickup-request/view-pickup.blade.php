@extends('admin.layouts.layout')
@section('contents')
<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-9 order-sm-1 order-1 col-6 ">
        <h3 class="title-responsive"><a href="{{route('admin.pickup')}}"> <i class="anticon anticon-left text-primary "></i> </a> Pickup Details </h3>
    </div>
    <div class="col-md-3 order-sm-3 order-2 col-6 ">
        <div class="dropdown dropdown-animated scale-left">
            @if($pickup->status == 'Completed')
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
                                <img src="{{asset('assets/images/avatars/'.$pickup->customer->user->profile_image)}}" alt="">
                            </div>
                        </div>
                        <div class="text-center text-sm-left m-v-15 p-l-30">
                            <h2 class="m-b-5 title-responsive">{{$pickup->customer->user->name}} !</h2>
                            <p class="font-weight-semibold text-dark m-b-5">
                                <i class="m-r-10 text-primary anticon anticon-phone"></i>
                                <span class=" ">+{{$pickup->customer->user->contact}}</span> 
                            </p>
                            <p class="font-weight-semibold text-dark m-b-5">
                                <i class="m-r-10 text-primary anticon anticon-mail"></i>
                                <span class=" ">{{$pickup->customer->user->email}}</span> 
                            </p>
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
                                        <span class="text-primary">Location: </span> 
                                    </p>
                                    <p class="col font-weight-semibold text-black">{{$pickup->pickup_location}}</p>
                                </li>
                                <li class="row">
                                    <p class=" col-3 font-weight-semibold text-dark m-b-5">
                                        <!-- <i class="m-r-10 text-primary anticon anticon-phone"></i> -->
                                        <span class="text-primary">User ID: </span> 
                                    </p>
                                    <p class="col font-weight-semibold text-black">{{$pickup->id}}</p>
                                </li>
                                <li class="row">
                                    <p class="col-3 font-weight-semibold text-dark m-b-5">
                                        <!-- <i class="m-r-10 text-primary anticon anticon-compass"></i> -->
                                        <span class="text-primary">Address: </span> 
                                    </p>
                                    <p class="col-7 font-weight-semibold text-black">{{$pickup->customer->address}}</p>
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
    <div class="col-md-9 order-sm-1 order-1 col-6 ">
        <h4 class="title-responsive"> Complete Pickup Details </h4>
    </div>
</div>
<div class="row flex-column  ">
    <div class="table-responsive">
        <div class="table-responsive  ">
                <table class="table table-sm ">
                    <tbody>
                        <tr class="">
                            <th scope="col" class="text-primary">ID</th>
                            <td scope="col" class="">{{$pickup->id}}</td>
                        </tr>
                        <tr class="">
                            <th scope="col" class="text-primary">Pickup Location</th>
                            <td scope="col" class="">{{$pickup->pickup_location}}</td>
                        </tr>
                        <tr class="">
                            <th scope="col" class="text-primary">Pickup Date</th>
                            <td scope="col" class="">{{$pickup->pickup_date}}</td>
                        </tr>
                        <tr class="">
                            <th scope="col" class="text-primary">Pickup Contact</th>
                            <td scope="col" class="">{{$pickup->pickup_contact}}</td>
                        </tr>
                        <tr class="">
                            <th scope="col" class="text-primary">Pickup Service</th>
                            <td scope="col" class="">{{$pickup->pickup_service}}</td>
                        </tr>
                        <tr class="">
                            <th scope="col" class="text-primary">Payment Option</th>
                            <td scope="col" class="">{{$pickup->payment_option}}</td>
                        </tr>
                        <tr class="">
                            <th scope="col" class="text-primary">Charity Type Option</th>
                            <td scope="col" class="">{{$pickup->charity_type}}</td>
                        </tr>
                        <tr class="">
                            <th scope="col" class="text-primary">Charity Organization</th>
                            <td scope="col" class="">{{optional($pickup->fundraiser)->company_name}}</td>
                        </tr>
                        <tr class="">
                            <th scope="col" class="text-primary">Total Items</th>
                            <td scope="col" class="">{{$pickup->total_items}}</td>
                        </tr>
                        <tr class="">
                            <th scope="col" class="text-primary">Amount</th>
                            <td scope="col" class="">{{$pickup->amount}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
</div>
<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-9 order-sm-1 order-1 col-6 ">
        <h4 class="title-responsive">Pickup Items</h4>
    </div>
</div>
<div class="row flex-column  ">
    <div class="table-responsive">
        <div class="table-responsive  ">
                <table class="table table-sm ">
                    <tbody>
                       <tr class="bg-primary">
                            <th scope="col" class="text-white">ID</th>
                            <th scope="col" class="text-white">Type</th>
                            <th scope="col" class="text-white">No Of Bags</th>
                            <th scope="col" class="text-white">No Of Boxes</th>
                            <th scope="col" class="text-white">Request No Boxes</th>
                            <th scope="col" class="text-white">Quantity</th>
                            <th scope="col" class="text-white">Amount</th>
                       </tr>
                       @foreach($pickup->items as $item)
                        <tr class="">
                           <td scope="col" class="">{{ $item->id }}</td>
                            <td scope="col" class="">{{ $item->items_type }}</td>
                            <td scope="col" class="">{{ $item->no_of_bags }}</td>
                            <td scope="col" class="">{{ $item->no_of_boxes }}</td>
                            <td scope="col" class="">{{ $item->req_no_boxes }}</td>
                            <td scope="col" class="">{{ $item->quantity }}</td>
                            <td scope="col" class="">{{ $item->amount }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>
<form method="POST" action="{{route('pickup.update', ['id' => $pickup->id])}}"  enctype="multipart/form-data" class="mt-5">
 @csrf
 @method('PUT')
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="quantity_of_bottels" class="text-primary">Quantity Of Bottles</label>
            <input type="number" class="form-control" id="quantity_of_bottels" placeholder="Enter total number of bottles" name="quantity_of_bottels">
        </div>
        <div class="form-group col-md-6">
            <label for="amount_of_bottles" class="text-primary">Amount</label>
            <input type="number" class="form-control" id="amount_of_bottles" placeholder="Enter Total amount of Bottles" name="amount_of_bottles">
        </div>
    </div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="quantity_of_clothes" class="text-primary">Quantity Of Clothes</label>
        <input type="number" class="form-control" id="quantity_of_clothes" placeholder="Enter total number of clothes items" name="quantity_of_clothes">
    </div>
    <div class="form-group col-md-6">
        <label for="amount_of_clothes" class="text-primary">Amount</label>
        <input type="number" class="form-control" id="amount_of_clothes" placeholder="Enter Total amount of clothes items" name="amount_of_clothes">
    </div>
</div>
<div class="form-row">
    
    <div class="form-group col-md-6">
        <label for="quantity_of_electronics" class="text-primary">Quantity Of Electronics</label>
        <input type="number" class="form-control" id="quantity_of_electronics" placeholder="Enter total number of electronics items" name="quantity_of_electronics">
    </div>
    <div class="form-group col-md-6">
        <label for="amount_of_electronics" class="text-primary">Amount</label>
        <input type="number" class="form-control" id="amount_of_electronics" placeholder="Enter Total amount of electronics items" name="amount_of_electronics">
    </div>
    <div class="form-group col-md-6  ">
        <button type="submit" class="btn  btn-primary"  >Update</button>
    </div>
</div>
</form>
@endsection
