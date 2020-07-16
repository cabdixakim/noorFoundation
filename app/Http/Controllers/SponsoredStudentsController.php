<?php

namespace App\Http\Controllers;

use App\Sponsor;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsoredStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::check()) {
            # code...
            if(auth()->user()->user_type == 'sponsor'){
                $user = auth()->user()->id;
                $sponsor = Sponsor::findOrFail($user);
                // dd($sponsor->listStudents());

                // $students = $sponsor->listStudents();
                // foreach ($students as $key => $value) {
                //    dd($value->student);
                // }
                $sponsoredstudents = [];
                $payments = $sponsor->payments;
                foreach ($payments as $key => $value) {
                    if (!in_array($value->student, $sponsoredstudents)) {
                        # code...
                        $sponsoredstudents[] = $value->student;
                    }
                }
                
                $allStudents = Student::all();
            
                return view('sponsor.sponsoredstudents',compact('sponsoredstudents','allStudents'));
            }
            return redirect('/');
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