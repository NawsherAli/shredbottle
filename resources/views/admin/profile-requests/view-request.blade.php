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
                        <form method="POST" action="{{route('request.update', ['id' => $request_data->id])}}"  enctype="multipart/form-data" class="mt-5">
                             @csrf
                             @method('PUT')
                        <tr>
                            <th></th>
                            <th>Old Data</th>
                            <th>Update to</th>
                        </tr>
                        <tr>
                            <th>Company Name</th>
                            <td>{{$old_data->fundraiser->company_name}}</td>
                            <td><input type="text" name="company_name" value="{{$request_data->company_name}}" class="form-control"> </td>
                        </tr>
                        <tr>
                            <th>User Name</th>
                            <td>{{$old_data->name}}</td>
                            <td><input type="text" name="name" value="{{$request_data->name}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$old_data->email}}</td>
                            <td><input type="text" name="email" value="{{$request_data->email}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Contact</th>
                            <td>{{$old_data->contact}}</td>
                            <td><input type="text" name="contact" value="{{$request_data->contact}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Charity Type</th>
                            <td>{{$old_data->fundraiser->charity_type}}</td>
                            <td><select id="charity_type" class="form-control" name="charity_type">
                               @foreach($charities as $charity)
                                     <option value="{{$charity->id}}" {{ $request_data->charity_type == $charity->name ? 'selected' : '' }}>{{$charity->name}}</option>
                                @endforeach
                            </select></td>
                        </tr>
                        <tr>
                            <th>E Transfer No</th>
                            <td>{{$old_data->e_transfer_no}}</td>
                            <td><input type="text" name="e_transfer_no" value="{{$request_data->e_transfer_no}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Goal</th>
                            <td>{{$old_data->fundraiser->goal}}</td>
                            <td><input type="text" name="goal" value="{{$request_data->goal}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Tax Slip Confirmation</th>
                            <td>{{$old_data->fundraiser->tax_slip}}</td>
                            <td>
                            
                            <select id="tax_slip_confirmation" class="form-control" name="tax_slip_confirmation">
                               <option value="Yes" {{ $request_data->tax_slip_confirmation == 'Yes' ? 'selected' : '' }}>Yes</option>
                               <option value="No" {{ $request_data->tax_slip_confirmation == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Unit Number</th>
                            <td>{{$old_data->fundraiser->unit_number}}</td>
                            <td><input type="text" name="unit_number" value="{{$request_data->unit_number}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Street Address</th>
                            <td>{{$old_data->fundraiser->street_address}}</td>
                            <td><input type="text" name="street_address" value="{{$request_data->street_address}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>{{$old_data->fundraiser->city}}</td>
                            <td><input type="text" name="city" value="{{$request_data->city}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Province</th>
                            <td>{{$old_data->fundraiser->province}}</td>
                            <td><select id="province" name="province" required class="form-control">
                                <option value="">Select Province</option>
                                <option value="Alberta" {{ optional($request_data)->province == 'Alberta' ? 'selected' : '' }}>Alberta</option>
                                <option value="British Columbia" {{ optional($request_data)->province == 'British Columbia' ? 'selected' : '' }}>British Columbia</option>
                                <option value="Manitoba" {{ optional($request_data)->province == 'Manitoba' ? 'selected' : '' }}>Manitoba</option>
                                <option value="New Brunswick" {{ optional($request_data)->province == 'New Brunswick' ? 'selected' : '' }}>New Brunswick</option>
                                <option value="Newfoundland and Labrador" {{ optional($request_data)->province == 'Newfoundland and Labrador' ? 'selected' : '' }}>Newfoundland and Labrador</option>
                                <option value="Nova Scotia" {{ optional($request_data)->province == 'Nova Scotia' ? 'selected' : '' }}>Nova Scotia</option>
                                <option value="Ontario" {{ optional($request_data)->province == 'Ontario' ? 'selected' : '' }}>Ontario</option>
                                <option value="Prince Edward Island" {{ optional($request_data)->province == 'Prince Edward Island' ? 'selected' : '' }}>Prince Edward Island</option>
                                <option value="Quebec" {{ optional($request_data)->province == 'Quebec' ? 'selected' : '' }}>Quebec</option>
                                <option value="Saskatchewan" {{ optional($request_data)->province == 'Saskatchewan' ? 'selected' : '' }}>Saskatchewan</option>
                                <option value="Northwest Territories" {{ optional($request_data)->province == 'Northwest Territories' ? 'selected' : '' }}>Northwest Territories</option>
                                <option value="Nunavut" {{ optional($request_data)->province == 'Nunavut' ? 'selected' : '' }}>Nunavut</option>
                                <option value="Yukon" {{ optional($request_data)->province == 'Yukon' ? 'selected' : '' }}>Yukon</option>
                            </select></td>
                        </tr>
                        <tr>
                            <th>Postal Code</th>
                            <td>{{$old_data->fundraiser->postal_code}}</td>
                            <td><input type="text" name="postal_code" value="{{$request_data->postal_code}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Vision </th>
                            <td>{{$old_data->fundraiser->vision}}</td>
                            <td><input type="text" name="vision" value="{{$request_data->vision}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Mission</th>
                            <td>{{$old_data->fundraiser->vision_mission}}</td>
                            <td><input type="text" name="vission_mission" value="{{$request_data->vission_mission}}" class="form-control"></td>
                        </tr>
                        <tr>
                            <th>Status </th>
                            <td>
                                @if($request_data->status == 'Completed')
                                    <span class="badge badge-pill badge-success mr-3">Completed</span>
                                @else
                                    <span class="badge badge-pill badge-pending mr-3">Pending</span>
                                @endif     
                            </td>
                            <td>
                                 <div class="form-group col-md-6  ">
                                    <button type="submit" class="btn  btn-primary"  >Update Profile</button>
                                </div>
                            </div>
                            </td>
                        </tr>
                        </form>
                    </tbody>
                </table>
            </div>
    </div>
</div>

@endsection