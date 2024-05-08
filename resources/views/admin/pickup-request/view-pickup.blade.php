@extends('admin.layouts.layout')
@section('contents')
<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-9 order-sm-1 order-1 col-7 ">
        <h3 class="title-responsive"><a href="#" onclick="goBack()"> <i class="anticon anticon-left text-primary "></i> </a> Pickup Details </h3>
    </div>
    <div class="col-md-3 order-sm-3 order-2 col-5 ">
        <div class="dropdown dropdown-animated scale-left">
            @if($pickup->status == 'Completed')
            <span type="button" class=" badge-success br-50 px-4 py-2" data-toggle="dropdown">
                <span> Completed</span>
            </span>
            @else
            <span type="button" class=" badge-pending br-50 px-4 py-2" data-toggle="dropdown">
                <span>  Pending</span>
            </span>
            @endif
        </div>
    </div>
</div>
<!-- <div class="row"> -->
    <!-- <div class="col-12"> -->
        <!-- <div class="card-body"> -->
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="d-flex align-items-center">
                        <div class="text-center text-sm-left ">
                            <div class="avatar avatar-image" style="width:100%;  height: 17vh">
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
                                    <p class="col font-weight-semibold text-black">STB00{{$pickup->id}}</p>
                                </li>
                                <li class="row">
                                    <p class="col-3 font-weight-semibold text-dark m-b-5">
                                        <!-- <i class="m-r-10 text-primary anticon anticon-compass"></i> -->
                                        <span class="text-primary">Address: </span> 
                                    </p>
                                    <p class="col-9 font-weight-semibold text-black">{{$pickup->customer->address}}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div> -->
    <!-- </div> -->
<!-- </div> -->
@if($pickup->status == 'Pending')
<form id="pickupStatusForm" method="POST" action="{{ route('pickup.status.update', ['id' => $pickup->id]) }}" enctype="multipart/form-data" class="mt-5">
    <div class="row mb-3" style="border-bottom: 2px solid #219653">
        @csrf
        @method('PUT')
        <div class="form-group col-md-6">
            <label for="pickup_status" class="text-primary">Pickup Status</label>
            <select id="pickup_status" class="form-control" name="pickup_status">
                <!-- <option selected>Choose...</option>
                <option {{ 'Pending' == $pickup->status ? 'selected' : '' }} value="Pending">Pending</option> -->
                <option {{ 'Completed' == $pickup->status ? 'selected' : '' }} value="Completed">Completed</option>
            </select>
        </div>
        <div class="form-group col-6 d-flex align-items-end justify-content-start">
            <button type="button" onclick="confirmSubmit()" class="col-md-6 btn btn-primary showbtn">Update</button>
        </div>
    </div>
</form>
@endif
<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-9 order-sm-1 order-1 col-12 ">
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
                        @if($pickup->payment_option == 'Donate')
                        <tr class="">
                            <th scope="col" class="text-primary">Charity Type Option</th>
                            <td scope="col" class="">{{$pickup->charity_type}}</td>
                        </tr>
                        <tr class="">
                            <th scope="col" class="text-primary">Charity Organization</th>
                            <td scope="col" class="">{{optional($pickup->fundraiser)->company_name}}</td>
                        </tr>
                        @endif
                        <tr class="">
                            <th scope="col" class="text-primary">Total Items</th>
                            <td scope="col" class="">{{$pickup->total_items}}</td>
                        </tr>
                        <tr class="">
                            <th scope="col" class="text-primary">Amount</th>
                            <td scope="col" class="">{{$pickup->amount }}</td>
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
                           <td scope="col" class="">{{$loop->iteration}}</td>
                            <td scope="col" class="">{{ $item->items_type }}</td>
                            <td scope="col" class="">{{ $item->no_of_bags }}</td>
                            <td scope="col" class="">{{ $item->no_of_boxes }}</td>
                            <td scope="col" class="">{{ $item->req_no_boxes }}</td><td scope="col" class="">{{ $item->quantity }}</td>
                            <td scope="col" class="">{{ $item->amount }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>


<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-9 order-sm-1 order-1 col-6 ">
        <h4 class="title-responsive">Bottles Details</h4>
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
                            <th scope="col" class="text-white">Size</th>
                            <th scope="col" class="text-white">Quantity</th>
                            <th scope="col" class="text-white">Amount</th>
                            @if($pickup->status == 'Pending')
                            <th scope="col" class="text-white">Actions</th>
                            @endif
                        </tr>
                       @foreach($pickup->items as $item)
                           @foreach($item->itemDetails as $item)
                            <tr class="">
                               <td scope="col" class="">{{$loop->iteration}}</td>
                                <td scope="col" class="">{{ $item->item_type }}</td>
                                @if($item->item_size == '7')
                                <td scope="col" class=""> Under 1L</td>
                                @else
                                <td scope="col" class=""> Over 1L</td>
                                @endif
                                <td scope="col" class="">{{ $item->item_quantity }}</td>
                                <td scope="col" class="">{{ $item->item_amount }}</td>
                                <td>
                                    <!-- <a href="{{ route('item.details.edit', ['id' => $item->id]) }}" class="badge badge-pill badge-blue"><i class="fas fa-edit    br-100"></i></a> -->
                                    @if($pickup->status == 'Pending')
                                    <a href="#" onclick="deleteItemDetails({{ $item->id }})" class="badge badge-pill badge-red"><i class="fas fa-trash-alt   br-100"></i></a>
                                    @endif
                                </td>
                             </tr>
                             @if(isset($item->id))
                                <form id="delete-form-{{ $item->id }}" action="{{ route('item.details.destroy', ['id' => $item->id]) }}" method="post" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div> 


@if($pickup->status == 'Pending')
@foreach($pickup->items as $item)
 @if($item->items_type == 'bottles')
    <form method="POST" action="{{route('pickup.update', ['id' => $pickup->id])}}"  enctype="multipart/form-data" class="mt-5">
     @csrf
     @method('PUT')
     <input type="hidden" name="item_id" value="{{$item->id}}">
    <table id="dataTable" class="table table-sm">
        <!-- <thead>
            <tr class="bg-primary">
                <th></th>
                <th scope="col" class="text-white">ID</th> -->
                <!-- <th>pickup-items-id</th> -->
                <!-- <th scope="col" class="text-white">Type</th>
                <th scope="col" class="text-white">Size</th>
                <th scope="col" class="text-white">No of item</th>
                <th scope="col" class="text-white">Amount</th>
            </tr>
        </thead> -->
        <tbody>
        <tr>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>        
        </tbody>
    </table>
    <div class="row">
      <button type="button" id="addRowBtn" class="btn btn-primary col-md-3">Add </button>
     <button type="button" id="deleteRowBtn" class="btn btn-danger col-md-3 ml-2 mr-2">Delete</button>
     <button type="submit" id="saveBtn" class="btn btn-primary col-md-3"  style="display: none" >Save</button>  
    </div>
    </form>
  @endif
@endforeach
@endif


<script>
    function deleteItemDetails(itemId) {
        // alert(itemId);
        if (confirm('Are you sure you want to delete this Item Record?')) {
            document.getElementById('delete-form-' + itemId).submit();
        }
    }
</script>

<script>
    document.getElementById('addRowBtn').addEventListener('click', function() {
        var table = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
        var lastRow = table.rows[table.rows.length - 1];
        var newRow = table.insertRow(table.rows.length);

        // Create empty cell at the beginning of the row
        var emptyCell = newRow.insertCell(0);

        // Create select input field for item_type
        var itemTypeCell = newRow.insertCell(1);
        var itemTypeSelect = document.createElement('select');
        itemTypeSelect.className = 'form-control'; // Add class form-control
        itemTypeSelect.name = 'item_type[]';
        itemTypeSelect.innerHTML = '<option value="Glass">Glass</option><option value="Plastic">Plastic</option><option value="Alumminum">Alumminum</option>';
        itemTypeCell.appendChild(itemTypeSelect);

        // Create select input field for item_size
        var itemSizeCell = newRow.insertCell(2);
        var itemSizeSelect = document.createElement('select');
        itemSizeSelect.className = 'form-control'; // Add class form-control
        itemSizeSelect.name = 'item_size[]';
        itemSizeSelect.innerHTML = '<option value="7">Under 1L</option><option value="20">Over 1L</option>';
        itemSizeSelect.addEventListener('change', calculateAmount);
        itemSizeCell.appendChild(itemSizeSelect);

        // Create number input field for item_quantity
        var itemQuantityCell = newRow.insertCell(3);
        var itemQuantityInput = document.createElement('input');
        itemQuantityInput.className = 'form-control'; // Add class form-control
        itemQuantityInput.type = 'number';
        itemQuantityInput.name = 'item_quantity[]';
        itemQuantityInput.placeholder = 'Quantity';
        itemQuantityInput.addEventListener('input', calculateAmount);
        itemQuantityCell.appendChild(itemQuantityInput);

        // Create input field for item_amount
        var itemAmountCell = newRow.insertCell(4);
        var itemAmountInput = document.createElement('input');
        itemAmountInput.className = 'form-control'; // Add class form-control
        itemAmountInput.type = 'text';
        itemAmountInput.name = 'item_amount[]';
        itemAmountInput.placeholder = 'Amount';
        itemAmountCell.appendChild(itemAmountInput);

        // Show the save button
        updateSaveButtonVisibility();
    });

    document.getElementById('deleteRowBtn').addEventListener('click', function() {
        var table = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
        var rows = table.getElementsByTagName('tr');
        if (rows.length > 1) {
            table.deleteRow(rows.length - 1);
        } else {
            // If there's only one row left, hide the save button
            document.getElementById('saveBtn').style.display = 'none';
        }
        // After deletion, update the save button visibility
        updateSaveButtonVisibility();
    });

    document.getElementById('saveBtn').addEventListener('click', function() {
        var table = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
        var rows = table.getElementsByTagName('tr');
        var data = [];

        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            var rowData = [];

            for (var j = 0; j < cells.length; j++) {
                rowData.push(cells[j].innerText);
            }

            data.push(rowData);
        }

        console.log(data); // Here you can save or process the data
    });

    // Function to calculate amount
    // function calculateAmount() {

    //     var sizeSelect = this.value;
    //     var quantityInput = this.parentNode.nextElementSibling.firstChild.value;
        
    //     // Your calculation logic goes here
    //     var amount = sizeSelect * quantityInput;
    //     alert(quantityInput);
    //     // Update amount input field
    //     this.parentNode.nextElementSibling.nextElementSibling.firstChild.value = amount;
    // }
   // Function to calculate amount
    function calculateAmount() {
        var sizeSelect = parseInt(this.parentNode.previousElementSibling.firstChild.value); // Convert to integer
        var quantityInput = parseInt(this.value); // Convert to integer

        // Check if both size and quantity are valid numbers
        if (!isNaN(sizeSelect) && !isNaN(quantityInput)) {
            // Your calculation logic goes here
            var amount = sizeSelect * quantityInput;

            // Update amount input field
            this.parentNode.nextElementSibling.firstChild.value = amount;
        }
    }
 // Function to update the visibility of the save button
    function updateSaveButtonVisibility() {
        var table = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
        var rows = table.getElementsByTagName('tr');
        var hasInputFields = false;

        // Check if any input fields exist in the table rows
        for (var i = 0; i < rows.length; i++) {
            var inputs = rows[i].querySelectorAll('input, select');
            if (inputs.length > 0) {
                hasInputFields = true;
                break;
            }
        }

        // Show or hide the save button based on whether input fields exist
        if (hasInputFields) {
            document.getElementById('saveBtn').style.display = 'block';
        } else {
            document.getElementById('saveBtn').style.display = 'none';
        }
    }
</script>
<!-- Status update form conformation -->
<script>
    function confirmSubmit() {
        if (confirm('Are you sure you want to update the pickup status?')) {
            document.getElementById('pickupStatusForm').submit();
        }
    }
</script>
@endsection
