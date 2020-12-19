<?php

namespace App\Http\Controllers\Admin;

use App\Sponsor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AddSponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.createuser');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request['email'] != ''){
            $validationrules = ['required', 'string', 'email', 'max:255', 'unique:users'];
            $regex =  'regex:/^\S*$/u';
        } else {
            $validationrules = '';
            $regex = '';
        }
        if ($request['email'] == '') {
            $email_verified_at = Carbon::now();
        } else {
            $email_verified_at = null;
        }
       $data = $request->validate([
        'username' => ['required', 'string', 'max:255','unique:users','regex:/^\S*$/u'], 
        'email' => [$validationrules, $regex],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
       ]);
       Sponsor::create([
        'username' => $data['username'], 
        'user_type' => 'sponsor',
        'email' => $data['email'],
        'email_verified_at'=> $email_verified_at,
        'password' => Hash::make($data['password']),
       ]);
       return redirect()->action('EditSponsorController@edit');
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
