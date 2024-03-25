@extends('admin.layouts.layout')
@section('contents')
<!-- Row 3 -->
<div class="row">
    <div class="col-md-12 d-flex justify-content-between">
        <h3 class="title-with-line title-responsive">Edit Pickup Item Details&nbsp;</h3>
        <!-- <button class="btn btn-primary" id="editButton"><i class="fas fa-pencil-alt"></i> Edit</button> -->
    </div>
</div>
<form method="post" action="{{ route('customer.update', ['id' => $itemDetail->id]) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
    @csrf
    @method('PUT')


<div class="form-row">
<div class="form-group col-md-6">
    <label for="driver_vehical" class="text-primary">Item Type</label>
    <select id="driver_vehical" class="form-control" name="status">
        <option selected>Choose...</option>
        <option {{ 'Glass' == $itemDetail->item_type ? 'selected' : '' }} value="Glass">Glass</option>
        <option {{ 'Plastic' == $itemDetail->item_type ? 'selected' : '' }} value="Plastic">Plastic</option>
        <option {{ 'Alumminum' == $itemDetail->item_type ? 'selected' : '' }} value="Alumminum">Alumminum</option>
    </select>
</div>
<div class="form-group col-md-6">
    <label for="driver_vehical" class="text-primary">Item Size</label>
    <select id="driver_vehical" class="form-control" name="itemSizeSelect" onchange="calculateAmount()" id="itemSizeSelect">
        <option selected>Choose...</option>
        <option {{ '7' == $itemDetail->item_size ? 'selected' : '' }}  value="7">Under 1L</option>
        <option {{ '20' == $itemDetail->item_size ? 'selected' : '' }} value="20">Over 1L</option>
    </select>
</div>
</div> 
<div class="form-row">
<div class="form-group col-md-6  ">
    <label for="contact" class="text-primary">Item Quantity</label>
    <input type="number" class="form-control" id="contact"  name="itemQuantityInput" value="{{$itemDetail->item_quantity}}">
</div>
<div class="form-group col-md-6  ">
    <label for="itemSizeAmount" class="text-primary">Amount</label>
    <input type="number" class="form-control" id="itemSizeAmount"  name="itemSizeAmount" value="{{$itemDetail->item_amount}}">
</div>
</div>
<div class="form-row">
<!-- <div class="form-group col-md-6  ">
                            </div> -->
<!-- <div class="form-group   col-6  d-flex align-items-end justify-content-end">
    <button type="reset" class="col-md-3 btn  border-primary1 showbtn" id="cancelButton"  >Cancel</button>
</div> -->
<div class="form-group  col-6  d-flex align-items-end justify-content-start">
    <button type="save" class="col-md-3 btn  btn-primary showbtn">Update</button>
</div>
</div>
</div>
</form>
<script>
        function calculateAmount() {
            
            var sizeSelect = itemSizeSelect.value;
            var quantityInput = itemQuantityInput.value;
            alert('sizeSelect');
            // Your calculation logic goes here
            var amount = sizeSelect * quantityInput;

            // Update amount input field
            itemAmountInput.value = amount;
        }
</script>
@endsection