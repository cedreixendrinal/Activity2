<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kalapati;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\DB;
use Redirect,Response;

class AdminKalapatiController extends Controller
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
        $kalapatis  = DB::table('kalapatis')
        ->select('kalapatis.id as k_id',
        'kalapatis.ring_no as k_ring_no',
        'users.name as u_name')
        ->join('users','users.id','=','kalapatis.user_id')
        ->where('users.club_id',auth()->user()->club_id)
        ->paginate(10);
        $users = DB::table('users')
        ->select('*')
        ->where('users.role','=','0')
        ->get();

        return view('pages\admin\kalapati\index',compact("kalapatis","users"));
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
