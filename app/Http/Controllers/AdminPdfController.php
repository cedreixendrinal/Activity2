<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;


class AdminPdfController extends Controller
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
    public function generatePDF($id)
    {
        $data = DB::table('prescriptions')
        ->select('*')
        ->join('appointments','appointments.id','=','prescriptions.appointment_id')
        ->where('prescriptions.appointment_id',$id)
        ->get()
        ->toArray();

        $users  = DB::table('users')
        ->select('*')
        ->join('appointments','appointments.user_id','=','users.id')
        ->where('appointments.id','=',$id)
        ->get()
        ->toArray();


      
          
        $customPaper = array(0,0,567.00,330.80);
        $pdf = PDF::loadView('report/prescription', compact('data','users'))->setPaper($customPaper, 'landscape');
    
        return $pdf->download('prescription.pdf');
    }
}
