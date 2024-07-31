@extends('fundraiser.layouts.layout')
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
                                <img src='{{asset("assets/images/avatars/$user->profile_image")}}' alt="">
                            </div>
                        </div>
                        <div class="text-center text-sm-left m-v-15 p-l-30">
                            <h2 class="m-b-5 title-responsive">Hello, {{$user->name}}</h2>
                            <p class="text-dark m-b-20">{{$user->role}}</p>
                            <form id="profilePictureForm" action="{{ route('update.profile.picture') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="image" class="btn btn-primary  ">Upload Image</label>
                                <input type="file" name="image" id="image" style="display: none;" onchange="submitForm()">
                            </form>
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
                                    <p class="col font-weight-semibold text-black">+{{ Auth::user()->contact }}</p>
                                </li>
                                <li class="row">
                                    <p class=" col-3 font-weight-semibold text-dark m-b-5">
                                        <!-- <i class="m-r-10 text-primary anticon anticon-phone"></i> -->
                                        <span class="text-primary">User ID: </span> 
                                    </p>
                                    <p class="col font-weight-semibold text-black"> STBFD00{{ Auth::user()->id }}</p>
                                </li>
                                <li class="row">
                                    <p class="col-3 font-weight-semibold text-dark m-b-5">
                                        <!-- <i class="m-r-10 text-primary anticon anticon-compass"></i> -->
                                        <span class="text-primary">Address: </span> 
                                    </p>
                                    <p class="col-9 font-weight-semibold text-black">{{$user->fundraiser->address}}</p>
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

<!-- Row 3 -->
<div class="row">
    <div class="col-md-12 d-flex justify-content-between">
        <h3 class="title-with-line title-responsive">Profile Update Request &nbsp;</h3>
        <!-- <button class="btn btn-primary" id="editButton"><i class="fas fa-pencil-alt"></i> Edit</button> -->
    </div>
</div>
<form action="{{ route('store.profile.request') }}" method="POST">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="company_name" class="text-primary">Company Name</label>
            <input type="text" class="form-control" id="company_name" placeholder="School" name="company_name" value="{{ $user->fundraiser->company_name }}">
        </div>
        <div class="form-group col-md-6">
            <label for="name" class="text-primary">Personal Fundraiser Fullname (Personal fundraiser only)</label>
            <input type="text" class="form-control" id="name" placeholder="Enter email" name="name" value="{{ $user->name }}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email" class="text-primary">Company Email</label>
            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="{{ $user->email }}">
        </div>
        <div class="form-group col-md-6">
            <label for="contact" class="text-primary">Contact</label>
            <input type="text" class="form-control" id="contact" placeholder="E-Transfer Number" name="contact" value="{{ $user->contact }}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="charity_type" class="text-primary">Charity Type</label>
            <select id="charity_type" class="form-control" name="charity_type">
                @foreach($charities as $charity)
                     <option value="{{$charity->id}}" {{ $user->fundraiser->charity_type == $charity->name ? 'selected' : '' }}>{{$charity->name}}</option>
                @endforeach
               
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="e_transfer_no" class="text-primary">E-Transfer Number</label>
            <input type="text" class="form-control" name="e_transfer_no" id="e_transfer_no" placeholder="Email or Phone number"  value="{{ $user->e_transfer_no }}">
        </div>
        <div class="form-group col-md-3">
            <label for="e_transfer_no" class="text-primary">Goal</label>
            <input type="number" class="form-control" name="goal" id="goal" placeholder="Goal Amount"  value="{{ $user->fundraiser->goal }}">
        </div>
        <div class="form-group col-md-3">
            <label for="tax_slip_confirmation" class="text-primary">Tax Slip</label>
            <select id="tax_slip_confirmation" class="form-control" name="tax_slip_confirmation">
               <option value="Yes" {{ $user->fundraiser->tax_slip == 'Yes' ? 'selected' : '' }}>Yes</option>
               <option value="No" {{ $user->fundraiser->tax_slip == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>
    </div>
    <div class="form-row">
    <!-- <div class="form-group col-md-6  ">
        <label for="driver-phone" class="text-primary">E Transfer Number</label>
        <input type="number" class="form-control" id="driver-phone" placeholder="E Transfer Number" name="driver-phone">
    </div> -->
        <!-- <div class="form-group col-md-12  ">
            <label for="driver-phone" class="text-primary">Address</label>
            <textarea class="form-control" aria-label="With textarea" name="address">{{optional($user->customer)->address}}</textarea>
        </div> -->
        <div class="form-group col-md-2">
                <label for="unit-number" class="text-primary">Unit Number (optional):</label>
                <input type="text" id="unit-number" name="unit-number" class="form-control" value="{{optional($user->fundraiser)->unit_number}}">
        </div>
        <div class="form-group col-md-2">
            <label for="street-address" class="text-primary">Street Address:</label>
            <input type="text" id="street-address" name="street-address" required class="form-control" value="{{optional($user->fundraiser)->street_address}}">
        </div>
        <div class="form-group col-md-2">
            <label for="city" class="text-primary">City:</label>
            <input type="text" id="city" name="city" required class="form-control" value="{{optional($user->fundraiser)->city}}">
        </div>
        <div class="form-group col-md-3">
            <label for="province" class="text-primary">State:</label>
            <select id="province" name="province" required class="form-control">
                <option value="">Select Province</option>
                <option value="Alberta" {{ optional($user->fundraiser)->province == 'Alberta' ? 'selected' : '' }}>Alberta</option>
                <option value="British Columbia" {{ optional($user->fundraiser)->province == 'British Columbia' ? 'selected' : '' }}>British Columbia</option>
                <option value="Manitoba" {{ optional($user->fundraiser)->province == 'Manitoba' ? 'selected' : '' }}>Manitoba</option>
                <option value="New Brunswick" {{ optional($user->fundraiser)->province == 'New Brunswick' ? 'selected' : '' }}>New Brunswick</option>
                <option value="Newfoundland and Labrador" {{ optional($user->fundraiser)->province == 'Newfoundland and Labrador' ? 'selected' : '' }}>Newfoundland and Labrador</option>
                <option value="Nova Scotia" {{ optional($user->fundraiser)->province == 'Nova Scotia' ? 'selected' : '' }}>Nova Scotia</option>
                <option value="Ontario" {{ optional($user->fundraiser)->province == 'Ontario' ? 'selected' : '' }}>Ontario</option>
                <option value="Prince Edward Island" {{ optional($user->fundraiser)->province == 'Prince Edward Island' ? 'selected' : '' }}>Prince Edward Island</option>
                <option value="Quebec" {{ optional($user->fundraiser)->province == 'Quebec' ? 'selected' : '' }}>Quebec</option>
                <option value="Saskatchewan" {{ optional($user->fundraiser)->province == 'Saskatchewan' ? 'selected' : '' }}>Saskatchewan</option>
                <option value="Northwest Territories" {{ optional($user->fundraiser)->province == 'Northwest Territories' ? 'selected' : '' }}>Northwest Territories</option>
                <option value="Nunavut" {{ optional($user->fundraiser)->province == 'Nunavut' ? 'selected' : '' }}>Nunavut</option>
                <option value="Yukon" {{ optional($user->fundraiser)->province == 'Yukon' ? 'selected' : '' }}>Yukon</option>
            </select>

        </div>
        <div class="form-group col-md-3" >
            <label for="postal-code" class="text-primary">Postal Code:</label>
            <input type="text" id="postal-code" name="postal-code" pattern="[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d" required class="form-control" value="{{optional($user->fundraiser)->postal_code}}"">
        </div>
    </div>   
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="vission" class="text-primary">Vision</label>
            <textarea class="form-control" id="vission" name="vission" aria-label="With textarea" rows="5">{{ $user->fundraiser->vision }}</textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="vission_mission" class="text-primary">Mission</label>
            <textarea class="form-control" id="vission_mission" name="vission_mission" aria-label="With textarea" rows="5">{{ $user->fundraiser->vision_mission }}</textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6"></div>
        <div class="form-group col-md-3 col-6 d-flex align-items-end justify-content-end">
            <!-- <button type="reset" class="btn border-primary1 showbtn" id="cancelButton" style="width: 200px; ">Cancel</button> -->
        </div>
        <div class="form-group col-md-3 col-6 d-flex align-items-end justify-content-end">
            <button type="submit" class="btn btn-primary showbtn" style="width: 200px;  ">Send Request</button>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-md-12 d-flex justify-content-between">
        <h3 class="title-with-line title-responsive">Change Password&nbsp;</h3>
    </div>
</div>

<form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
@csrf
@method('put')

    <div class="form-row">
        <div class="form-group col-md-4 ">
            <label for="current_password" class="text-primary">Current Password</label>
            <input type="password" class="form-control" id="current_password" placeholder="Enter Current Password" name="current_password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>
        <div class="form-group col-md-4  ">
            <label for="password" class="text-primary">New Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter New Password" name="password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>
        <div class="form-group col-md-4  ">
            <label for="password_confirmation" class="text-primary">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

    </div>
    <div class="form-row">
        <div class="form-group col-md-9  "></div>
        <div class="form-group col-md-3 col-6  d-flex align-items-end justify-content-end">
            <button type="submit" class="btn  btn-primary  "  style="width: 200px;">Change Password</button>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
   $(document).ready(function() {
      $("#editButton").click(function() {
         // Toggle visibility of Cancel and Save buttons
         $(".showbtn").toggle();
      });

      $("#cancelButton").click(function() {
         // Toggle visibility of Cancel and Save buttons
         $(".showbtn").toggle();
      });
   });
</script>

<!-- Image form submit code -->
<script>
    function submitForm() {
        document.getElementById("profilePictureForm").submit();
    }
</script>

@endsection