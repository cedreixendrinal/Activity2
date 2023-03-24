<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kalapati;
use App\Models\Club;
use App\Models\Race;
use Validator;
use Illuminate\Support\Facades\DB;
use Redirect,Response;

class AdminRaceController extends Controller
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
        $races  = DB::table('races')
        ->select('races.id as r_id',
        'races.date_start as r_date_start',
        'races.date_end as r_date_end',
        'races.time_start as r_time_start',
        'races.time_end as r_time_end',
        'races.address as r_address',
        'races.description as r_description',
        'races.club_id as r_club_id',
        'races.description as r_description',
        'races.min_speed as r_speed',
        'races.status as r_status',
        'races.club_id as r_club_id',
        'races.additional_points as r_additional_points')
        ->where('races.club_id',auth()->user()->club_id)
        ->paginate(10);

        $clubs = Club::All();

        $status = DB::table('races')
        ->select('status')
        ->where('races.club_id',auth()->user()->club_id)
        ->where('id', \DB::raw("(select max(id) from races)"))
        ->get();

        //dd($status );

        return view('pages\admin\race\index',compact("races","clubs","status"));
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
        $race = new Race;
        // $race->date_start = $request->input('date_start');
        // $race->date_end = $request->input('date_end');
        // $race->time_start = $request->input('time_start');
        // $race->time_end = $request->input('time_end');
        $race->address = $request->input('address');
        $race->club_id = auth()->user()->club_id;
        $race->description = $request->input('description');
        $race->min_speed = $request->input('speed');
        $race->additional_points = $request->input('additional_points');
        $race->status = 0;
        $race->save();

        return redirect('/admin/race')->with('success','New race successfully added!');
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
        $table  = Race::where($where)->first();

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
        $race = Race::findOrFail($id);

        $race->date_start = $request->input('date_start2');
        $race->date_end = $request->input('date_end2');
        $race->time_start = $request->input('time_start2');
        $race->time_end = $request->input('time_end2');
        $race->address = $request->input('address2');
        $race->club_id = auth()->user()->club_id;
        $race->description = $request->input('description2');
        $race->min_speed = $request->input('speed2');
        $race->additional_points = $request->input('additional_points2');

        $race->save();

        return redirect('/admin/race')->with('success','Race successfully updated!');

    }
    public function start(Request $request, $id)
    {
        $race = Race::findOrFail($id);
        $race->date_start = date("Y-m-d H:i:s");
        $race->time_start = date("H:i:s");
        $race->status = 1;
        $race->save();

        return redirect('/admin/race')->with('success','Race successfully started!');

    }
    public function end(Request $request, $id)
    {
        $race = Race::findOrFail($id);
        $race->date_end = date("Y-m-d H:i:s");
        $race->time_end = date("H:i:s");
        $race->status = 2;
        $race->save();

        return redirect('/admin/race')->with('success','Race successfully ended!');

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
