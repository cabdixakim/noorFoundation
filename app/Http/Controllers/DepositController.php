<?php

namespace App\Http\Controllers;

use App\User;
use App\Deposit;
use App\Sponsor;
use App\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DepositNotification;
use App\Http\Requests\CreateDepositRequest;
use Illuminate\Support\Facades\Notification;

class DepositController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('admin')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $groupedData = Deposit::orderBy('created_at','desc')->get()->groupBy(function($val) {
            return Carbon::parse($val->created_at)->format('Y-M');
      });
    //   dd($groupedData);
         $balance = Deposit::all()->sum('amount') - Withdraw::all()->sum('amount');
         if(Auth::check()){
             if(auth()->user()->user_type == 'admin'){
             return view('admin.listDeposits',compact('groupedData','balance'));
         } else {
            return view('randomUsersListDeposits',compact('groupedData','balance'));
         }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sponsors = Sponsor::all();
        
        return view('admin.createDeposit',compact('sponsors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDepositRequest $request)
    {
        $date = Carbon::parse($request->date)->format('Y-m-d H:i:s');        
        $year = Carbon::parse($request->date)->format('Y');
        $sponsor = Sponsor::find($request->sponsor_id);
        $deposit = $sponsor->deposits()->create([
            'amount'=> $request->amount,
            'year' => $year,
            'created_at'=> $date,
            'updated_at'=> $date,
        ]);
        // create record for sponsor
        if($sponsor->SponsorPlan ){
            if( $sponsor->SponsorPlan->amount_required_annually  <= $sponsor->deposits()->where('year', $deposit->year)->sum('amount')){
                //  $sponsors_who_paid_in_full += [$sponsor->username => $sponsor->deposits->sum('amount')];
                  $sponsor->RecordDeposits()->updateOrCreate(['user_id'=>$sponsor->id, 'year'=> $deposit->year],[
                         'year' => $year,
                         'total' => $sponsor->deposits()->where('year', $year)->sum('amount'),
                         'annual_deposits' => $sponsor->deposits()->where('year', $year)->sum('amount'),
                         'balance' => NULL,
                 ]);
            } else {
                    $sponsor->RecordDeposits()->updateOrCreate(['user_id'=>$sponsor->id, 'year'=> $deposit->year],[
                       'year' => $year,
                       'total' => NULL,
                       'annual_deposits' => $sponsor->deposits()->where('year', $year)->sum('amount'),
                       'balance' => ($sponsor->SponsorPlan) ? $sponsor->SponsorPlan->amount_required_annually - $sponsor->deposits()->where('year', $deposit->year)->sum('amount'): NULL - $sponsor->deposits()->where('year', $deposit->year)->sum('amount'),
                     ]);           
                
         }
        }
        // end of record function
        $users = User::where('user_type', '!=', 'admin')->get();
        if($deposit){

            Notification::send( $users, new DepositNotification($deposit));
        }
        return redirect()->back()->with('status', 'Money deposited successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
