@extends('layouts.layout')

@section('title', 'Courses')

@section('content')

    @include('layouts.my-learnings-header', ['page' => [
    'title' => 'My learning',
    'description' => '7 Materials / 2 Events',
    'breadcrumbs' => [
        [
        'title' => 'My learning',
        'href' => '#',
        ]
    ]
    ]])

    <div class="container">
        <div class="container mt-4 mb-4">
            <div class="row">
                <div class="col-sm-9">

                    <div class="row row-cols-1 row-cols-md-3 g-4">
                   
                            <div class="col">
                                <div class="card h-100" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                                    <img src="{{ asset('uploads/material/jaba-1material-image1663288685.png') }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <small class="text-muted"> Finance & Accounting</small>
                                        <h5 class="card-title mb-0">Investing Success</h5>
                                        <small class="text-muted pt-1"> Created By <span class="text-dark">Steve</span></small>
                                        <div class="border-bottom"></div>
                                        <div class="progress" style="height: 1px;">
                                            <div class="progress-bar" role="progressbar" style="" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="align-right">
                                        <small class="text-muted pt-1">6% Complete </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card h-100" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                                    <img src="{{ asset('uploads/material/jaba-1material-image1663288816.png') }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <small class="text-muted"> IT & Software</small>
                                        <h5 class="card-title mb-0">Security</h5>
                                        <small class="text-muted pt-1"> Created By <span class="text-dark">Jobs</span></small>
                                        <div class="border-bottom"></div>
                                        <div class="progress" style="height: 1px;">
                                            <div class="progress-bar" role="progressbar" style="" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="align-right">
                                        <small class="text-muted pt-1">75% Complete</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card h-100" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                                    <img src="{{ asset('uploads/material/jaba-1material-image1663288902.png') }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <small class="text-muted">Business</small>
                                        <h5 class="card-title mb-0">Marketing</h5>
                                        <small class="text-muted pt-1"> Created By <span class="text-dark">Steve</span></small>
                                        <div class="border-bottom"></div>
                                        <div class="progress" style="height: 1px;">
                                            <div class="progress-bar" role="progressbar" style="" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="align-right">
                                        <small class="text-muted pt-1">50% Complete </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          

                            <div class="col">
                                <div class="card h-100" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                                    <img src="{{ asset('uploads/material/jaba-1material-image1663289151.png') }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <small class="text-muted">IT & Software</small>
                                        <h5 class="card-title mb-0">Web Developing</h5>
                                        <small class="text-muted pt-1"> Created By <span class="text-dark">Steve</span></small>
                                        <div class="border-bottom"></div>
                                        <div class="progress" style="height: 1px;">
                                            <div class="progress-bar" role="progressbar" style="" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="align-right">
                                        <small class="text-muted pt-1">61% Complete </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card h-100" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                                    <img src="{{ asset('uploads/material/jaba-1material-image1663289262.png') }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <small class="text-muted"> IT & Software</small>
                                        <h5 class="card-title mb-0">Testing</h5>
                                        <small class="text-muted pt-1"> Created By <span class="text-dark">Steve</span></small>
                                        <div class="border-bottom"></div>
                                        <div class="progress" style="height: 1px;">
                                            <div class="progress-bar" role="progressbar" style="" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="align-right">
                                        <small class="text-muted pt-1">6% Complete </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white rounded border">

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
                                    <h5 class='pt-2 pl-0'>Categories</h5>
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="Business">Business</label>
                                    </div>
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">IT & Software</label>
                                    </div>
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Finance & Accounting</label>
                                    </div>
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Design & Marketing</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <div class="border-bottom">
                                    <h5 class='pl-0'>Level</h5>
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Intro</label>
                                    </div>
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Intermediate</label>
                                    </div>
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Advanced</label>
                                    </div>


                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <div class="border-bottom">
                                    <h5 class='pl-0'>Others</h5>
                                    <div class="mb-2 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Training Links</label>
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
            </div>
        </div>
    </div>
@endsection
