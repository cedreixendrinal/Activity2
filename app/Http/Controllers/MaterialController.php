<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Transaction;
use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
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
        ->select('materials.id as m_id',
                 'materials.title as m_title',
                 'materials.url as m_url',
                 'materials.description as m_desc',
                 'materials.remarks as m_rem',
                 'materials.status as m_status',
                 'materials.no_of_enrolled as m_enrolled',
                 'materials.price as m_price',
                 'materials.image as m_img',
                 'materials.rating as m_rating',
                 'users.name as u_name',
                 'categories.description as c_desc',)
        ->join('users','users.id','=','materials.user_id')
        ->join('categories','categories.id','=','materials.category_id')
        ->orderBy('m_id', 'desc')
        ->paginate(6);

       
        return view('pages\client\material\index',compact("materials"));
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
        $transaction->title = $request->input('title');
        $transaction->category = $request->input('sel_category');
        $transaction->date_from = $request->input('date_from');
        $transaction->date_to = $request->input('date_to');
        $transaction->description = $request->input('description');
        $transaction->remarks = $request->input('remarks');
        $transaction->status = 0;

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
        $user_session_id = auth()->user()->id;
        $materials  = DB::table('materials')
        ->select('materials.id as m_id',
                 'materials.user_id as m_user_id',
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
                 'categories.description as c_desc',
                 'categories.category_code as c_code',
                 'transactions.id as t_id',
                 'transactions.status as t_status')
        ->join('categories','categories.id','=','materials.category_id')
        ->leftJoin('transactions', function($join) use ($user_session_id) {
            $join->on('transactions.material_id', '=', 'materials.id');
            $join->on(DB::raw('transactions.user_id'), DB::raw('='),DB::raw("'".$user_session_id."'"));

        }) 
        ->where('materials.id','=',$id)
        ->paginate(10);

       
        return view('pages\client\material\single_page',compact("materials"));
        
        // ->leftJoin('transactions','transactions.material_id','=','materials.id')
        // ->leftJoin('transactions', function($join){
        //     $join->on('transactions.material_id', '=', 'materials.id');
        // }) 
        // ->join('users','users.id','=','transactions.user_id')
        // ->where('transactions.user_id','=', auth()->user()->id)
        // ,
        //          'transactions.id as t_id',
        //          'users.id as u_name'
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

    private function getMockEvents()
    {
        $events = [
            '1' => [
                'title' => 'Basic Networking Training',
                'schedule' => [
                    'from' => 'June 10, 2022',
                    'to' => 'July 10, 2022',
                    'days' => 30,
                ],
                'description' => 'Learn the fundamentals of Networking from the different Area Networks, IP Addressing, Subnetting, setting up peer-to-peer networking, networking multiple PCs using Switch/Hub, Network Sharing, Setting-up Network Printer, Sharing 3G/4G Internet, Configuring Wired Router & Wireless Router, Wireless Access Point, CAT5e /CAT6 Cabling, User Accounts, etc.',
                'img' => '/images/CLSU/Events/Picture1.png',
                'created_by' => 'Steve J.',
                'learn' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'requirements' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'feedback' => 'Add Feedback',
            ],
            '2' => [
                'title' => 'Intermediate - Networking Training',
                'schedule' => [
                    'from' => 'August 10, 2022',
                    'to' => 'September 10, 2022',
                    'days' => 32,
                ],
                'description' => 'Intermediate - Learn the fundamentals of Networking from the different Area Networks, IP Addressing, Subnetting, setting up peer-to-peer networking, networking multiple PCs using Switch/Hub, Network Sharing, Setting-up Network Printer, Sharing 3G/4G Internet, Configuring Wired Router & Wireless Router, Wireless Access Point, CAT5e /CAT6 Cabling, User Accounts, etc.',
                'img' => '/images/CLSU/Events/Picture1.png',
                'created_by' => 'Mark Z.',
                'learn' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'requirements' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'feedback' => 'Add Feedback',
            ],
            '3' => [
                'title' => 'Intermediate - Networking Training II',
                'schedule' => [
                    'from' => 'October 10, 2022',
                    'to' => 'December 10, 2022',
                    'days' => 33,
                ],
                'description' => 'Intermediate - Learn the fundamentals of Networking from the different Area Networks, IP Addressing, Subnetting, setting up peer-to-peer networking, networking multiple PCs using Switch/Hub, Network Sharing, Setting-up Network Printer, Sharing 3G/4G Internet, Configuring Wired Router & Wireless Router, Wireless Access Point, CAT5e /CAT6 Cabling, User Accounts, etc.',
                'img' => '/images/CLSU/Events/Picture1.png',
                'created_by' => 'Leni R.',
                'learn' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'requirements' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'feedback' => 'Add Feedback',
            ]
        ];
        return $events;
    }

    private function getMockMaterials()
    {
        $materials = [
            '1' => [
                'title' => 'Investing Success',
                'category' => 'Finance & Accounting',
                'author' => 'Steve',
                'description' => 'This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.',
                'enrolees' => 5,
                'rating' => rand(10,100),
                'learn' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'requirements' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'feedback' => 'Add Feedback',
                'img' => '/images/CLSU/Trainings/raycast-untitled (7).png',
                'schedule' => [
                    'from' => '07/10/2022',
                    'to' => '08/10/2022',

                ]
            ],
            '2' => [
                'title' => 'Security',
                'category' => 'IT & Software',
                'author' => 'Jobs',
                'description' => 'This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.',
                'enrolees' => 3,
                'rating' => rand(10,100),
                'learn' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'requirements' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'feedback' => 'Add Feedback',
                'img' => '/images/CLSU/Trainings/raycast-untitled (2).png',
                'schedule' => [
                    'from' => '08/10/2022',
                    'to' => '09/10/2022',
                ]
            ],
            '3' => [
                'title' => 'Marketing',
                'category' => 'Business',
                'author' => 'Steve',
                'description' => 'This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.',
                'enrolees' => 2,
                'rating' => rand(10,100),
                'learn' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'requirements' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'feedback' => 'Add Feedback',
                'img' => '/images/CLSU/Trainings/raycast-untitled.png',
                'schedule' => [
                    'from' => '09/10/2022',
                    'to' => '10/10/2022',
                ]
            ],
            '4' => [
                'title' => 'UI/UX',
                'category' => 'Design',
                'author' => 'Steve',
                'description' => 'This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.',
                'enrolees' => 1,
                'rating' => rand(10,100),
                'learn' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'requirements' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'feedback' => 'Add Feedback',
                'img' => '/images/CLSU/Trainings/raycast-untitled (3).png',
                'schedule' => [
                    'from' => '10/10/2022',
                    'to' => '11/10/2022',
                ]
            ],
            '5' => [
                'title' => 'Web Developing',
                'category' => 'IT & Software',
                'author' => 'Steve',
                'description' => 'This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.',
                'enrolees' => 0,
                'rating' => rand(10,100),
                'learn' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'requirements' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'feedback' => 'Add Feedback',
                'img' => '/images/CLSU/Trainings/raycast-untitled (8).png',
                'schedule' => [
                    'from' => '11/10/2022',
                    'to' => '12/10/2022',
                ]
            ],
            '6' => [
                'title' => 'Testing',
                'category' => 'IT & Software',
                'author' => 'Steve',
                'description' => 'This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.',
                'enrolees' => 1,
                'rating' => rand(10,100),
                'learn' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'requirements' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'feedback' => 'Add Feedback',
                'img' => '/images/CLSU/Trainings/raycast-untitled (5).png',
                'schedule' => [
                    'from' => '07/10/2022',
                    'to' => '08/10/2022',
                ]
            ],
            '7' => [
                'title' => 'UI/UX from Zero to hero',
                'category' => 'IT & Software',
                'author' => 'Steve',
                'description' => 'This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.',
                'enrolees' => 1,
                'rating' => rand(10,100),
                'learn' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'requirements' => 'Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text. Add Text.',
                'feedback' => 'Add Feedback',
                'img' => '/images/CLSU/Trainings/raycast-untitled (6).png',
                'schedule' => [
                    'from' => '08/10/2022',
                    'to' => '09/10/2022',
                ]
            ],
        ];

        return $materials;

    }
}
