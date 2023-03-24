<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\DB;

class AdminMaterialController extends Controller
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
        $materials  = DB::table('materials')
        ->select('materials.title as m_id',
                 'materials.title as m_title',
                 'materials.url as m_url',
                 'materials.description as m_desc',
                 'materials.remarks as m_rem',
                 'materials.status as m_status',
                 'materials.no_of_enrolled as m_enrolled',
                 'materials.price as m_price',
                 'materials.image as m_img',
                 'materials.rating as m_rating',
                 'materials.price as m_price',
                 'users.name as u_name',
                 'categories.description as c_description',
                 'categories.category_code as c_code')
        ->join('users','users.id','=','materials.user_id')
        ->join('categories','categories.id','=','materials.category_id')
        ->orderBy('m_id', 'desc')
        ->paginate(10);
        $categories = Category::all();
        return view('pages\admin\material\index',compact("materials","categories"));
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

        


        $material = new Material;
        $material->title = $request->input('title');
        $material->category_id = $request->input('sel_category');
        $material->url = $request->input('url');
        $material->price = $request->input('price');
        $material->description = $request->input('description');
        $material->remarks = $request->input('remarks');
        $material->user_id = auth()->user()->id;
        $material->status = 0;


        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $origname = $file->getClientOriginalName();
            $user = auth()->user()->name.'-'.auth()->user()->id;
            $filename = $user.'material-image'.time().'.'.$extension;
            $file->move('uploads/material/', $filename);
            $material->image = $filename;
        }

        $material->save();

        return redirect('/admin/material')->with('success','Material Information Successfully Added!');
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
