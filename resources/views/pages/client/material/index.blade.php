@extends('layouts.layout')

@section('title', 'Material')

@section('content')

    @include('layouts.page-header', ['page' => [
    'title' => 'Education & Training',
    'description' => 'Activities your could explore and learn more.',
    'breadcrumbs' => [
        [
        'title' => 'Education & Training',
        'href' => '#',
        ]
    ]
    ]])

    <div class="container">
        <div class="container mt-4 mb-4">
            <div class="row">
                <div class="col-sm-9">

                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach ($materials as $material)
                            <div class="col">
                                <div class="card h-100" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                                    <img src="uploads/material/{{$material ->m_img}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <!-- <small class="text-muted"> {{ $material ->c_desc }}</small> -->
                                        <h5 class="card-title mb-0"> {{ $material ->m_title }}</h5>
                                        <small class="text-muted pt-1"> Created By <span class="text-dark">{{ $material ->u_name }}</span></small>
                                        <div class="border-bottom"></div>
                                        <small class="text-muted"> ({{ $material ->m_rating }} ratings)</small>

                                        <p class="card-text"> {{ $material ->m_desc }} <small class="text-muted"> <a
                                                    href="/material/{{ $material ->m_id }}"> Read more...</a></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
        {{$materials->links()}}
    </div>
@endsection
