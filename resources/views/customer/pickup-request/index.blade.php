@extends('customer.layouts.layout')
@section('contents')
<style>
    .radio input[type=radio]:checked+label:before{color:red;border-color:red)}
    .radio input[type=radio]:checked+label:after{background-color:red)}
    .pickuprequest-css{
        padding-top: 20px;
    }
    
</style>

<div class="row mb-3 bg-primary br-10" style="border-bottom: 2px solid #219653">
    <div class="col-md-12 order-sm-1 order-1 col-8 ">
        <h1 class="text-white title-responsive">Pickup Request</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h3 class="title-with-line title-responsive">Contact & Pickup Information &nbsp;</h3>
   </div>
</div>
<form method="POST" action="{{route('pickup.store')}}">
@csrf
    <div class="form-row">
        <div class="form-group col-md-8">
            <div class="d-flex justify-content-between">
                <label for="pickup_location" class="text-primary">Pickup Location </label>
                <button type="button" class="" data-container="body" data-toggle="popover" data-placement="left" data-content="If you want to call the pickup for someone else enter the address otherwise your default address will be used" style="background-color: #F1FFFA; border: none"><img src="{{asset('assets/icons/info.png')}}"></button>
            </div>
            
           <!--  <i style="width: 40px; height:40px; border-radius: 100%; background-color: red">!</i> -->
            
            <input type="text" class="form-control" id="pickup_location" placeholder="Enter Pickup Location" name="pickup_location">
        </div>
        <div class="form-group col-md-4">
            <label for="pickup_date" class="text-primary">Pickup Date</label>
            <input type="date" class="form-control" id="pickup_date" placeholder="Enter Driver Email" name="pickup_date">
        </div>
    </div>
    <div class="form-row ">
        <div class="form-group col-md-8">
            <div class="d-flex justify-content-between">
                <label for="pickup_contact" class="text-primary">Contact </label>
                <button type="button" class="" data-container="body" data-toggle="popover" data-placement="left" data-content="If you want to call the pickup for someone else enter the phone number for contacting the person otherwise your number will be  used" style="background-color: #F1FFFA; border: none"> <img src="{{asset('assets/icons/info.png')}}"></button>
            </div>
            <input type="number" class="form-control" id="pickup_contact" placeholder="Enter Contact Number" name="pickup_contact">
        </div>
    </div>


<div class="row">
    <div class="col-md-12">
        <h3 class="title-with-line title-responsive">Type of Services &nbsp;</h3>
   </div>
</div>


 <div class="form-row">
    <div class="form-group col-md-3 ">
        <div class="radio">
            <input id="radio1" name="pickup_service" type="radio" checked="" value="Resident">
            <label for="radio1" >Resident</label>
         </div>
    </div>
    <div class="form-group col-md-3 ">
        <div class="radio">
            <input id="radio2" name="pickup_service" type="radio" checked="" value="Condo">
            <label for="radio2" >Condo</label>
         </div>
    </div>
    <div class="form-group col-md-3 ">
        <div class="radio">
            <input id="radio3" name="pickup_service" type="radio" checked="" value="Commercial">
            <label for="radio3" >Commercial</label>
         </div>
    </div>
 </div>


 <div class="row">
    <div class="col-md-12">
        <h3 class="title-with-line title-responsive">Refundable Items &nbsp;</h3>
   </div>
</div>
<div class="row mb-3 p-3">
    <div class="col-md-12 bg-primary-light br-5 p-2">
        <div class="d-flex align-items-center p">
            <img src="{{asset('assets/icons/exclimation.png')}}">
            <h5 class=" pl-1 pt-2 text-primary">How to pack your items</h5>
        </div>
        <div class="d-flex align-items-center p">
            <!-- <img src="../assets/icons/exclimation.png"> -->

            <p class="pl-5 text-dark">All glass items are to be placed in boxes and all plastic items are to be placed in bags.</p>
        </div>
   </div>
</div>

<div class="form-row">
    <input type="text" class="form-control" name="pickup_items[0][items_type]" placeholder="Items Type" value="bottles" hidden>
    <div class="form-group col-md-6">
        <label for="ref_items_no_bags" class="text-primary">Number Of Bags</label>
        <input type="text" class="form-control" id="ref_items_no_bags" placeholder="Enter Numbers of Bags" name="pickup_items[0][no_of_bags]">
    </div>
    <div class="form-group col-md-6">
        <label for="ref_items_no_box" class="text-primary">Number Of Boxes</label>
        <input type="text" class="form-control" id="ref_items_no_bags" placeholder="Enter Number Of Boxes" name="pickup_items[0][no_of_boxes]">
    </div>
</div>
<div class="form-row ">
    <div class="form-group col-md-6">
        <label for="req_ref_items_no_bags" class="text-primary">Request Number Of Boxes</label>
        <input type="number" class="form-control" id="req_ref_items_no_bags" placeholder="Enter Required Number of Boxes" name="pickup_items[0][req_items_no_bags]">
    </div>

    <div class="form-group col-md-6 bg-primary-light br-5">
        <div class="d-flex align-items-center p">
            <img src="{{asset('assets/icons/exclimation.png')}}">
            <h5 class=" pl-1 pt-2 text-primary">Don’t Have A Box?</h5>
        </div>
        <div class="d-flex align-items-center p">
            <!-- <img src="../assets/icons/exclimation.png"> -->

            <p class="pl-5 text-dark">Request the amount of boxes that you need and our driver will come with the boxes.</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h3 class="title-with-line title-responsive">Clothes &nbsp;</h3>
   </div>
</div>
<div class="form-row">
    <input type="text" class="form-control" name="pickup_items[1][items_type]" placeholder="Items Type" value="Clothes" hidden>
    <div class="form-group col-md-6">
        <label for="cloth_items_no_bags" class="text-primary">Number Of Bags</label>
        <input type="text" class="form-control" id="cloth_items_no_bags" placeholder="Enter Numbers of Bags" name="pickup_items[1][no_of_bags]">
    </div>
    <div class="form-group col-md-6">
        <label for="cloth_items_no_box" class="text-primary">Number Of Boxes</label>
        <input type="text" class="form-control" id="cloth_items_no_box" placeholder="Enter Number Of Boxes" name="pickup_items[1][no_of_boxes]">
    </div>
</div>
<div class="form-row ">
    <div class="form-group col-md-6">
        <label for="req_cloth_items_no_bags" class="text-primary">Request Number Of Boxes</label>
        <input type="number" class="form-control" id="req_cloth_items_no_bags" placeholder="Enter Required Number of Boxes" name="pickup_items[1][req_items_no_bags]">
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h3 class="title-with-line title-responsive">Electronics &nbsp;</h3>
   </div>
</div>
<div class="form-row">
    <input type="text" class="form-control" name="pickup_items[2][items_type]" placeholder="Items Type" value="Electronics" hidden>
    <div class="form-group col-md-6">
        <label for="elect_items_no_bags" class="text-primary">Number Of Bags</label>
        <input type="text" class="form-control" id="elect_items_no_bags" placeholder="Enter Numbers of Bags" name="pickup_items[2][no_of_bags]">
    </div>
    <div class="form-group col-md-6">
        <label for="elect_items_no_box" class="text-primary">Number Of Boxes</label>
        <input type="text" class="form-control" id="elect_items_no_box" placeholder="Enter Number Of Boxes" name="pickup_items[2][no_of_boxes]">
    </div>
</div>
<div class="form-row ">
    <div class="form-group col-md-6">
        <label for="req_elect_items_no_bags" class="text-primary">Request Number Of Boxes</label>
        <input type="number" class="form-control" id="req_elect_items_no_bags" placeholder="Enter Required Number of Boxes" name="pickup_items[2][req_items_no_bags]">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h3 class="title-with-line title-responsive">Select Payment Options</h3>
   </div>
</div>
<div class="form-row">
    <div class="form-group col-md-3 col-6">
        <div class="radio">
            <input id="radio4" name="payment_option" type="radio" checked="" value="Cashout">
            <label for="radio4">Cashout</label>
         </div>
    </div>
    <div class="form-group col-md-3 col-6">
        <div class="radio">
            <input id="radio5" name="payment_option" type="radio" value="Donate" >
            <label for="radio5">Donate</label>
         </div>
    </div>
</div>


<div id="select-charity">
    

<div class="row">
    <div class="col-md-12">
        <h3 class="title-with-line title-responsive">Select Charity &nbsp;</h3>
   </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="charity_type" class="text-primary">Charity Type</label>
        <select id="charity_type" class="form-control" name="charity_type">
            <option selected disabled value="">Select Charity Type</option>
            @foreach($charities as $charity)
                <option value="{{$charity->name}}">{{$charity->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="charity_organization" class="text-primary">Organization Name</label>
        <select id="charity_organization" class="form-control" name="charity_organization">
            <option selected disabled="" value="">Select Charity Organization</option>
            @foreach($fundraisers as $fundraiser)
            <option value="{{$fundraiser->id}}">{{$fundraiser->company_name}}</option>
            @endforeach
        </select>
    </div>
</div> 
</div>       
<div class="form-row">
    <div class="form-group col-md-6 bg-primary-light br-5">
        <div class="d-flex align-items-center p">
            <img src="{{asset('assets/icons/exclimation.png')}}">
            <h5 class=" pl-1 pt-2 text-primary">Notice</h5>
        </div>
        <div class="d-flex align-items-center p">
            <!-- <img src="../assets/icons/exclimation.png"> -->

            <p class="pl-5 text-dark">if you have larg items or large size electronics please call for a special request</p>
        </div>
    </div>
    <div class="form-group col-md-3 col-6  d-flex align-items-end justify-content-end">
        <button class="btn  border-primary1" style="width: 200px">Cancel</button>
    </div>
    <div class="form-group col-md-3 col-6  d-flex align-items-end justify-content-end">
        <button type="submit" class="btn  btn-primary"  style="width: 200px">Create</button>
    </div>
</div>
</form>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('input[name="payment_option"]').change(function () {
            if ($('#radio5').is(':checked')) {
                $('#select-charity').show();
            } else {
                $('#select-charity').hide();
            }
        });
    });
</script>