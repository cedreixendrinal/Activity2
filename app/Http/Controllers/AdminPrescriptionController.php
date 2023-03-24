<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdminPrescriptionController extends Controller
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

    public function getFinalPrescription($appointment_id)
    {
        // $data = cart_list::where('customer_id',$customer_id)->get();
        // Log::info(json_encode($data));
        $data = DB::table('prescriptions')
            ->select('*')
            ->join('appointments','appointments.id','=','prescriptions.appointment_id')
            ->where('prescriptions.appointment_id',$appointment_id)
            ->get();
        return response()->json(['data' => $data]);

        // $data = cart_list::all();
        // return response()->json([
        //     'data'=>$data,
        // ]);
    }
}
