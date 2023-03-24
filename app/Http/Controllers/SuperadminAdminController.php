<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Club;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Redirect,Response;


class SuperadminAdminController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users  = DB::table('users')
            ->select('users.id as u_id',
            'users.name as u_name',
            'users.loft_name as u_loft_name',
            'users.email as u_email',
            'users.primary_number as u_primary_number',
            'users.address as u_address',
            'clubs.name as c_name')
            ->join('clubs','clubs.id','=','users.club_id')
            ->where('users.role','=',1)
            ->get();
        $clubs = Club::All();
        return view('pages\superadmin\user\index',compact("users","clubs"));
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

            $user = new User;
            $user->name = $request->input('name');
            $user->password = Hash::make($request->input('password'));
            $user->email = $request->input('email');
            $user->primary_number = $request->input('primary_number');
            $user->address = $request->input('address');
            $user->club_id = $request->input('club_id');
            $user->role = 1;


            // if($request->hasfile('gov_id')){
            //     $file2 = $request->file('gov_id');
            //     $extension2 = $file2->getClientOriginalExtension();
            //     $origname = $file2->getClientOriginalName();
            //     $user2 = auth()->user()->name.'-'.auth()->user()->id;
            //     $filename2 = $user2.'merchant-gov_id'.time().'.'.$extension2;
            //     $file2->move('uploads/merchant/', $filename2);
            //     $merchant->gov_id = $filename2;
            // }
            $user->save();

            return redirect('/superadmin/admin')->with('success','New user successfully added!');


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
        $user  = User::where($where)->first();

        return Response::json($user);
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



            $user = User::findOrFail($id);
            $user->name = $request->input('name2');
            $user->email = $request->input('email2');
            $user->primary_number = $request->input('primary_number2');
            $user->address = $request->input('address2');
            $user->club_id = $request->input('club_id2');
            if($request->input('password2')){
                $user->password = Hash::make($request->input('password2'));
            }
            $user->save();


        return redirect('/superadmin/admin')->with('success','Admin successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function getCategories(){

        $data =  Category::all();

        return response()->json(['data' => $data]);
    }
}
