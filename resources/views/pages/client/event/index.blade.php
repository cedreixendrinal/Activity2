@extends('layouts.layout')

@section('title', 'Timeline')

@section('content')

    @include('layouts.page-header', ['page' => [
    'title' => 'Timeline',
    'description' => 'Access the latest news and updates.',
    'breadcrumbs' => [
    [
    'title' => 'About',
    'href' => '#',
    ], [
    'title' => 'Timeline',
    'href' => '#',
    ],
    ]
    ]]);
    <div style="background-color: #e7eaed">

        <div class="container ">
            <div class="row">
                {{-- <div class=" container mt-4 mb-4 col-sm-2"> --}}
                <div class="col-sm-3 p-3">
                    <div class="d-flex flex-column align-items-stretch flex-shrink-0 rounded" style="color:#055160ba;">

                        <div class="p-4">

                            <div class="border-bottom pb-2">
                                <input class="form-control pb-2" list="datalistOptions" id="exampleDataList"
                                    placeholder="Search...">
                                <datalist id="datalistOptions">
                                    <option value="Business">
                                    <option value="IT & Software">
                                    <option value="Finance & Accounting">
                                    <option value="Design & Marketing">
                                    <option value="Intro">
                                </datalist>
                            </div>


                            <div class="mb-3 form-check mt-2">
                                <div class="border-bottom">
                                    <h5 class='pt-2 pl-0'>Sort By</h5>

                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="Business">Latest Upload</label>
                                    </div>
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Categories</label>
                                    </div>
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Author</label>
                                    </div>
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Schedule</label>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-3 form-check">
                                <div class="border-bottom">
                                    <h5 class='pl-0'>Others</h5>
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">My courses</label>
                                    </div>
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Events</label>
                                    </div>
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">News</label>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class=" mt-4 mb-4 col-sm-8">
                    @foreach ($events as $event)
                        <div class="card mb-3" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="uploads/event/{{ $event-> e_image_1 }}" class="card-img-top" alt="...">
                                    </div>
                                    <div class="col-sm-8">
                                        <h5 class="card-title">{{ $event-> e_title }}</h5>
                                        <small class="text-muted "> {{ $event-> e_date_from }} -
                                            {{ $event -> e_date_to }}</small>
                                    </div>
                                    <div class="col-sm-4" style="text-align:right">
                             
                                    </div>
                                </div>
                                <div class="border-bottom"> </div>
                                <p class="card-text pt-3"> {{ $event ->e_desc }} <small class="text-muted"> <a
                                                    href="/event/{{ $event ->e_id }}"> Read more...</a></small>
                                </p>
                            </div>
                        </div>
                    @endforeach
                    {{$events->links()}}
                </div>
                
            
                <div class=" mt-4 mb-4 col-sm-2"> </div>

            </div>
        @endsection
