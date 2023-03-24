<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\DB;
use Redirect,Response;

class AdminMenuItemController extends Controller
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

        $menu_items  = DB::table('menu_items')
        ->select('menu_items.id as m_id',
                 'menu_items.name as m_name',
                 'menu_items.description as m_description',
                 'menu_items.image as m_image',
                 'menu_items.price as m_price',
                 'categories.name as c_name')
        ->join('categories','categories.id','=','menu_items.category_id')
        ->orderBy('m_id', 'desc')
        ->paginate(10);
        $categories = Category::all();
        return view('pages\admin\menu_item\index',compact("menu_items","categories"));
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
        $menu_item = new MenuItem;
        $menu_item->category_id = $request->input('sel_category_id');
        $menu_item->name = $request->input('name');
        $menu_item->description = $request->input('description');
        $menu_item->price = $request->input('price');

        if($request->hasfile('image')){
            $file1 = $request->file('image');
            $extension1 = $file1->getClientOriginalExtension();
            $origname = $file1->getClientOriginalName();
            $user1 = auth()->user()->name.'-'.auth()->user()->id;
            $filename1 = $user1.'menu-item-image'.time().'.'.$extension1;
            $file1->move('uploads/menu_item/', $filename1);
            $menu_item->image = $filename1;
        }
        $menu_item->save();

        return redirect('/admin/menu-item')->with('success','Menu item successfully added!');
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
        $table  = MenuItem::where($where)->first();

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
        $menu_item = MenuItem::findOrFail($id);
        $menu_item->category_id = $request->input('sel_category_id2');
        $menu_item->name = $request->input('name2');
        $menu_item->description = $request->input('description2');
        $menu_item->price = $request->input('price2');

        if($request->hasfile('image2')){
            $file1 = $request->file('image2');
            $extension1 = $file1->getClientOriginalExtension();
            $origname = $file1->getClientOriginalName();
            $user1 = auth()->user()->name.'-'.auth()->user()->id;
            $filename1 = $user1.'menu-item-image'.time().'.'.$extension1;
            $file1->move('uploads/menu_item/', $filename1);
            $menu_item->image = $filename1;
        }
        
        $menu_item->save();
       
        return redirect('/admin/menu-item')->with('success','Menu item successfully updated!');
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
