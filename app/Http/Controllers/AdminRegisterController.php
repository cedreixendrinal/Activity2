<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kalapati;
use App\Models\Participant;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\DB;
use Redirect,Response;

class AdminRegisterController extends Controller
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

        $participants = DB::table('participants')
        ->select('kalapatis.id as p_id',
        'participants.serial_code as p_serial_code',
        'participants.status as p_status',
        'participants.speed as p_speed',
        'participants.distance as p_distance',
        'participants.position as p_position',
        'races.description as r_description',
        'races.created_at as r_create_at',
        'users.name as u_name',
        'kalapatis.ring_no as k_ring_no')
        ->join('races','races.id','=','participants.race_id')
        ->join('kalapatis','kalapatis.id','=','participants.kalapati_id')
        ->join('users','users.id','=','kalapatis.user_id')
        ->where('users.club_id','=',auth()->user()->club_id)
        ->get();

        $races = DB::table('races')
        ->select('*')
        ->where('races.club_id','=',auth()->user()->club_id)
        ->get();

        $kalapatis = DB::table('kalapatis')
        ->select('kalapatis.id as k_id',
        'kalapatis.ring_no as k_ring_no',
        'users.name as u_name')
        ->join('users','users.id','=','kalapatis.user_id')
        ->where('users.club_id','=',auth()->user()->club_id)
        ->get();

        $status = DB::table('races')
        ->select('status')
        ->where('races.club_id',auth()->user()->club_id)
        ->where('id', \DB::raw("(select max(id) from races)"))
        ->paginate(10);

        return view('pages\admin\register\index',compact("participants","kalapatis","races","status"));
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


        $user_id = DB::select(DB::raw("
        SELECT user_id
        FROM kalapatis
        WHERE kalapatis.id = '".$request->input('pigeon_id')."'"
        ));
        $owner_id = $user_id[0]->user_id;

        $participant = new Participant;
        $participant->kalapati_id = $request->input('pigeon_id');
        $participant->serial_code = $request->input('serial_code');
        $participant->distance = $request->input('distance');
        $participant->race_id = $request->input('race_id');
        $participant->status = 0;
        $participant->speed = 0;
        $participant->position = 0;
        $participant->points = 0;
        $participant->pigeon_count = 0;
        $participant->pigeon_placed = 0;
        $participant->owner_id = $owner_id;
        $participant->save();


        $count = DB::select(DB::raw("
            SELECT COUNT(participants.id) as last_count
            FROM participants
            JOIN kalapatis
            ON kalapatis.id = participants.kalapati_id
            WHERE race_id = '".$request->input('race_id')."'
            AND kalapatis.user_id = '".$owner_id."'"
        ));

        if ($count[0]->last_count) {
            $last_count = $count[0]->last_count;
            DB::select(DB::raw("
                UPDATE participants
                SET pigeon_count = '".$last_count."'
                WHERE owner_id = '".$owner_id."'
            "));

        }else{
            $last_count = 1;
            DB::select(DB::raw("
            UPDATE participants
            SET pigeon_count = '".$last_count."'
            WHERE owner_id = '".$owner_id."'
        "));
        }

        return redirect('/admin/register')->with('success','New pigeon successfully resgistered!');
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
        $table  = Participant::where($where)->first();

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

        //$participant = Participant::findOrFail($id);
        $participant =  Participant::where('id', $id)->firstOrFail();
        $participant->kalapati_id = $request->input('kalapati_id2');
        $participant->serial_code = $request->input('serial_code2');
        $participant->distance = $request->input('distance2');
        $participant->race_id = $request->input('race_id2');
        $participant->save();

        return redirect('/admin/register')->with('success','Participant infromation successfully updated!');

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
