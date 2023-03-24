<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\PrescriptionTemp;

class AdminAppointmentTempTodayController extends Controller
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
        $validator = Validator::make($request->all(), [
            'medicine'=> 'required',
            'quantity'=>'required',
            'times'=>'required',
            'appointment_id'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
                $prescription_temp = new PrescriptionTemp;
                $prescription_temp->medicine = $request->input('medicine');
                $prescription_temp->quantity = $request->input('quantity');
                $prescription_temp->times = $request->input('times');
                $prescription_temp->appointment_id = $request->input('appointment_id');
                $prescription_temp->save();
                return response()->json([
                    'status'=>200,
                    'message'=>'Added medicine successfully.'
                ]);
        }
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
        $prescriptionTemp = PrescriptionTemp::findorFail($id);
        // $item_list =  ItemList::where('item_list_id', $id)->firstOrFail();


        if($prescriptionTemp)
        {
            $prescriptionTemp->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Subject Deleted Successfully.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No List Found.'
            ]);
        }
    }

    public function getPrescription($appointment_id)
    {
        // $data = cart_list::where('customer_id',$customer_id)->get();
        // Log::info(json_encode($data));
        $data = DB::table('prescription_temps')
            ->select('*',)
            ->where('appointment_id',$appointment_id)
            ->get();
        return response()->json(['data' => $data]);

        // $data = cart_list::all();
        // return response()->json([
        //     'data'=>$data,
        // ]);
    }
}
