@extends('admin.layouts.layout')
@section('contents')
<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="card bg-primary br-10">
            <div class="card-body">
                <p class="m-b-0 text-white">Total Donations Collected</p>
                <div class="d-flex   align-items-center">
                    <h2 class="m-b-0 text-white">
                        <span>$227.99 </span>
                    </h2>
                    <p class="text-white pt-3 ml-1"> Updated 30m ago</p>
                </div>    
                <p class="text-white">+50$ this week</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card bg-primary br-10">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="m-b-0 text-white">Total Pickups</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="m-b-0 text-white mr-2">
                            <span>12</span>
                        </h2>
                        <p class="text-white pt-3"> Updated 30m ago</p>
                    </div>    
                        
                        <p class="text-white">4 this week</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card bg-primary br-10">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="m-b-0 text-white">Total Shredded</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="m-b-0 text-white mr-2">
                            <span>139</span>
                        </h2>
                        <p class="text-white pt-3"> Items Shredded</p>
                    </div>    
                        
                        <p class="text-white">5 items this week</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between">
           <ul class="nav nav-tabs" id="myTab" role="tablist" >
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Latest Pickups</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Latest Donations</a>
                </li>
            </ul>
        <button class="btn btn-primary">View All Donations</button> 
        </div>
           
	    <div class="tab-content m-t-15" id="myTabContent">
	        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
	           <div class="table-responsive d-none d-sm-block">
	                <table class="table table-sm text-center">
	                    <thead>
	                        <tr class="bg-primary">
	                            <th scope="col" class="text-white">ID</th>
	                            <th scope="col" class="text-white">Customer Name</th>
	                            <th scope="col" class="text-white">Phone Number</th>
	                            <th scope="col" class="text-white">Pickup Quantity</th>
	                            <th scope="col" class="text-white">Pickup Date</th>
	                            <th scope="col" class="text-white">Status</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <tr>
	                            <th scope="row">1</th>
	                            <td>Banjamin Parkar</td>
	                            <td>+123 456 789</td>
	                            <td>1Box-3Bags</td>
	                            <td>10/10/24</td>
	                            <td><span class="badge badge-pill badge-success mr-3">Active</span><i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i></td>
	                        </tr>
	                        <tr>
	                            <th scope="row">2</th>
	                            <td>Banjamin Parkar</td>
	                            <td>+123 456 789</td>
	                            <td>1Box-3Bags</td>
	                            <td>10/10/24</td>
	                            <td><span class="badge badge-pill badge-success mr-3">Active</span><i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i></td>
	                        </tr>
	                        <tr>
	                            <th scope="row">3</th>
	                            <td>Banjamin Parkar</td>
	                            <td>+123 456 789</td>
	                            <td>1Box-3Bags</td>
	                            <td>10/10/24</td>
	                            <td><span class="badge badge-pill badge-success mr-3">Active</span><i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i></td>
	                        </tr>
	                    </tbody>
	                </table>
	            </div>
	            <div class="">
	                <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>ID:</b> 432</p>
	                         <p class="text-black"><i class="far fa-calendar-alt"></i> 10/10/2023</p>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <h3 class="text-primary">Benjamin Parkar</h3>
	                         <h3 class="text-primary">1 Box - 3 Bags</h3>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><i class="anticon anticon-phone text-primary"></i> +123 456 789</p>
	                         <div class="" >
	                            <span class="badge badge-pill badge-success mr-3">Active</span>
	                          <i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i> 
	                         </div>
	                     </div>
	                </div>
	                <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>ID:</b> 432</p>
	                         <p class="text-black"><i class="far fa-calendar-alt"></i> 10/10/2023</p>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <h3 class="text-primary">Benjamin Parkar</h3>
	                         <h3 class="text-primary">$10</h3>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>Charity Type:</b> School</p>
	                         <p class="text-black"><b>Charity Name:</b> School</p>
	                     </div>
	                     <div class="d-flex justify-content-end align-items-center" >
	                         <span class="badge badge-pill badge-success mr-3">Active</span>
	                          <i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i> 
	                     </div>
	                </div>
	                <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>ID:</b> 432</p>
	                         <p class="text-black"><i class="far fa-calendar-alt"></i> 10/10/2023</p>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <h3 class="text-primary">Benjamin Parkar</h3>
	                         <h3 class="text-primary">$10</h3>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>Charity Type:</b> School</p>
	                         <p class="text-black"><b>Charity Name:</b> School</p>
	                     </div>
	                     <div class="d-flex justify-content-end align-items-center" >
	                         <span class="badge badge-pill badge-success mr-3">Active</span>
	                          <i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i> 
	                     </div>
	                </div>
	                <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>ID:</b> 432</p>
	                         <p class="text-black"><i class="far fa-calendar-alt"></i> 10/10/2023</p>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <h3 class="text-primary">Benjamin Parkar</h3>
	                         <h3 class="text-primary">$10</h3>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>Charity Type:</b> School</p>
	                         <p class="text-black"><b>Charity Name:</b> School</p>
	                     </div>
	                     <div class="d-flex justify-content-end align-items-center" >
	                         <span class="badge badge-pill badge-success mr-3">Active</span>
	                          <i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i> 
	                     </div>
	                </div>
	            </div>
	        </div>
	        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	             <div class="table-responsive d-none d-sm-block">
	                <table class="table table-sm text-center">
	                    <thead>
	                        <tr class="bg-primary">
	                            <th scope="col" class="text-white">ID</th>
	                            <th scope="col" class="text-white">Donor Name</th>
	                            <th scope="col" class="text-white">Donation Amount</th>
	                            <th scope="col" class="text-white">Charity Type</th>
	                            <th scope="col" class="text-white">Charity Name</th>
	                            <th scope="col" class="text-white">Number of Items Donated</th>
	                            <th scope="col" class="text-white">Status</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <tr>
	                            <th scope="row">1</th>
	                            <td>Mark</td>
	                            <td>Otto</td>
	                            <td>@mdo</td>
	                            <td>@mdo</td>
	                            <td>@mdo</td>
	                            <td><span class="badge badge-pill badge-pending mr-3">Pending</span><i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i></td>
	                        </tr>
	                        <tr>
	                            <th scope="row">2</th>
	                            <td>Jacob</td>
	                            <td>Thornton</td>
	                            <td>@fat</td>
	                            <td>@mdo</td>
	                            <td>@mdo</td>
	                            <td><span class="badge badge-pill badge-pending mr-3">Pending</span><i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i></td>
	                        </tr>
	                        <tr>
	                            <th scope="row">3</th>
	                            <td>Larry the Bird</td>
	                            <td>@twitter</td>
	                            <td>@mdo</td>
	                            <td>@mdo</td>
	                            <td>@mdo</td>
	                            <td><span class="badge badge-pill badge-pending mr-3">Pending</span><i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i></td>
	                        </tr>
	                    </tbody>
	                </table>

	            </div>
	            <div class="">
	                <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>ID:</b> 432</p>
	                         <p class="text-black"><i class="far fa-calendar-alt"></i> 10/10/2023</p>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <h3 class="text-primary">Benjamin Parkar</h3>
	                         <h3 class="text-primary">$10</h3>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>Charity Type:</b> School</p>
	                         <p class="text-black"><b>Charity Name:</b> School</p>
	                     </div>
	                     <div class="d-flex justify-content-end align-items-center" >
	                         <span class="badge badge-pill badge-success mr-3">Active</span>
	                          <i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i> 
	                     </div>
	                </div>
	                <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>ID:</b> 432</p>
	                         <p class="text-black"><i class="far fa-calendar-alt"></i> 10/10/2023</p>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <h3 class="text-primary">Benjamin Parkar</h3>
	                         <h3 class="text-primary">$10</h3>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>Charity Type:</b> School</p>
	                         <p class="text-black"><b>Charity Name:</b> School</p>
	                     </div>
	                     <div class="d-flex justify-content-end align-items-center" >
	                         <span class="badge badge-pill badge-success mr-3">Active</span>
	                          <i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i> 
	                     </div>
	                </div>
	                <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>ID:</b> 432</p>
	                         <p class="text-black"><i class="far fa-calendar-alt"></i> 10/10/2023</p>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <h3 class="text-primary">Benjamin Parkar</h3>
	                         <h3 class="text-primary">$10</h3>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>Charity Type:</b> School</p>
	                         <p class="text-black"><b>Charity Name:</b> School</p>
	                     </div>
	                     <div class="d-flex justify-content-end align-items-center" >
	                         <span class="badge badge-pill badge-success mr-3">Active</span>
	                          <i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i> 
	                     </div>
	                </div>
	                <div class="col-12  br-10 border-primary1 pb-2 d-block d-sm-none mb-3">
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>ID:</b> 432</p>
	                         <p class="text-black"><i class="far fa-calendar-alt"></i> 10/10/2023</p>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <h3 class="text-primary">Benjamin Parkar</h3>
	                         <h3 class="text-primary">$10</h3>
	                     </div>
	                     <div class="d-flex justify-content-between" >
	                         <p class="text-black"><b>Charity Type:</b> School</p>
	                         <p class="text-black"><b>Charity Name:</b> School</p>
	                     </div>
	                     <div class="d-flex justify-content-end align-items-center" >
	                         <span class="badge badge-pill badge-success mr-3">Active</span>
	                          <i class="fas fa-external-link-alt table-view-icon p-5 badge-success-lighter br-100"></i> 
	                     </div>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>
</div>

@endsection 