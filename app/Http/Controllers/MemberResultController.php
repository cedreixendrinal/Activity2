<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kalapati;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\DB;
use Redirect,Response;

class MemberResultController extends Controller
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
        ->select('*')
        ->where('status','=',1)
        ->where('id', \DB::raw("(select max(id) from races)"))
        ->paginate(10);

        return view('pages\resident\result\index',compact("races"));
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
    public function result(Request $request)
    {
        $data = DB::table('participants')
        ->select('*')
        ->join('kalapatis','kalapatis.id','=','participants.kalapati_id')
        ->join('users','users.id','=','kalapatis.user_id')
        ->join('races','races.id','=','participants.race_id')
        ->where('participants.status','=','1')
        ->where('races.status','=','1')
        ->orderBy('speed', 'DESC')
        ->get();
    return response()->json(['data' => $data]);
    }

    public function race(Request $request)
    {
        $data = DB::table('races')
        ->select('*')
        ->where('races.status','=','1')
        ->orderBy('races.id', 'desc')
        ->first();

        $last_id = DB::table('races')
        ->select('*')
        ->where('races.status','=','1')
        ->orderBy('races.id', 'desc')
        ->first();
        $last_id2 = $last_id->id;

        $participants  = DB::table('participants')
        ->where('participants.status','=','1')
        ->where('participants.race_id','=',$last_id2)
        ->get();
        $participant_arrived = $participants->count();

        $participants  = DB::table('participants')
        ->where('participants.race_id','=',$last_id2)
        ->get();
        $participant_count = $participants->count();

    return response()->json(['data' => $data,'participant_count' => $participant_count,'participant_arrived' => $participant_arrived]);
    }

    public function pigeon(Request $request)
    {
        $last_id = DB::table('races')
        ->select('*')
        ->where('races.status','=','1')
        ->orderBy('races.id', 'desc')
        ->first();
        $last_id2 = $last_id->id;

        $data = DB::table('participants')
        ->join('kalapatis','kalapatis.id','=','participants.kalapati_id',)
        ->select('*')
        ->where('participants.race_id','=',$last_id2)
        ->where('participants.owner_id','=',auth()->user()->id)
        ->get();

    return response()->json(['data' => $data]);
    }

    public function forecast(Request $request)
    {
        $data1 = DB::table('races')
        ->select('*')
        ->where('races.status','=','1')
        ->orderBy('races.id', 'desc')
        ->first();
        $last_id2 = $data1->id;

        $data2 = DB::table('participants')
        ->join('kalapatis','kalapatis.id','=','participants.kalapati_id',)
        ->select('*')
        ->where('participants.race_id','=',$last_id2)
        ->where('participants.owner_id','=',auth()->user()->id)
        ->first();

        $mpm = (($data2->distance /1400) * 1000);
        $mpmConvert = number_format((float)$mpm, 0, '.', '');

        $mpm2 = (($data2->distance /1300) * 1000);
        // $mpmConvert2 = number_format((float)$mpm2, 0, '.', '');
        $mpmConvert2 = number_format(floor($mpm2));

        $mpm3 = (($data2->distance /1200) * 1000);
        // $mpmConvert3 = number_format((float)$mpm3, 0, '.', '');
        $mpmConvert3 = number_format(floor($mpm3));

        $mpm4 = (($data2->distance /1100) * 1000);
        // $mpmConvert4 = number_format((float)$mpm4, 0, '.', '');
        $mpmConvert4 = number_format(floor($mpm4));

        $mpm5 = (($data2->distance /1000) * 1000);
        // $mpmConvert5 = number_format((float)$mpm5, 0, '.', '');
        $mpmConvert5 = number_format(floor($mpm5));

        $mpm6 = (($data2->distance /900) * 1000);
        // $mpmConvert6 = number_format((float)$mpm6, 0, '.', '');
        $mpmConvert6 = number_format(floor($mpm6));

        $mpm7 = (($data2->distance /800) * 1000);
        // $mpmConvert7 = number_format((float)$mpm7, 0, '.', '');
        $mpmConvert7 = number_format(floor($mpm7));

        $mpm8 = (($data2->distance /700) * 1000);

        $mpmConvert8 = number_format(floor($mpm8));


        $time = new \DateTime($data1->date_start);
        $time2 = new \DateTime($data1->date_start);
        $time3 = new \DateTime($data1->date_start);
        $time4 = new \DateTime($data1->date_start);
        $time5 = new \DateTime($data1->date_start);
        $time6 = new \DateTime($data1->date_start);
        $time7 = new \DateTime($data1->date_start);
        $time8 = new \DateTime($data1->date_start);

        $time->add(new \DateInterval('PT' . $mpmConvert . 'M'));
        $fourteen = $time->format('H:i:s');

        $time2->add(new \DateInterval('PT' . $mpmConvert2 . 'M'));
        $thirteen = $time2->format('H:i:s');

        $time3->add(new \DateInterval('PT' . $mpmConvert3 . 'M'));
        $twelve = $time3->format('H:i:s');


        $time4->add(new \DateInterval('PT' . $mpmConvert4 . 'M'));
        $eleven = $time4->format('H:i:s');


        $time5->add(new \DateInterval('PT' . $mpmConvert5 . 'M'));
        $ten = $time5->format('H:i:s');

        $time6->add(new \DateInterval('PT' . $mpmConvert6 . 'M'));
        $nine = $time6->format('H:i:s');

        $time7->add(new \DateInterval('PT' . $mpmConvert7 . 'M'));
        $eight = $time7->format('H:i:s');

        $time8->add(new \DateInterval('PT' . $mpmConvert8 . 'M'));
        $seven = $time8->format('H:i:s');



        $fourteen1 = $fourteen;
        $thirteen1 = $thirteen;
        $twelve1 = $twelve;
        $eleven1 = $eleven;
        $ten1 = $ten;
        $nine1 = $nine;
        $eight1 = $eight;
        $seven1 = $seven;



        $data = [
            'data1' => $data1,
            'data2' => $data2,
            'fourteen' => $fourteen1,
            'thirteen' => $thirteen1,
            'twelve' => $twelve1,
            'eleven' => $eleven1,
            'ten' => $ten1,
            'nine' => $nine1,
            'eight' => $eight1,
            'fourteen' => $fourteen1,
            'seven' => $seven1,

        ];

    return response()->json(['data' => $data]);
    }
}
