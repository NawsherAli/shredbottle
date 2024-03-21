<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Donation;
use App\Models\Customer;
use App\Models\Fundraiser;
use App\Models\Pickup;
use Carbon\Carbon;
class TransactionController extends Controller
{
	//All transactions on admin side
    public function index(){
    	$transactions = Transaction::with('customer.user','fundraiser.user')->paginate(10);
    	// dd($transactions->all());
    	return view('admin.transaction.index',compact('transactions'));
    }

    //Customer transactions
    public function customerIndex(){

        $userid = Auth::user()->id;
        $customer= Customer::where('user_id',$userid)->first();
        // dd($customer->all());
        $transactions = Transaction::with('customer.user')->where('customer_id','=',$customer->id)->paginate(10);
        // dd($transactions->all());
        return view('customer.transaction.index',compact('transactions'));
    }

    //Fundraiser transactions
    public function fundraiserIndex(){

        $userid = Auth::user()->id;
        $fundraiser= Fundraiser::where('user_id',$userid)->first();
        // dd($customer->all());
        $transactions = Transaction::with('customer.user')->where('fundraiser_id','=',$fundraiser->id)->paginate(10);
        // dd($transactions->all());
        return view('fundraiser.transaction.index',compact('transactions'));
    }

    //Search transactions by admin
    public function transactionsSearch(Request $request)
    {
        $search = $request->input('search');

        $transactions = Transaction::where(function ($query) use ($search) {
		    $query->whereHas('customer.user', function ($query) use ($search) {
		        $query->where('name', 'like', '%' . $search . '%');
		    })->orWhereHas('fundraiser.user', function ($query) use ($search) {
		        $query->where('name', 'like', '%' . $search . '%');
		    });
		})
		->with(['customer.user', 'fundraiser.user'])
		->paginate(10);
        return view('admin.transaction.index',compact('transactions'));
    }

    //Customer Search transactions
    public function customerTransactionsSearch(Request $request)
    {
        $search = $request->input('search');
        $userid = Auth::user()->id;
        $customer= Customer::where('user_id',$userid)->first();
        
        $transactions = Transaction::with('customer.user')
                    ->where('customer_id', '=', $customer->id)
                    ->where(function ($query) use ($search) {
                        $query->where('transaction_no', 'like', "%$search%")
                              ->orWhere('request_id', 'like', "%$search%");
                    })
                    ->paginate(10);
        return view('customer.transaction.index',compact('transactions'));
    }

    //Fundraiser Search transactions
    public function fundraiserTransactionsSearch(Request $request)
    {
        $search = $request->input('search');
        $userid = Auth::user()->id;
        $fundraiser= Fundraiser::where('user_id',$userid)->first();
        
        $transactions = Transaction::with('fundraiser.user')
                    ->where('fundraiser_id', '=', $fundraiser->id)
                    ->where(function ($query) use ($search) {
                        $query->where('transaction_no', 'like', "%$search%")
                              ->orWhere('request_id', 'like', "%$search%");
                    })
                    ->paginate(10);
        // dd($transactions);
        return view('fundraiser.transaction.index',compact('transactions'));
    }

    //Transaction Filters by admin
    public function transactionFilter(Request $request)
    {
        $query = Transaction::with('customer.user','fundraiser.user');

        if ($request->has('sort')) {
            $sort = $request->input('sort');

            switch ($sort) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'completed':
                    $query->where('status', 'Completed');
                    break;
                case 'pending':
                    $query->where('status', 'Pending');
                    break;
                case 'customer':
                    $query->where('type', 'customer');
                    break;
                case 'fundraiser':
                    $query->where('type', 'fundraiser');
                    break;	    
                default:
                    // handle any other cases or defaults
                    break;
            }
        }

        $transactions = $query->paginate(10);

        return view('admin.transaction.index',compact('transactions'));
    }

    //CustomerTransaction Filters
    public function customerTransactionFilter(Request $request)
    {
        $userid = Auth::user()->id;
        $customer= Customer::where('user_id',$userid)->first();
        $query = Transaction::with('customer.user')->where('customer_id','=',$customer->id);

        if ($request->has('sort')) {
            $sort = $request->input('sort');

            switch ($sort) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'completed':
                    $query->where('status', 'Completed');
                    break;
                case 'pending':
                    $query->where('status', 'Pending');
                    break;     
                default:
                    // handle any other cases or defaults
                    break;
            }
        }

        $transactions = $query->paginate(10);

        return view('customer.transaction.index',compact('transactions'));
    }


    //Fundraiser Transaction Filters
    public function fundraiserTransactionFilter(Request $request)
    {
        $userid = Auth::user()->id;
        $fundraiser= Fundraiser::where('user_id',$userid)->first();
        $query = Transaction::with('fundraiser.user')->where('fundraiser_id','=',$fundraiser->id);

        if ($request->has('sort')) {
            $sort = $request->input('sort');

            switch ($sort) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'completed':
                    $query->where('status', 'Completed');
                    break;
                case 'pending':
                    $query->where('status', 'Pending');
                    break;     
                default:
                    // handle any other cases or defaults
                    break;
            }
        }

        $transactions = $query->paginate(10);

        return view('fundraiser.transaction.index',compact('transactions'));
    } 

    //Admin View Transaction
    public function adminViewTransaction($id){

    	$transaction = Transaction::with('customer.user','fundraiser.user')->findOrFail($id);
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

  		if($transaction->type == 'customer'){

            $user_donated_amount = Donation::where('donor_id','=',$transaction->customer->id)->where('status','Completed')->sum('amount');
            $user_cashout_amount = Transaction::where('customer_id','=',$transaction->customer->id)->where('status','Completed')->sum('amount');

            //this week donation & donated items
            
            
            $this_week_donation = Donation::where('donor_id','=',$transaction->customer->id)
                                  ->whereBetween('created_at', [$startDate, $endDate])
                                  ->where('status','Completed')
                                  ->sum('amount');

            $this_week_total_cashout_amount  = Pickup::where('customer_id','=',$transaction->customer->id)
                ->where('payment_option','=','Cashout')
                ->whereBetween('created_at', [$startDate, $endDate])->where('status','Completed')->sum('amount');

            $this_week_total_cashout = Transaction::where('customer_id','=',$transaction->customer->id) ->whereBetween('created_at', [$startDate, $endDate])->where('status','Completed')->sum('amount'); 

  			return view('admin.transaction.view-customer-transaction',compact('transaction','user_donated_amount','user_cashout_amount','this_week_donation','this_week_total_cashout_amount','this_week_total_cashout'));
    	}else{

            $user_donated_amount = Donation::where('charity_id','=',$transaction->fundraiser->id)->where('status','Completed')->sum('amount');

            $user_cashout_amount = Transaction::where('fundraiser_id','=',$transaction->fundraiser->id)->where('status','Completed')->sum('amount');

            $this_week_donation = Donation::where('charity_id','=',$transaction->fundraiser->id)
                                  ->whereBetween('created_at', [$startDate, $endDate])
                                  ->where('status','Completed')
                                  ->sum('amount');

            $this_week_total_cashout = Transaction::where('fundraiser_id','=',$transaction->fundraiser->id) ->whereBetween('created_at', [$startDate, $endDate])->where('status','Completed')->sum('amount');                      

    		return view('admin.transaction.view-fundraiser-transaction',compact('transaction','user_donated_amount','user_cashout_amount','this_week_donation','this_week_total_cashout'));
    	}
    }

    //Transaction update

    public function transactionUpdate(Request $request, $id)
    {
        // dd($id);
        $request->validate([
            'amount' => 'required|numeric',
            'date' => 'required',
            'transaction_id' => 'required',
        ]);
        $transaction = Transaction::findOrFail($id);

        if ($transaction->type == 'customer') {
           
            $customer = Customer::findOrFail($transaction->customer_id);
            $customer->current_balance = $customer->current_balance + $transaction->amount;
            $customer->save();

            if($customer->current_balance >= $request->amount){

                $transaction->amount = $request->amount;
                $transaction->transaction_date = $request->date;
                $transaction->transaction_no = $request->transaction_id;
                $transaction->status = 'Completed';
                if($transaction->save()){
                    $customer->current_balance = $customer->current_balance - $transaction->amount;

                    if($customer->save()){
                        return redirect()->back()->with('success', 'Amount request updated successfully!');
                    }
                }

            }else{
                return redirect()->back()->with('error', 'Customer have not enough amount to send!');
            }

        }else{

            $fundraiser = Fundraiser::findOrFail($transaction->fundraiser_id);
            $fundraiser->current_balance = $fundraiser->current_balance + $transaction->amount;
            $fundraiser->save();
            
            if($fundraiser->current_balance >= $request->amount){

                $transaction->amount = $request->amount;
                $transaction->transaction_date = $request->date;
                $transaction->transaction_no = $request->transaction_id;
                $transaction->status = 'Completed';
                if($transaction->save()){
                    $fundraiser->current_balance = $fundraiser->current_balance - $transaction->amount;

                    if($fundraiser->save()){
                        return redirect()->back()->with('success', 'Amount request updated successfully!');
                    }
                }

            }else{
                return redirect()->back()->with('error', 'Customer have not enough amount to send!');
            }
        }
    }
}
