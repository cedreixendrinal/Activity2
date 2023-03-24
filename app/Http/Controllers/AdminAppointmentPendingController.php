<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Appointment;
use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\DB;
use Redirect,Response;

class AdminAppointmentPendingController extends Controller
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
        $appointments  = DB::table('appointments')
        ->select('appointments.id as a_id',
                 'appointments.request_date as a_request_date',
                 'appointments.approved_date as a_approved_date',
                 'appointments.status as a_status',
                 'appointments.reason as a_reason',
                 'appointments.impression as a_impression',
                 'users.name as u_name')
        ->join('users','users.id','=','appointments.user_id')
        ->where('appointments.status','=','0')
        ->paginate(10);

       
        return view('pages\admin\appointment\pending',compact("appointments"));
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
        $appointment  = Appointment::where($where)->first();

        return Response::json($appointment);
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
        $appointment = Appointment::findOrFail($id);
        if($request->input('approved_date2')){
           $appointment->approved_date = $request->input('approved_date2');
        }
        if($request->input('remarks2')){
            $appointment->remarks = $request->input('remarks2');
        }
        $appointment->status = $request->input('status2');
        $appointment->save();
        return redirect('/admin/appointment/pending')->with('success','Appoinment successfully approved!');

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
