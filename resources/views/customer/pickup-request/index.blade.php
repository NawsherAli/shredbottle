@extends('customer.layouts.layout')
@section('contents')
@php
    $today = date('Y-m-d');
@endphp
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
        <div class="form-row">
        <div class="form-group col-md-2">
                <label for="unit-number" class="text-primary">Unit Number (optional):</label>
                <input type="text" id="unit-number" name="unit-number" class="form-control" value="{{ old('unit-number') }} ">
        </div>
        <div class="form-group col-md-2">
            <label for="street-address" class="text-primary">Street Address:</label>
            <input type="text" id="street-address" name="street-address" required class="form-control" value="{{ old('street-address') }} " >
        </div>
        <div class="form-group col-md-2">
            <label for="city" class="text-primary">City:</label>
            <input type="text" id="city" name="city" required class="form-control" value="{{ old('city') }} ">
        </div>
        <div class="form-group col-md-3">
            <label for="province" class="text-primary">State:</label>
            <select id="province" name="province" required class="form-control">
                <option value="">Select Province</option>
                <option value="Alberta" {{ old('province') == 'Alberta' ? 'selected' : '' }} >Alberta</option>
                <option value="British Columbia"  {{ old('province') == 'British Columbia' ? 'selected' : '' }}>British Columbia</option>
                <option value="Manitoba"  {{ old('province') ==  'Manitoba' ? 'selected' : '' }}>Manitoba</option>
                <option value="New Brunswick"  {{ old('province') == 'New Brunswick' ? 'selected' : '' }}>New Brunswick</option>
                <option value="Newfoundland and Labrador" {{ old('province') == 'Newfoundland and Labrador' ? 'selected' : '' }} >Newfoundland and Labrador</option>
                <option value="Nova Scotia" {{ old('province') == 'Nova Scotia' ? 'selected' : '' }} >Nova Scotia</option>
                <option value="Ontario"  {{ old('province') == 'Ontario' ? 'selected' : '' }}>Ontario</option>
                <option value="Prince Edward Island"  {{ old('province') == 'Prince Edward Island' ? 'selected' : '' }}>Prince Edward Island</option>
                <option value="Quebec"  {{ old('province') == 'Quebec' ? 'selected' : '' }}>Quebec</option>
                <option value="Saskatchewan"  {{ old('province') == 'Saskatchewan' ? 'selected' : '' }}>Saskatchewan</option>
                <option value="Northwest Territories" {{ old('province') == 'Northwest Territories' ? 'selected' : '' }} >Northwest Territories</option>
                <option value="Nunavut" {{ old('province') == 'Nunavut' ? 'selected' : '' }} >Nunavut</option>
                <option value="Yukon"  {{ old('province') == 'Yukon' ? 'selected' : '' }}>Yukon</option>
            </select>

        </div>
        <div class="form-group col-md-3" >
            <label for="postal-code" class="text-primary">Postal Code:</label>
            <input type="text" id="postal-code" name="postal-code" pattern="[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d" required class="form-control" value="{{ old('postal-code') }}">
        </div>
    </div>
        <!-- <div class="form-group col-md-8">
            <div class="d-flex justify-content-between">
                <label for="pickup_location" class="text-primary">Pickup Location </label>
                <button type="button" class="" data-container="body" data-toggle="popover" data-placement="left" data-content="If you want to call the pickup for someone else enter the address otherwise your default address will be used" style="background-color: #F1FFFA; border: none"><img src="{{asset('assets/icons/Info.png')}}" width="25px"></button>
            </div> -->
            
           <!--  <i style="width: 40px; height:40px; border-radius: 100%; background-color: red">!</i> -->
            <!-- 
            <input type="text" class="form-control" id="pickup_location" placeholder="Enter Pickup Location" name="pickup_location" required value="{{old('pickup_location')}}">
        </div> -->
        <div class="form-group col-md-6">
            <label for="pickup_date" class="text-primary">Pickup Date</label>
            <input type="date" class="form-control" id="pickup_date" name="pickup_date" required min="{{ $today }}" value="{{ old('pickup_date') }}">

        </div>
        <div class="form-group col-md-6">
            <div class="d-flex justify-content-between">
                <label for="pickup_contact" class="text-primary">Contact </label>
                <button type="button" class="" data-container="body" data-toggle="popover" data-placement="left" data-content="If you want to call the pickup for someone else enter the phone number for contacting the person otherwise your number will be  used" style="background-color: #F1FFFA; border: none"> <img src="{{asset('assets/icons/Info.png')}}" width="25px"></button>
            </div>
            <input type="number" class="form-control" id="pickup_contact" placeholder="Enter Contact Number" name="pickup_contact" required value="{{old('pickup_contact')}}">
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
            <input id="radio1" name="pickup_service" type="radio"  value="Resident" {{ old('pickup_service') == 'Resident' ? 'checked' : '' }} checked="">
            <label for="radio1" >Resident</label>
         </div>
    </div>
    <div class="form-group col-md-3 ">
        <div class="radio">
            <input id="radio2" name="pickup_service" type="radio" value="Condo" {{ old('pickup_service') == 'Condo' ? 'checked' : '' }}>
            <label for="radio2" >Condo</label>
         </div>
    </div>
    <div class="form-group col-md-3 ">
        <div class="radio">
            <input id="radio3" name="pickup_service" type="radio"  value="Commercial" {{ old('pickup_service') == 'Commercial' ? 'checked' : '' }}>
            <label for="radio3" >Commercial</label>
         </div>
    </div>
 </div>
<div class="form-row ">
    <label for="special_instruction" class="text-primary">Special Instruction</label>
    <input type="text" class="form-control" id="special_instruction" name="special_instruction"   value="{{ old('special_instruction') }}">
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
        <input type="nimber" class="form-control" id="ref_items_no_bags" placeholder="0 for NaN" name="pickup_items[0][no_of_bags]" value="{{ old('pickup_items.0.no_of_bags') }}"  >
    </div>
    <div class="form-group col-md-6">
        <label for="ref_items_no_boxes" class="text-primary">Number Of Boxes</label>
        <input type="number" class="form-control" id="ref_items_no_boxes" placeholder="0 for NaN" name="pickup_items[0][no_of_boxes]" value="{{ old('pickup_items.0.no_of_boxes') }}" required>
    </div>
</div>
<div class="form-row ">
    <div class="form-group col-md-6">
        <label for="req_ref_items_no_bags" class="text-primary">Request Number Of Boxes</label>
        <input type="number" class="form-control" id="req_ref_items_no_bags" placeholder="0 for NaN" name="pickup_items[0][req_items_no_bags]" value="{{ old('pickup_items.0.no_of_boxes') }}" required>
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
    <input type="text" class="form-control" name="pickup_items[1][items_type]" placeholder="0 for NaN" value="Clothes" hidden>
    <div class="form-group col-md-6">
        <label for="cloth_items_no_bags" class="text-primary">Number Of Bags</label>
        <input type="text" class="form-control" id="cloth_items_no_bags" placeholder="0 for NaN" name="pickup_items[1][no_of_bags]" value="{{ old('pickup_items.1.no_of_bags', '0') }} " required>
         
    </div>
    <div class="form-group col-md-6">
        <label for="cloth_items_no_box" class="text-primary">Number Of Boxes</label>
        <input type="text" class="form-control" id="cloth_items_no_box" placeholder="0 for NaN" name="pickup_items[1][no_of_boxes]" value="{{ old('pickup_items.1.no_of_boxes') }}" required>
    </div>
</div>
<div class="form-row ">
    <div class="form-group col-md-6">
        <label for="req_cloth_items_no_bags" class="text-primary">Request Number Of Boxes</label>
        <input type="number" class="form-control" id="req_cloth_items_no_bags" placeholder="0 for NaN" name="pickup_items[1][req_items_no_bags]" value="{{ old('pickup_items.1.req_items_no_bags') }}" required>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h3 class="title-with-line title-responsive">Electronics &nbsp;</h3>
   </div>
</div>
<div class="form-row">
    <input type="text" class="form-control" name="pickup_items[2][items_type]" placeholder="0 for NaN" value="Electronics" hidden>
    <div class="form-group col-md-6">
        <label for="elect_items_no_bags" class="text-primary">Number Of Bags</label>
        <input type="text" class="form-control" id="elect_items_no_bags" placeholder="0 for NaN" name="pickup_items[2][no_of_bags]" value="{{ old('pickup_items.2.no_of_bags') }}" required>
    </div>
    <div class="form-group col-md-6">
        <label for="elect_items_no_box" class="text-primary">Number Of Boxes</label>
        <input type="text" class="form-control" id="elect_items_no_box" placeholder="0 for NaN" name="pickup_items[2][no_of_boxes]" value="{{ old('pickup_items.2.no_of_boxes') }}" required>
    </div>
</div>
<div class="form-row ">
    <div class="form-group col-md-6">
        <label for="req_elect_items_no_bags" class="text-primary">Request Number Of Boxes</label>
        <input type="number" class="form-control" id="req_elect_items_no_bags" placeholder="0 for NaN" name="pickup_items[2][req_items_no_bags]" value="{{ old('pickup_items.2.req_items_no_bags') }}" required>
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
            <input id="radio4" name="payment_option" type="radio" checked="" value="Cashout" {{ old('payment_option') == 'Cashout' ? 'checked' : '' }}>
            <label for="radio4">Cashout</label>
         </div>
    </div>
    <div class="form-group col-md-3 col-6">
        <div class="radio">
            <input id="radio5" name="payment_option" type="radio" value="Donate" {{ old('payment_option') == 'Donate' ? 'checked' : '' }}>
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
            <select id="charity_type" class="form-control" name="charity_type"  >
                <!-- <option selected disabled value="">Select Charity Type</option> -->
                @foreach($charities as $charity)
                    <option value="{{ $charity->name }}" {{ old('charity_type') == $charity->name ? 'selected' : '' }}>
                        {{ $charity->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="charity_organization" class="text-primary">Organization Name</label>
            <select id="charity_organization" class="form-control" name="charity_organization">
                <option selected disabled value="">Select Charity Organization</option>
                @foreach($fundraisers as $fundraiser)
                    <option value="{{ $fundraiser->id }}" data-tax-slip="{{ $fundraiser->tax_slip }}" {{ old('charity_organization') == $fundraiser->id ? 'selected' : '' }}>
                        {{ $fundraiser->company_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="info_confirmation" class="text-primary">Would you like to display your information to the fundraiser?</label>
            <div class="form-row">
                <div class="form-group col-md-4 col-6">
                    <div class="radio">
                        <input id="info_confirmation1" name="info_confirmation" type="radio" checked="" value="Yes" {{ old('info_confirmation') == 'Yes' ? 'checked' : '' }}>
                        <label for="info_confirmation1">Yes</label>
                     </div>
                </div>
                <div class="form-group col-md-4 col-6">
                    <div class="radio">
                        <input id="info_confirmation2" name="info_confirmation" type="radio" value="No" {{ old('info_confirmation') == 'No' ? 'checked' : '' }}>
                        <label for="info_confirmation2">No</label>
                     </div>
                </div>
            </div>
            <div id="tax_slip_confirmation_box" style="display: none">
                <label for="tax_slip_confirmation" class="text-primary">Would you like a tax slip?</label>
                <div class="form-row">
                    <div class="form-group col-md-4 col-6">
                        <div class="radio">
                            <input id="tax_slip_confirmation1" name="tax_slip_confirmation" type="radio" checked="" value="Yes" {{ old('tax_slip_confirmation') == 'Yes' ? 'checked' : '' }}>
                            <label for="tax_slip_confirmation1">Yes</label>
                         </div>
                    </div>
                    <div class="form-group col-md-4 col-6">
                        <div class="radio">
                            <input id="tax_slip_confirmation2" name="tax_slip_confirmation" type="radio" value="No" {{ old('tax_slip_confirmation') == 'No' ? 'checked' : '' }}>
                            <label for="tax_slip_confirmation2">No</label>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6  bg-primary-light br-5" id="tax-slip-msg-box" style="display: none">
            <div class="d-flex align-items-center p">
                <img src="{{asset('assets/icons/exclimation.png')}}">
                <h5 class=" pl-1 pt-2 text-primary">Notice</h5>
            </div>
            <div class="d-flex align-items-center p">
                <!-- <img src="../assets/icons/exclimation.png"> -->

                <p id="taxSlipMessage" class="pl-5 text-dark">Tax Slip Info</p>

            </div>
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
<!-- Show Tax SLip Message -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectElement = document.getElementById('charity_organization');
    const messageElement = document.getElementById('taxSlipMessage');

    function updateMessage() {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const taxSlipValue = selectedOption.getAttribute('data-tax-slip');

        if (taxSlipValue === 'Yes') {
            $('#tax-slip-msg-box').show();
            $('#tax_slip_confirmation_box').show();
            messageElement.textContent = 'The organization can give tax slips to donors.';
            messageElement.style.color = 'green';
        } else if (taxSlipValue === 'No') {
            $('#tax-slip-msg-box').show();
            messageElement.textContent = 'The organization cannot give tax slips to donors.';
            messageElement.style.color = 'red';
        } else {
            messageElement.textContent = '';
        }
    }

    selectElement.addEventListener('change', updateMessage);

    // Call the function once to set the initial state in case there's a pre-selected value
    updateMessage();
});
</script>
