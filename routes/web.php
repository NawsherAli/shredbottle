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
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ServicesController;

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

///////////////////////// Admin Routes Start //////////////////////////////////
Route::middleware('admin','auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->middleware(['auth', 'verified'])->name('admin.dashboard');

    //Profile edit routes
    Route::get('/admin/profile', [ProfileController::class, 'adminEdit'])->name('admin.profile.edit');
    //Profile update routes
    Route::patch('/admin/profile', [ProfileController::class, 'adminUpdate'])->name('admin.profile.update');

    Route::get('/admin/pickup-request', [PickupController::class, 'adminPickupIndex'])->name('admin.pickup');
    Route::get('admin/pickup-request/search', [PickupController::class, 'pickupSearch'])->name('pickup.search');
    Route::get('/pickup-request/filter', [PickupController::class, 'pickupFilter'])->name('pickups.filter');
    Route::get('admin/pickup-request/view/{id}',[PickupController::class, 'adminViewPickup'])->name('admin.pickup.view');
    Route::put('admin/pickup-request/update/{id}', [PickupController::class, 'pickupUpdate'])->name('pickup.update');
    Route::put('admin/pickup/status/update/{id}', [PickupController::class, 'pickupStatusUpdate'])->name('pickup.status.update');
    //admin delete items details
    Route::delete('/items/details/{id}',[PickupController::class, 'itemDetailsDestroy'])->name('item.details.destroy');
    //admin edit items details
    Route::get('/items/details/{id}/edit', [PickupController::class, 'itemDetailsEdit'])->name('item.details.edit');


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



    //accounts routes
    Route::get('/customer/accounts/', [AccountsController::class, 'customerIndex'])->name('admin.accounts.customer.index');
    Route::get('/fundraiser/accounts/', [AccountsController::class, 'fundraiserIndex'])->name('admin.accounts.fundraiser.index');

    //accounts search
    Route::get('/customer/accounts/search', [AccountsController::class, 'customerAccountSearch'])->name('accounts.customer.search');
    Route::get('/fundraiser/accounts/search', [AccountsController::class, 'fundraiserAccountSearch'])->name('accounts.fundraiser.search');

    //accounts filters
    Route::get('/customer/accounts/sort/highest', [AccountsController::class, 'customerAccountsSortByHighest'])->name('accounts.customer.sort.higestbalance');
    Route::get('/customer/accounts/sort/lowest', [AccountsController::class, 'customerAccountsSortByLowest'])->name('accounts.customer.sort.lowestbalance');

    //admin create claim balance request
    Route::post('admin/claim/balance/request/{id}', [AccountsController::class, 'adminClaimBalance'])->name('admin.claim.balance.request');

    //Transactions 
    Route::get('/transactions/', [TransactionController::class, 'index'])->name('transactions.index');

    //Transaction search
    Route::get('/transactions/search', [TransactionController::class, 'transactionsSearch'])->name('transaction.search');

    //Filters Transactions
    Route::get('/transactions/filter', [TransactionController::class, 'transactionFilter'])->name('transaction.filter');

    //admin view transaction
    Route::get('admin/transaction/view/{id}',[TransactionController::class, 'adminViewTransaction'])->name('admin.transaction.view');

    //admin transaction update
    Route::put('admin/transaction/update/{id}', [TransactionController::class, 'transactionUpdate'])->name('admin.transaction.update');

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


    //Admin charities Routes 
    Route::get('/charities', [CharityController::class, 'index'])->name('charities.index');
    Route::get('/charities/create', [CharityController::class, 'create'])->name('charities.create');
    Route::post('/charities/store', [CharityController::class, 'store'])->name('charities.store');
    Route::get('/charities/{id}/edit', [CharityController::class, 'edit'])->name('charities.edit');
    Route::put('/charities/{id}', [CharityController::class, 'update'])->name('charities.update');
    Route::post('/charities/{id}',[CharityController::class, 'destroy'])->name('charities.destroy');
    Route::get('/charities/search', [CharityController::class, 'search'])->name('charities.search');
    Route::post('/charities/image/upload', [BlogController::class, 'uploadImage'])->name('ckeditor.upload.charity');

    //Admin materials Routes 
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
    Route::post('/materials/store', [MaterialController::class, 'store'])->name('materials.store');
    Route::get('/materials/{id}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
    Route::put('/materials/{id}', [MaterialController::class, 'update'])->name('materials.update');
    Route::post('/materials/{id}',[MaterialController::class, 'destroy'])->name('materials.destroy');
    Route::get('/materials/search', [MaterialController::class, 'search'])->name('materials.search');
    Route::post('/materials/image/upload', [BlogController::class, 'uploadImage'])->name('ckeditor.upload.material');

    //Admin services Routes 
    Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServicesController::class, 'create'])->name('services.create');
    Route::post('/services/store', [ServicesController::class, 'store'])->name('services.store');
    Route::get('/services/{id}/edit', [ServicesController::class, 'edit'])->name('services.edit');
    Route::put('/services/{id}', [ServicesController::class, 'update'])->name('services.update');
    Route::post('/services/{id}',[ServicesController::class, 'destroy'])->name('services.destroy');
    Route::get('/services/search', [ServicesController::class, 'search'])->name('services.search');
    Route::post('/services/image/upload', [BlogController::class, 'uploadImage'])->name('ckeditor.upload.service');

    //Admin blogs Routes 
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::post('/blogs/{id}',[BlogController::class, 'destroy'])->name('blogs.destroy');
    Route::get('/blogs/search', [BlogController::class, 'search'])->name('blogs.search');
    Route::post('/blogs/image/upload', [BlogController::class, 'uploadImage'])->name('ckeditor.upload');
});

///////////////////////// Admin Routes End   //////////////////////////////////

///////////////////////// Customers Routes Start /////////////////////////////
Route::middleware('customer','auth','userStatus')->group(function () {
    //Customer dashboard route
    Route::get('/customer/dashboard', [DashboardController::class, 'customerDashboard'])->middleware(['auth', 'verified'])->name('customer.dashboard');

    Route::get('/customer/profile', [ProfileController::class, 'customerEdit'])->name('customer.profile.edit');
    Route::patch('/customer/profile', [ProfileController::class, 'customerUpdate'])->name('customer.profile.update');

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

    //Store donated money
    Route::post('/customer/donate/money', [DonationController::class, 'donateMoney'])->name('donate.money');


    //Customer Transactions 
    Route::get('/customer/transactions/', [TransactionController::class, 'customerIndex'])->name('customer.transactions.index');

    //Customer Transaction search
    Route::get('/customer/transactions/search', [TransactionController::class, 'customerTransactionsSearch'])->name('customer.transaction.search');

    //Customer Filters Transactions
    Route::get('/customer/transactions/filter', [TransactionController::class, 'customerTransactionFilter'])->name('customer.transaction.filter');


    Route::get('customer/view/donor', function () {
        return view('customer.donations.donar-details');
    })->name('customer.donor-view');

});

///////////////////////// Customers Routes End //////////////////////////////

/////////////////////////// Fundraiser Routes Start //////////////////////////
Route::middleware('fundraiser')->group(function () {
    //Fundraiser dashboard route
    Route::get('/fundraiser/dashboard', [DashboardController::class, 'fundraiserDashboard'])->middleware(['auth', 'verified'])->name('fundraiser.dashboard');

    Route::get('/fundraiser/profile', [ProfileController::class, 'fundraiseredit'])->name('fundraiser.profile.edit');
    
    //Fundraiser profile image update
    Route::post('/update-profile-picture', [ProfileController::class, 'updateProfilePicture'])->name('update.profile.picture');

        //fundraiser all donations route
    Route::get('/fundraiser/donations', [DonationController::class, 'fundraiserIndex'])->name('fundraiser.donations');
    //search donation
    Route::get('fundraiser/donations/search', [DonationController::class, 'fundraiserDonationSearch'])->name('fundraiser.donation.search');

    //Filter Donations
    Route::get('fundraiser/donations/sort/latest', [DonationController::class, 'fundraiserSortByLatest'])->name('fundraiser.donations.sort.latest');
    Route::get('fundraiser/donations/sort/highest', [DonationController::class, 'fundraiserSortByHighest'])->name('fundraiser.donations.sort.highest');

    //View Donationation Donor
    // Route::get('admin/donations/donor/view/{id}', [DonationController::class, 'adminDonorView'])->name('fundraiser.donations.donor.view');

    //Fundraiser profile request
    Route::post('/profile/requests/store', [ProfileRequestController::class, 'store'])->name('store.profile.request');

    //Fundraiser Transactions 
    Route::get('/fundraiser/transactions/', [TransactionController::class, 'fundraiserIndex'])->name('fundraiser.transactions.index');

    //Fundraiser Transaction search
    Route::get('/fundraiser/transactions/search', [TransactionController::class, 'fundraiserTransactionsSearch'])->name('fundraiser.transaction.search');

    //Fundraiser Filters Transactions
    Route::get('/fundraiser/transactions/filter', [TransactionController::class, 'fundraiserTransactionFilter'])->name('fundraiser.transaction.filter');

});
/////////////////////////// Fundraiser Routes End ////////////////////////////


Route::middleware('auth')->group(function () {
    Route::post('/mark-as-read/{id}',  [NotificationController::class, 'markAsRead'])->name('mark-as-read');
	
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



////////////////////////////////// Fundraiser Routes /////////////////////////////////////





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
Route::get('/customer/email', function () {
    return view('emails.donation');
});

require __DIR__.'/auth.php';
