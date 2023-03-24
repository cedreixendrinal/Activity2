<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Transaction;
use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\DB;
use Redirect,Response;

class ResidentTransactionController extends Controller
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
        $transactions  = DB::table('transactions')
        ->select('transactions.id as t_id',
                 'transactions.payment_type as t_payment_type',
                 'transactions.order_type as t_order_type',
                 'transactions.delivery_date as t_delivery_date',
                 'transactions.total_amount as t_total_amount',
                 'transactions.status as t_status',
                 'users.name as u_name')
        ->join('users','users.id','=','transactions.user_id')
        ->where('transactions.order_type','=','0')
        ->orderBy('t_id', 'desc')
        ->paginate(10);

       
        return view('pages\resident\transaction',compact("transactions"));
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
        $transaction = new Transaction;
        $transaction->transaction_no = $request->input('transaction_no');
        $transaction->price = $request->input('price');
        $transaction->material_id = $request->input('material_id');
        $transaction->user_id = $request->input('user_id');

        if($request->hasfile('receipt')){
            $file1 = $request->file('receipt');
            $extension1 = $file1->getClientOriginalExtension();
            $origname = $file1->getClientOriginalName();
            $user1 = auth()->user()->name.'-'.auth()->user()->id;
            $filename1 = $user1.'transaction-receipt'.time().'.'.$extension1;
            $file1->move('uploads/transaction/', $filename1);
            $transaction->receipt = $filename1;
        }
       
        $transaction->save();

        return redirect('/admin/transaction/material/')->with('success','Event Information Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materials  = DB::table('materials')
        ->select('materials.id as m_id',
                 'materials.title as m_title',
                 'materials.user_id as m_author',
                 'materials.url as m_url',
                 'materials.description as m_desc',
                 'materials.remarks as m_rem',
                 'materials.status as m_status',
                 'materials.no_of_enrolled as m_enrolled',
                 'materials.price as m_price',
                 'materials.image as m_img',
                 'materials.rating as m_rating',
                 'users.name as u_name',
                 'categories.description as c_desc',
                 'categories.category_code as c_code')
        ->join('users','users.id','=','materials.user_id')
        ->join('categories','categories.id','=','materials.category_id')
        ->where('materials.id','=',$id)
        ->orderBy('m_id', 'desc')
        ->paginate(10);

       
        return view('pages\client\material\single_page',compact("materials"));
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
        $transaction  = Transaction::where($where)->first();

        return Response::json($transaction);
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
        $transaction = Transaction::findOrFail($id);
        $transaction->status = $request->input('status');;
        $transaction->save();
        return redirect('/admin/transaction/material')->with('success','Transaction successfully approved!');

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
    public function search(Request $request, )
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
