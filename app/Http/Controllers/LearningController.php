<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages\client\learning\index', ['courses' => $this->getLearnings()]);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getLearnings()
    {
        $courses = [
            '1' => [
                'title' => 'Investing Success',
                'progressPercentage' => mt_rand(1, 100),
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
                'progressPercentage' => mt_rand(1, 100),
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
                'progressPercentage' => mt_rand(1, 100),
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
                'progressPercentage' => mt_rand(1, 100),
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
                'progressPercentage' => mt_rand(1, 100),
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
                'progressPercentage' => mt_rand(1, 100),
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
                'progressPercentage' => mt_rand(1, 100),
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

        return $courses;

    }
}
