@extends('layouts.layout')

@section('title', 'Trainings')

@section('content')
@foreach ($events as $event)
    @include('layouts.event-header');

    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-sm-3">
                <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white rounded border"
                    style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                    <img src="{{ asset('uploads/event/'.$event ->e_img_1) }}" class="img-fluid rounded p-2 " alt="...">
                    <div class="border-bottom align-center">
                        <div class="col bg-light p-2 d-flex justify-content-center">
                        @if($event ->t_status != "1")
                           <a href="#" class="btn btn-primary" style="border-radius:0px" data-bs-toggle="modal" data-bs-target="#myModal">
                                  @if($event ->t_id == "")
                                    Join this Training
                                @else
                                    Wait for approval
                                @endif
                                       </a>
                          
                        @endif 
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="mb-3 form-check mt-2">
                            <div class="border-bottom">
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

            <div class="col-sm-6">
                <div class="row g-0">
                    <div class="bg-white rounded" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <div class="card-body text-justify p-4">

                            @if($event ->t_status == "1")
                            <div class="row">
                                    <iframe width="950" height="534" src="{{ $event->e_url }}"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>

                                    <div class="pt-3 pb-3">
                                        <div class="h4 text-dark border-bottom"> Section 2: test lesson</div>
                                        <p class="card-text">Test lesson 2 description</p>
                                    </div>
                            
                                </div>
                            @endif

                            <div class="pt-3 pb-3">
                                <div class="h4 text-dark border-bottom"> Description </div>
                                <p class="card-text"> {{ $event -> e_desc }}
                                </p>
                                <div class="h6 text-dark border-bottom"> Schedule </div>
                                <p class="card-text text-dark"> {{ $event -> e_date_from }} to
                                    {{ $event -> e_date_to }}
                                </p>
                            </div>
                            <div class="pt-3 pb-3">
                                <div class="h4 border-bottom"> What you'll learn? </div>
                                <p class="card-text"> 
                            </div>

                            <div class="pt-3 pb-3">
                                <div class="h4 border-bottom"> Requirements </div>
                                <p class="card-text"> 
                            </div>
                            <div class="pt-3 pb-3">
                                <div class="h4 border-bottom"> Student Feedback </div>
                                <p class="card-text"> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">

             @if($event ->t_status == "1")
                    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white">
                        <a href=""
                            class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
                            <span class="fs-5 fw-semibold">Course Content</span>
                        </a>
                        <div class="list-group list-group-flush border-bottom scrollarea">

                    

                                <a href="https://meet.google.com/xws-rqbr-vbc"
                                    class="list-group-item list-group-item-action  py-3 lh-tight "
                                    aria-current="true">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <strong class="mb-1">Day 1: test lesson</strong>
                                        <small>10min</small>
                                    </div>
                                    <div class="col-10 small">Test lesson 1 description</div>
                             
                                </a>
                                <a href="https://meet.google.com/xws-rqbr-vbc"
                                    class="list-group-item list-group-item-action  py-3 lh-tight active"
                                    aria-current="true">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <strong class="mb-1">Day 2: test lesson</strong>
                                        <small>21min</small>
                                    </div>
                                    <div class="col-10 mb-1 small">Test lesson 2 description</div>
                                </a>

                                <a href="https://meet.google.com/xws-rqbr-vbc"
                                    class="list-group-item list-group-item-action  py-3 lh-tight "
                                    aria-current="true">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <strong class="mb-1">Day 3: test lesson</strong>
                                        <small>26min</small>
                                    </div>
                                    <div class="col-10 mb-1 small">Test lesson 3 description</div>
                                </a>
                        
                        </div>
                     </div>
                    @endif

                <div class="row">
                    <div class="container rounded">
                        <div class="card-body text-justify mt-2 border-round"
                            style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                            <div class="p-4 mt-5" style="background-color:#50504f0d">
                                <div class="h4 text-dark"> Have questions about this event? </div>
                                <p class="card-text"> email us at sample@email.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Instruction to join this training</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="/transaction" method="POST" enctype="multipart/form-data">
                     @csrf
                        <div class="container mt-4 mb-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>1.) Go to the nearest landbank for payment</p>
                                    <p>2.) Pay using account number <strong>SA1728374903</strong> and account name <strong>Rolando Mendoza</strong>
                                    <p>3.) Insert training code <strong>HP-100</strong>  in purpose of transaction</p>
                                    <p>4.) Attached receipt here and submit</p>
                                    <p>5.) Wait for approval, you can monitor the status in your dashboard</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-12">
                                        <label for="transaction_no"> <strong>Transaction No.</strong></label>
                                        <input type="text" class="form-control" value="" name="transaction_no" id="transaction_no" placeholder="Transaction No." required>
                                        <label for="receipt"> <strong> Attached Receipt</strong></label>
                                        <input type="file" class="form-control" name="receipt" id="receipt" placeholder="Receipt" required>
                                        <input type="text" class="form-control" value="{{ $event->e_price}}" name="price" id="price" style="display:none">
                                        <input type="text" class="form-control" value="{{ $event->e_id}}" name="event_id" id="event_id" style="display:none">
                                        <input type="text" class="form-control" value="{{ auth()->user()->id }}" name="user_id" id="user_id" style="display:none">   
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
               <!-- The Modal -->


    @endforeach 
@endsection
