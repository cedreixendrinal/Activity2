<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Validator;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
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
        // $events  = DB::table('events')->orderBy('id', 'desc')->paginate(10);
        return view('pages\client\main\index');
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
        $event = new Event;
        $event->title = $request->input('title');
        $event->category = $request->input('sel_category');
        $event->date_from = $request->input('date_from');
        $event->date_to = $request->input('date_to');
        $event->description = $request->input('description');
        $event->remarks = $request->input('remarks');

        if($request->hasfile('image_1')){
            $file1 = $request->file('image_1');
            $extension1 = $file1->getClientOriginalExtension();
            $origname = $file1->getClientOriginalName();
            $user1 = auth()->user()->name.'-'.auth()->user()->id;
            $filename1 = $user1.'event-image_1'.time().'.'.$extension1;
            $file1->move('uploads/event/', $filename1);
            $event->image_1 = $filename1;
        }
        // if($request->hasfile('image_2')){
        //     $file2 = $request->file('image_1');
        //     $extension2 = $file2->getClientOriginalExtension();
        //     $origname = $file2->getClientOriginalName();
        //     $user2 = auth()->user()->name.'-'.auth()->user()->id;
        //     $filename2 = $user2.'event-image_1'.time().'.'.$extension2;
        //     $file2->move('uploads/event/', $filename2);
        //     $event->image_2 = $filename2;
        // }
        // if($request->hasfile('image_3')){
        //     $file3 = $request->file('image_3');
        //     $extension3 = $file3->getClientOriginalExtension();
        //     $origname = $file3->getClientOriginalName();
        //     $user3 = auth()->user()->name.'-'.auth()->user()->id;
        //     $filename3 = $user3.'event-image_1'.time().'.'.$extension3;
        //     $file3->move('uploads/event/', $filename3);
        //     $event->image_3 = $filename3;
        // }
        $event->save();

        return redirect('/event')->with('success','Event Information Successfully Added!');
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
        $bank = Bank::findOrFail($id);
        $bank->bank_name = $request->input('bank_name2');
        $bank->description = $request->input('description2');
        $bank->balance = $request->input('balance2');
        $bank->acc_no = $request->input('acc_no2');
        $bank->contact_person = $request->input('contact_person2');
        $bank->phone = $request->input('phone2');
        $bank->url = $request->input('url2');
        $bank->save();
        return redirect('/bank')->with('success','Bank Information Successfully Updated!');

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
