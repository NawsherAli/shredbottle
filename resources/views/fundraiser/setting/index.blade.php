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
                                <label for="image" class="btn btn-primary">Upload Profile Picture</label>
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
                                        <span class="text-primary">Location: </span> 
                                    </p>
                                    <p class="col font-weight-semibold text-black">Northwest Area</p>
                                </li>
                                <li class="row">
                                    <p class=" col-3 font-weight-semibold text-dark m-b-5">
                                        <!-- <i class="m-r-10 text-primary anticon anticon-phone"></i> -->
                                        <span class="text-primary">User ID: </span> 
                                    </p>
                                    <p class="col font-weight-semibold text-black"> 432</p>
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
        <h3 class="title-with-line title-responsive">Profile Update Request &nbsp;</h3><button class="btn btn-primary" id="editButton"><i class="fas fa-pencil-alt"></i> Edit</button>
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
            <label for="name" class="text-primary">Personal Fundraiser Fullname</label>
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
        <div class="form-group col-md-6">
            <label for="charity_type" class="text-primary">Charity Type</label>
            <select id="charity_type" class="form-control" name="charity_type">
                <option value="NL" {{ $user->fundraiser->charity_type == 'NL' ? 'selected' : '' }}>Nails</option>
                <option value="BN" {{ $user->fundraiser->charity_type == 'BN' ? 'selected' : '' }}>Bananas</option>
                <option value="HL" {{ $user->fundraiser->charity_type == 'HL' ? 'selected' : '' }}>Helicopters</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="e_transfer_no" class="text-primary">E-Transfer Number</label>
            <input type="text" class="form-control" name="e_transfer_no" id="e_transfer_no" placeholder="E-Transfer Number"  value="{{ $user->e_transfer_no }}">
        </div>
    </div>    
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="address" class="text-primary">Address</label>
            <textarea class="form-control" id="address" name="address" aria-label="With textarea" rows="5">{{ $user->fundraiser->address }}</textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="vission_mission" class="text-primary">Vision/Mission</label>
            <textarea class="form-control" id="vission_mission" name="vission_mission" aria-label="With textarea" rows="5">{{ $user->fundraiser->vision_mission }}</textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6"></div>
        <div class="form-group col-md-3 col-6 d-flex align-items-end justify-content-end">
            <button type="reset" class="btn border-primary1 showbtn" id="cancelButton" style="width: 200px;display: none">Cancel</button>
        </div>
        <div class="form-group col-md-3 col-6 d-flex align-items-end justify-content-end">
            <button type="submit" class="btn btn-primary showbtn" style="width: 200px; display: none">Send Request</button>
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
            <button type="submit" class="btn  btn-primary showbtn"  style="width: 200px;">Change Password</button>
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