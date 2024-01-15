@extends('admin.layouts.layout')
@section('contents')
<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-6 order-sm-1 order-1 col-8">
        <h1 class="title-responsive">Create Driver Profile</h1>
    </div>
    
</div>
<!-- <div class="row"> -->
    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="driver-name " class="text-primary">Driver Name</label>
                <input type="text" class="form-control" id="driver-name" placeholder="Enter Driver Name" name="driver-name">
            </div>
            <div class="form-group col-md-6">
                <label for="driver-email" class="text-primary">Driver Email</label>
                <input type="text" class="form-control" id="driver-email" placeholder="Enter Driver Email" name="driver-email">
            </div>
        </div>
        <div class="form-row ">
            <div class="form-group col-md-6">
                <label for="driver-address" class="text-primary">Driver Address</label>
                <input type="text" class="form-control" id="driver-address" name="driver-address" placeholder="Enter Driver Address">
            </div>
            <div class="form-group col-md-6">
                <label for="driver-phone" class="text-primary">Driver Phone</label>
                <input type="number" class="form-control" id="driver-phone" placeholder="Enter Driver Phone" name="driver-phone">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="driver-vehical" class="text-primary">Driver Vehical</label>
                <select id="driver-vehical" class="form-control" name="driver-vehical">
                    <option selected>Choose...</option>
                    <option>Van</option>
                    <option>Truck</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="vehical-number-plate" class="text-primary">Vehicle Number Plate</label>
                <input type="text" class="form-control" id="vehical-number-plate" name="vehical-number-plate" placeholder="Enter Vehicle Number Plate ">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="driver-picture" class="text-primary">Driver Picture</label>
                <input type="file" class="form-control" id="driver-picture" name="driver-picture">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
<!-- </div> -->
@endsection