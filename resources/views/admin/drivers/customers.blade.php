@extends('admin.layouts.layout')
@section('contents')
<div class="row mb-3" style="border-bottom: 2px solid #219653">
    <div class="col-md-6 order-sm-1 order-1 col-8">
        <h1>Customers</h1>
    </div>
    <div class="col-md-4 order-sm-2 order-3 ">
        <div class="input-affix m-b-10">
            <input type="text" class="form-control" placeholder="Search">
            <i class="suffix-icon anticon anticon-search"></i>
        </div>
    </div>
    <div class="col-md-2 order-sm-3 order-2 col-4 ">
        <div class="dropdown dropdown-animated scale-left">
            <button type="button" class="btn btn-primary" data-toggle="dropdown">
                <i class="fas fa-sliders-h"></i>
            <!-- <img src="assets/icons/filter-icon.png"> -->
            <span>Filter</span>
            </button>
            <div class="dropdown-menu">
                <button class="dropdown-item" type="button">Sort By Latest Customers</button>
                <button class="dropdown-item" type="button">Sort By Latest Donations</button>
                <button class="dropdown-item" type="button">Sort By Latest Pickup</button>
            </div>
        </div>
    </div>
</div>
<div class="row flex-column d-none d-sm-block">
    <div class="table-responsive">
        <table class="table table-sm text-center">
                    <thead>
                        <tr class="bg-primary">
                            <th scope="col" class="text-white">ID</th>
                            <th scope="col" class="text-white">Customer Name</th>
                            <th scope="col" class="text-white">Phone Number</th>
                            <th scope="col" class="text-white">Email</th>
                            <th scope="col" class="text-white">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Benjamin Parker</td>
                            <td>+123 456 7890</td>
                            <td>benparker@mail.com</td>
                            <td><span class="badge badge-pill badge-success mr-3">Active</span><a href="donor-details.html"><i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i></a></td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Benjamin Parker</td>
                            <td>+123 456 7890</td>
                            <td>benparker@mail.com</td>
                            <td><span class="badge badge-pill badge-success mr-3">Active</span><a href="donor-details.html"><i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i></a></td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Benjamin Parker</td>
                            <td>+123 456 7890</td>
                            <td>benparker@mail.com</td>
                            <td><span class="badge badge-pill badge-success mr-3">Active</span><a href="donor-details.html"><i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i></a></td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Benjamin Parker</td>
                            <td>+123 456 7890</td>
                            <td>benparker@mail.com</td>
                            <td><span class="badge badge-pill badge-pending mr-3">In-active</span><a href="donor-details.html"><i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i></a></td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Benjamin Parker</td>
                            <td>+123 456 7890</td>
                            <td>benparker@mail.com</td>
                            <td><span class="badge badge-pill badge-success mr-3">Active</span><a href="donor-details.html"><i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i></a></td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td>Benjamin Parker</td>
                            <td>+123 456 7890</td>
                            <td>benparker@mail.com</td>
                            <td><span class="badge badge-pill badge-pending mr-3">In-active</span><a href="donor-details.html"><i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i></a></td>
                        </tr>
                    </tbody>
        </table>
    </div>
    <div class="m-t-20 d-flex justify-content-center ">
        <ul class="pagination justify-content-end">
            <li class="page-item previous"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item"><a class="page-link" href="#">6</a></li>
            <li class="page-item"><a class="page-link" href="#">7</a></li>
            <li class="page-item"><a class="page-link" href="#">8</a></li>
            <li class="page-item"><a class="page-link" href="#">9</a></li>
            <li class="page-item"><a class="page-link" href="#">10</a></li>
            <li class="page-item next"><a class="page-link" href="#">Next</a></li>
        </ul>
    </div>
</div>
<div class="">
    <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
         <div class="d-flex justify-content-between" >
             <p class="text-black"><b>ID:</b> 432</p>
             
         </div>
         <div class="d-flex justify-content-between" >
             <h3 class="text-primary">Benjamin Parkar</h3>
         </div>
         <div class="d-flex justify-content-between" >
             <p class="text-black"><i class="m-r-10 text-primary anticon anticon-phone"></i>  +123 456 789</p>
             <p class="text-black"><b>Email:</b>benparker@mail.com</p>
         </div>
         <div class="d-flex justify-content-end align-items-center" >
             <span class="badge badge-pill badge-success mr-3">Active</span>
              <i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i> 
         </div>
    </div>
    <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
         <div class="d-flex justify-content-between" >
             <p class="text-black"><b>ID:</b> 432</p>
             
         </div>
         <div class="d-flex justify-content-between" >
             <h3 class="text-primary">Benjamin Parkar</h3>
         </div>
         <div class="d-flex justify-content-between" >
             <p class="text-black"><i class="m-r-10 text-primary anticon anticon-phone"></i>  +123 456 789</p>
             <p class="text-black"><b>Email:</b>benparker@mail.com</p>
         </div>
         <div class="d-flex justify-content-end align-items-center" >
             <span class="badge badge-pill badge-success mr-3">Active</span>
              <i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i> 
         </div>
    </div>
    <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
         <div class="d-flex justify-content-between" >
             <p class="text-black"><b>ID:</b> 432</p>
             
         </div>
         <div class="d-flex justify-content-between" >
             <h3 class="text-primary">Benjamin Parkar</h3>
         </div>
         <div class="d-flex justify-content-between" >
             <p class="text-black"><i class="m-r-10 text-primary anticon anticon-phone"></i>  +123 456 789</p>
             <p class="text-black"><b>Email:</b>benparker@mail.com</p>
         </div>
         <div class="d-flex justify-content-end align-items-center" >
             <span class="badge badge-pill badge-success mr-3">Active</span>
              <i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i> 
         </div>
    </div>
    <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
         <div class="d-flex justify-content-between" >
             <p class="text-black"><b>ID:</b> 432</p>
             
         </div>
         <div class="d-flex justify-content-between" >
             <h3 class="text-primary">Benjamin Parkar</h3>
         </div>
         <div class="d-flex justify-content-between" >
             <p class="text-black"><i class="m-r-10 text-primary anticon anticon-phone"></i>  +123 456 789</p>
             <p class="text-black"><b>Email:</b>benparker@mail.com</p>
         </div>
         <div class="d-flex justify-content-end align-items-center" >
             <span class="badge badge-pill badge-success mr-3">Active</span>
              <i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i> 
         </div>
    </div>
    <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
         <div class="d-flex justify-content-between" >
             <p class="text-black"><b>ID:</b> 432</p>
             
         </div>
         <div class="d-flex justify-content-between" >
             <h3 class="text-primary">Benjamin Parkar</h3>
         </div>
         <div class="d-flex justify-content-between" >
             <p class="text-black"><i class="m-r-10 text-primary anticon anticon-phone"></i>  +123 456 789</p>
             <p class="text-black"><b>Email:</b>benparker@mail.com</p>
         </div>
         <div class="d-flex justify-content-end align-items-center" >
             <span class="badge badge-pill badge-success mr-3">Active</span>
              <i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i> 
         </div>
    </div>
</div>
@endsection