<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FundraiserController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ProfileRequestController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

//Admin dashboard route
// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('admin.dashboard');
Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->middleware(['auth', 'verified'])->name('admin.dashboard');

//Fundraiser dashboard route
Route::get('/fundraiser/dashboard', [DashboardController::class, 'fundraiserDashboard'])->middleware(['auth', 'verified'])->name('fundraiser.dashboard');


//Customer dashboard route
Route::get('/customer/dashboard', [DashboardController::class, 'customerDashboard'])->middleware(['auth', 'verified'])->name('customer.dashboard');


//Customer setting route

// Route::get('/customer/setting', function () {
//     return view('customer.setting.index');
// })->middleware(['auth', 'verified'])->name('setting');

Route::middleware('auth')->group(function () {

	//Profile edit routes
	Route::get('/admin/profile', [ProfileController::class, 'adminEdit'])->name('admin.profile.edit');

    Route::get('/customer/profile', [ProfileController::class, 'customerEdit'])->name('customer.profile.edit');
    Route::get('/fundraiser/profile', [ProfileController::class, 'fundraiseredit'])->name('fundraiser.profile.edit');

    //Profile update routes
    Route::patch('/admin/profile', [ProfileController::class, 'adminUpdate'])->name('admin.profile.update');
    Route::patch('/customer/profile', [ProfileController::class, 'customerUpdate'])->name('customer.profile.update');

    //Fundraiser profile image update
    Route::post('/update-profile-picture', [ProfileController::class, 'updateProfilePicture'])->name('update.profile.picture');


    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//////////////////////// Admin Routes ////////////////////////////////////
    Route::get('/admin/pickup-request', [PickupController::class, 'adminPickupIndex'])->name('admin.pickup');
    Route::get('admin/pickup-request/search', [PickupController::class, 'pickupSearch'])->name('pickup.search');
    Route::get('/pickup-request/filter', [PickupController::class, 'pickupFilter'])->name('pickups.filter');
    Route::get('admin/pickup-request/view/{id}',[PickupController::class, 'adminViewPickup'])->name('admin.pickup.view');
    Route::put('admin/pickup-request/update/{id}', [PickupController::class, 'pickupUpdate'])->name('pickup.update');


    //Admin all donations route
    Route::get('/admin/donations', [DonationController::class, 'adminIndex'])->name('admin.donations');
     //search donation
    Route::get('admin/donations/search', [DonationController::class, 'adminDonationSearch'])->name('admin.donation.search');

    //Filter Donations
    Route::get('admin/donations/sort/latest', [DonationController::class, 'adminSortByLatest'])->name('admin.donations.sort.latest');
    Route::get('admin/donations/sort/highest', [DonationController::class, 'adminSortByHighest'])->name('admin.donations.sort.highest');

    //View Donationation Donor
    Route::get('admin/donations/donor/view/{id}', [DonationController::class, 'adminDonorView'])->name('admin.donations.donor.view');


    //fundraiser donations
    Route::get('/admin/fundraisers/donations', [FundraiserController::class, 'fundraiserDonations'])->name('admin.fundraiser.donations');
    //search fundraising donation
    Route::get('admin/fundraising/donations/search', [FundraiserController::class, 'adminDonationSearch'])->name('admin.fundraising.donation.search');

    //Filter Donations
    Route::get('admin/fundraising/sort/latest', [FundraiserController::class, 'adminSortByLatest'])->name('admin.fundraising.donations.sort.latest');
    Route::get('admin/fundraising/donations/sort/highest', [FundraiserController::class, 'adminSortByHighest'])->name('admin.fundraising.donations.sort.highest');


    //Profile Requests
    Route::get('/profile/requests', [ProfileRequestController::class, 'index'])->name('profile.request.index');
    Route::get('profile/requests/search', [ProfileRequestController::class, 'requestSearch'])->name('profile.request.search');
    Route::get('profile/requests/filter', [ProfileRequestController::class, 'requestFilter'])->name('requests.filter');
    Route::get('profile/request/view/{id}',[ProfileRequestController::class, 'profileRequestView'])->name('profile.request.view');
    Route::put('profile/request/update/{id}', [ProfileRequestController::class, 'requestUpdate'])->name('request.update');

//////////////////////// Customer Routes /////////////////////////////////
    // customer create pickup request route
    Route::get('/customer/create/pickup-request', [PickupController::class, 'create'])->name('pickup.create');

    //customer store pickup request route
    Route::post('/customer/store/pickup-request', [PickupController::class, 'store'])->name('pickup.store');
    //customer view pickup request
    Route::get('customer/pickup-request/view/{id}',[PickupController::class, 'customerViewPickup'])->name('customer.pickup.view');

    //customer all donations route
    Route::get('/customer/donations', [DonationController::class, 'customerIndex'])->name('customer.donations');
    //search donation
    Route::get('customer/donations/search', [DonationController::class, 'customerDonationSearch'])->name('customer.donation.search');

    //Filter Donations
    Route::get('customer/donations/sort/latest', [DonationController::class, 'customerSortByLatest'])->name('customer.donations.sort.latest');
    Route::get('customer/donations/sort/highest', [DonationController::class, 'customerSortByHighest'])->name('customer.donations.sort.highest');


    Route::get('/customer/fundraisers', [FundraiserController::class, 'customerIndex'])->name('customer.fundraiser.index');
    //Customer view charity
    Route::get('/customer/fundraisers/view/{id}', [FundraiserController::class, 'customerFundraiserView'])->name('customer.fundraiser.view');
    //search fundraiser
    Route::get('customer/fundraiser/search', [FundraiserController::class, 'customerFundraiserSearch'])->name('customer.fundraiser.search');

    //Customer Donation 
    Route::get('/customer/donate/now', [DonationController::class, 'donateNow'])->name('donate.now');




Route::get('customer/view/donor', function () {
    return view('customer.donations.donar-details');
})->name('customer.donor-view');

////////////////////////////////////Admin Routes//////////////////////////////
//Admin Driver Routes 
Route::get('/drivers', [DriverController::class, 'index'])->name('drivers.index');
Route::get('/drivers/create', [DriverController::class, 'create'])->name('drivers.create');
Route::post('/drivers', [DriverController::class, 'store'])->name('drivers.store');
Route::get('/drivers/{id}/edit', [DriverController::class, 'edit'])->name('drivers.edit');
Route::put('/drivers/{id}', [DriverController::class, 'update'])->name('drivers.update');
Route::delete('/drivers/{id}',[DriverController::class, 'destroy'])->name('drivers.destroy');

//View single Driver
Route::get('/view-driver/{id}',[DriverController::class, 'viewDriver'])->name('view.driver');
//search driver
Route::get('/drivers/search', [DriverController::class, 'search'])->name('drivers.search');

//Admin customer routes
Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
Route::get('/view-customer/{id}',[CustomerController::class, 'viewCustomer'])->name('view.customer');
Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
//search driver
Route::get('/customer/search', [CustomerController::class, 'search'])->name('customer.search');

//Admin charities/fundraisers routes
Route::get('/admin/fundraisers', [FundraiserController::class, 'adminIndex'])->name('admin.fundraiser.index');
//Admin view charity
Route::get('/admin/fundraisers/view/{id}', [FundraiserController::class, 'adminFundraiserView'])->name('admin.fundraiser.view');
//admin search fundraiser
Route::get('admin/fundraiser/search', [FundraiserController::class, 'adminFundraiserSearch'])->name('admin.fundraiser.search');


////////////////////////////////// Fundraiser Routes /////////////////////////////////////
    //fundraiser all donations route
    Route::get('/fundraiser/donations', [DonationController::class, 'fundraiserIndex'])->name('fundraiser.donations');
    //search donation
    Route::get('fundraiser/donations/search', [DonationController::class, 'fundraiserDonationSearch'])->name('fundraiser.donation.search');

    //Filter Donations
    Route::get('fundraiser/donations/sort/latest', [DonationController::class, 'fundraiserSortByLatest'])->name('fundraiser.donations.sort.latest');
    Route::get('fundraiser/donations/sort/highest', [DonationController::class, 'fundraiserSortByHighest'])->name('fundraiser.donations.sort.highest');


    //Fundraiser profile request
    Route::post('/profile/requests/store', [ProfileRequestController::class, 'store'])->name('store.profile.request');

Route::get('admin/view/donor', function () {
    return view('admin.donations.donar-details');
})->name('admin.donor-view');








//Fundraiser
// Route::get('/fundraiser/donations', function () {
//     return view('fundraiser.donations.index');
// });

Route::get('fundraiser/view/donor', function () {
    return view('fundraiser.donations.donar-details');
})->name('fundraiser.donor-view');

Route::get('fundraiser/chat', function () {
    return view('fundraiser.chat.index');
})->name('fundraiser.chat');



//Test Routs
Route::get('/test', function () {
    return view('test');
});

require __DIR__.'/auth.php';
