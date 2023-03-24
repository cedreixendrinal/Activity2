<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kalapati;
use App\Models\Participant;
use App\Models\User;
use Validator;
use Carbon;
use Illuminate\Support\Facades\DB;
use Redirect,Response;

class MemberClockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $races  = DB::table('participants')
        ->select('*')
        ->join('races','races.id','=','participants.race_id')

        ->paginate(10);

        return view('pages\resident\clock\index',compact("races"));
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
        $kalapti = new Kalapati;
        $kalapti->user_id = $request->input('user_id');
        $kalapti->ring_no = $request->input('ring_no');
        $kalapti->save();

        return redirect('/admin/kalapati')->with('success','New kalapati successfully assign!');
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
        $where = array('id' => $id);
        $table  = Kalapati::where($where)->first();

        return Response::json($table);
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

        $day = 0;
        $dayToHour =0;
        $HourToMin = 0;
        // hour convert to min
        $hour = 0;
        $HourToMin2 = 0;
        $min = 0;
        // sec convert to min
        $sec = 0;
        $SecToMin = 0;
        $totalMin = 0;
        $speed = 0;

        $validator = Validator::make($request->all(), [
            'serial_code'=> 'required',
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
            $participant = Participant::find($request->input('serial_code'));

            if($participant)
            {

                      $id = $participant->race_id;
                    // $kalapati_id = $participant->kalapati_id;
                    // // dd($participant);
                    // // exit;

                    // $owner = DB::select(DB::raw("
                    //     SELECT *
                    //     FROM users
                    //     JOIN kalapatis
                    //     ON kalapatis.user_id = users.id
                    //     WHERE
                    //     kalapatis.id = '".$kalapati_id ."'
                    //     AND
                    //     users.id = '".auth()->user()->id."'"
                    // ));

                if ($participant->owner_id == auth()->user()->id){

                }else{
                    return response()->json([
                        'status'=>404,
                        'message'=>'Serial code incorrect.'
                    ]);

                }



                if(!$participant->time_clock)
                {

                    $results = DB::select(DB::raw("
                        SELECT date_start,min_speed,additional_points
                        FROM races
                        WHERE races.id = '".$id."'"
                    ));

                    $last_race = DB::select(DB::raw("
                    SELECT MAX(race_id) as race_id
                    FROM participants
                    WHERE owner_id = '".auth()->user()->id."
                    '
                      "));



                    $max_count = DB::select(DB::raw("
                        SELECT MAX(pigeon_placed) as pigeon_placed
                        FROM participants
                        WHERE owner_id = '".auth()->user()->id."'
                        AND race_id = '".$last_race[0]->race_id."'
                    "));

                    $kalapatis = DB::select(DB::raw("
                    SELECT kalapatis.ring_no as k_ring_no
                    FROM kalapatis
                    JOIN participants ON participants.kalapati_id = kalapatis.id
                    WHERE participants.id = '".$participant->id."'
                     "));


                    $race = DB::select(DB::raw("
                    SELECT races.date_start as r_date_start
                    FROM participants
                    JOIN races ON races.id = participants.race_id
                    WHERE participants.serial_code = '".$request->input('serial_code')."'
                     "));


                    $dateStart = \Carbon\Carbon::parse($results[0]->date_start);
                    $dateEnd = \Carbon\Carbon::now();
                    $interval = $dateStart->diff($dateEnd);
                    // day convert to min
                    $day = $interval->format('%a');
                    $dayToHour = $day * 24;
                    $HourToMin = $dayToHour * 60;
                    // hour convert to min
                    $hour = $interval->format('%h');
                    $HourToMin2 = $hour * 60;
                    $min = $interval->format('%i');
                    // sec convert to min
                    $sec = $interval->format('%s');
                    $SecToMin = $sec/60;
                    $totalMin = $HourToMin + $HourToMin2 +  $min + $SecToMin;
                    $speed = ($participant->distance / $totalMin) * 1000;

                    if ($results[0]->min_speed <= $speed ) {

                        $participant->points = $results[0]->additional_points ;
                    }


                    $participant->pigeon_placed = $max_count[0]->pigeon_placed + 1;

                    $participant->flight = $totalMin / 60;
                    $participant->arrival = $dateEnd;
                    $participant->speed = $speed;
                    $participant->time_clock = Carbon\Carbon::now();
                    $participant->status = 1;
                     $participant->save();
                    $bc = ($max_count[0]->pigeon_placed) + 1 .'/'. $participant->pigeon_count;
                    $bc2 = (($max_count[0]->pigeon_placed)+ 1) / $participant->pigeon_count;
                    $arrival = date_format($dateEnd,"M/d/Y h:i:s A");
                    $data = [
                        'LD' => $participant->distance,
                        'BC' =>  $bc ,
                        'BN' => $kalapatis[0]->k_ring_no,
                        'Arrival' => $arrival,
                        'Speed' => number_format((float)$speed, 3, '.', ''),
                        'points' => $results[0]->additional_points,
                        'percentage' => $bc2 * 100,
                        'date_start' => $race[0]->r_date_start
                    ];

                    return response()->json([
                        'status'=>200,
                        'message'=>'Serial code submitted successfully!',
                        'data'=> $data
                    ]);
                }else{
                    return response()->json([
                        'status'=>404,
                        'message'=>'Serial code already submitted'
                    ]);
                }
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Serial code incorrect.'
                ]);
            }

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bank::destroy($id);
        return redirect('/bank')->with('success','Successfully Deleted!');

    }
    public function search(Request $request)
    {
        if (isset($_GET['query'])) {
            $search_text = $_GET['query'];
            $banks = DB::table('banks')
            ->orderBy('id', 'desc')
            ->where('bank_name','LIKE','%'.$search_text.'%')
            ->paginate(10)
            ->withQueryString();
            return view('pages\admin\bank\index',compact("banks"));
        }else{
            echo "Error 404|Page Not Found!";
        }

    }
}
