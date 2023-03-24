<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kalapati;
use App\Models\User;
use App\Models\Race;
use Validator;
use Illuminate\Support\Facades\DB;
use Redirect,Response;

class AdminLogController extends Controller
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
        $current_race  = '';
        $participant_count  = 0;
        $participant_arrived = 0;

        $races  = DB::table('races')
        ->select('*')
        ->join('participants','race_id','=','races.id')
        ->join('kalapatis','kalapatis.id','=','participants.kalapati_id')
        ->join('users','users.id','=','kalapatis.user_id')
        ->where('participants.status','=','1')
        ->where('races.status','=','1')

        ->paginate(10);

        $allRaces= Race::all();
        return view('pages\admin\log\index',compact("races","allRaces","current_race","participant_count","participant_arrived"));
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
        $kalapti = Kalapati::findOrFail($id);
        $kalapti->user_id = $request->input('user_id2');
        $kalapti->ring_no = $request->input('ring_no2');
        $kalapti->save();

        return redirect('/admin/kalapati')->with('success','Kalapati successfully updated!');

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
        $current_race  = '';
        $participant_count  = 0;
        $participant_arrived = 0;

        if (isset($_GET['query'])) {
            $races  = DB::table('races')
            ->select('*')
            ->join('participants','race_id','=','races.id')
            ->join('kalapatis','kalapatis.id','=','participants.kalapati_id')
            ->join('users','users.id','=','kalapatis.user_id')
            ->where('race_id','=', $request->input('race_id'))
            // ->where('participants.status','=','1')
            // ->where('races.status','=','2')
            ->paginate(10);

            $current_race  = DB::table('races')
            ->select('*')
            ->where('races.id','=', $request->input('race_id'))
            ->first();

            $participants = DB::table('races')
            ->select('*')
            ->join('participants','participants.race_id','=','races.id')
            ->where('races.id','=', $request->input('race_id'))
            ->get();
            $participant_count = $participants->count();

            $participants2  = DB::table('participants')
            ->where('participants.status','=','1')
            ->where('participants.race_id','=',$request->input('race_id'))
            ->get();
            $participant_arrived = $participants2->count();


            $allRaces= Race::all();


            return view('pages\admin\log\index',compact("races","allRaces","current_race","participant_count","participant_arrived"));
        }else{
            echo "Error 404|Page Not Found!";
        }



        $races  = DB::table('races')
        ->select('*')
        ->join('participants','race_id','=','races.id')
        ->join('kalapatis','kalapatis.id','=','participants.kalapati_id')
        ->join('users','users.id','=','kalapatis.user_id')
        ->where('participants.status','=','1')
        ->where('races.status','=','1')
        ->paginate(10);

        $allRaces= Race::all();

        return view('pages\admin\log\index',compact("races","allRaces","current_race","participant_count","participant_arrived"));

    }
    public function result(Request $request)
    {
        $data = DB::table('participants')
        ->select('*')
        ->join('kalapatis','kalapatis.id','=','participants.kalapati_id')
        ->join('users','users.id','=','kalapatis.user_id')
        ->join('races','races.id','=','participants.race_id')
        ->where('participants.status','=','1')
        ->where('races.status','=','1')
        ->orderBy('speed', 'ASC')
        ->get();
    return response()->json(['data' => $data]);
    }
}
