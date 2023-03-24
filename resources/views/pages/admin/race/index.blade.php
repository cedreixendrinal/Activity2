@extends('layouts.admin')

@section('nav')

{{-- @if ($errors->any())

@endif --}}
<nav class="main-header  navbar-expand navbar-white navbar-light " style="padding: 5px !important;z-index: 1">
  <!-- Left navbar links -->
     <div class="row mx-0">
          <div class="col-sm-1">
            <a class="nav-link " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: gray"></i></a>
          </div>

          <div class="col-sm-5">
            <h4 style="font-weight: bold" class="mt-1">Race</h4>
          </div>

          <div class="col-sm-3">
            <div class="input-group input-group-sm" >



            </div>
          </div>

          <div class="col-sm-3">
            {{-- modal --}}
               <!-- Button trigger modal -->

                @if($status == '[]')
                <button type="button" class="btn btn-primary  mt-1" data-toggle="modal" data-target="#exampleModalScrollable">
                    Add Scheduled Race
                  </button>
                @endif

               @foreach($status as $current_status)
                  @if($current_status->status == 2)
                     <button type="button" class="btn btn-primary  mt-1" data-toggle="modal" data-target="#exampleModalScrollable">
                       Add Scheduled Race
                     </button>
                 @endif
               @endforeach


                     <!-- Modal -->
                     <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                       <div class="modal-dialog  modal-lg" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalScrollableTitle">Scheduled Race Information</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form action="/admin/race" method="POST" enctype="multipart/form-data">
                               @csrf

                               <div class="container">

                               <div class="row">
                                    <div class="col-sm">

                                      <label for="description">Lap</label>
                                          <select class="form-select js-example-basic-multiple" aria-label="Default select example" name="description" id="description" >
                                            <option class="opt1" value="" disabled selected hidden>Select Lap</option>
                                              <option value="Lap 1"> Lap 1</option>
                                              <option value="Lap 2"> Lap 2</option>
                                              <option value="Lap 3"> Lap 3</option>
                                              <option value="Lap 4"> Lap 4</option>
                                              <option value="Lap 5"> Lap 5</option>
                                              <option value="Lap 6"> Lap 6</option>
                                              <option value="Lap 7"> Lap 7</option>
                                              <option value="Lap 8"> Lap 8</option>
                                              <option value="Lap 9"> Lap 9</option>
                                              <option value="Lap 10"> Lap 10</option>

                                        </select>
                                      </div>
                                </div>

                                <!-- <div class="row">
                                    <div class="col-sm">
                                        <label for="date_start">Date Start</label>
                                        <input type="date" class="form-control" name="date_start" id="date_start" placeholder="Date Start" required>
                                    </div>

                                    <div class="col-sm">
                                        <label for="date_end">Date End</label>
                                        <input type="date" class="form-control" name="date_end" id="date_end" placeholder="Date End" required>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm">
                                        <label for="time_start">Time Start</label>
                                        <input type="time" class="form-control" name="time_start" id="time_start" placeholder="Time Start" required>
                                    </div>

                                    <div class="col-sm">
                                        <label for="time_end">Time End</label>
                                        <input type="time" class="form-control" name="time_end" id="time_end" placeholder="Time End" required>
                                    </div>
                                </div> -->

                                <div class="row">
                                    <div class="col-sm">
                                        <label for="address">Release Point</label>
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-sm">
                                        <label for="speed">Set Min Speed</label>
                                        <input type="number" class="form-control" name="speed" id="speed" placeholder="Speed" required>
                                    </div>

                                    <div class="col-sm">
                                        <label for="additional_points">Set Additional Points</label>
                                        <input type="number" class="form-control" name="additional_points" id="additional_points" placeholder="Additional Points" required>
                                    </div>
                                </div>

                                <br>

                        </div>

                               <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Add Scheduled Race</button>
                               </div>
                               </form>
                           </div>
                         </div>
                       </div>
                     </div>
            {{-- modal --}}
        </div>
     </div>




    <!-- <li class="nav-item d-none d-sm-inline-block">
      <a href="../../index3.html" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li> -->


  <!-- Right navbar links -->

</nav>
@endsection

@section('content')
<style>
    .pac-container {
    background-color: #FFF;
    z-index: 99999;
    position: fixed;
    display: inline-block;
    float: left;
}
.modal{
    z-index: 99999;
}
.modal-backdrop{
    z-index: 10;
}
.text {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 2; /* number of lines to show */
   -webkit-box-orient: vertical;
}
  </style>
<div class="container-fluid">
  @if (session('success'))
      <div class="alert alert-success">
        {{session('success')}}
      </div>
  @endif
<div class="row">
          <div class="col-12">

              <div class=" card-body table-responsive p-0" style="z-index: -99999">
                <table class="table table-head-fixed text-nowrap table-striped table-hover" id="myTable" >
                  <thead class="thead-light">
                    <tr>
                     <th>ID</th>
                     <th>Description</th>
                      <th>Release Point</th>
                      <th>Min Speed</th>
                      <th>Additional Points</th>
                      <th>Date Start</th>
                      <th>Date End</th>
                      <th>Total Participants</th>
                      <th>Status</th>

                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($races as $race)
                    <tr>

                      <td class="align-middle">{{$race ->r_id }}</td>
                      <td class="align-middle">{{$race ->r_description }}</td>
                      <td class="align-middle">{{$race ->r_address}}</td>
                      <td class="align-middle">{{$race ->r_speed}}</td>
                      <td class="align-middle">{{$race ->r_additional_points}}</td>





                      <td class="align-middle">
                      @if($race ->r_date_start != NULL)
                        {{date("F d Y", strtotime($race ->r_date_start))}} {{date("h:i:sa", strtotime($race ->r_time_start))}}
                      @else
                      @endif
                      </td>
                      <td class="align-middle">
                      @if($race ->r_date_end != NULL)
                        {{date("F d Y", strtotime($race ->r_date_end))}} {{date("h:i:sa", strtotime($race ->r_time_end))}}
                      @else
                      @endif
                     </td>


                     <td class="align-middle">

                        <?php
                        $con = new mysqli('localhost','root','','pigeon');
                        $query = $con->query("
                        select COUNT(participants.id) as p_count from participants
                        JOIN races ON  races.id = participants.race_id
                        WHERE races.id = ".$race ->r_id."
                        ");

                        foreach($query as $data)
                        {
                            echo $data['p_count'];
                        }

                        ?>
                      </td>

                      <td class="align-middle">
                         @if($race ->r_status == 0)
                          Waiting
                         @elseif ($race ->r_status == 1)
                              Started
                         @else
                              Ended
                          @endif

                        </td>

                        @if($race ->r_status == 0)

                      <td class="align-middle">
                          {{-- update modal --}}
                          <button type="button" data-id="{{ $race->r_id }}"  class="btn btn-primary  editbtn"> <i class="fas fa-edit"></i> </button>

                          <form action="/admin/race/start/{{$race ->r_id }}" method="POST" enctype="multipart/form-data" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit"  class="btn  btn-success" style="display:inline;"><i class="fa fa-play" onclick="return confirm('Are you sure you want to start the race?')"> </i></button>
                            </form>



                          <div class="modal fade"  id="editmodal" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-bs-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel"> Update Race Information </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-bs-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                      <div class="modal-body">

                                      <form action="" method="POST" enctype="multipart/form-data" id="updateroute">
                                        @csrf
                                        @method('PUT')


                               <div class="container">

<div class="row">
     <div class="col-sm">

       <label for="description2">Lap</label>
           <select class="form-select js-example-basic-multiple" aria-label="Default select example" name="description2" id="description2" >
             <option class="opt1" value="" disabled selected hidden>Select Lap</option>
               <option value="Lap 1"> Lap 1</option>
               <option value="Lap 2"> Lap 2</option>
               <option value="Lap 3"> Lap 3</option>
               <option value="Lap 4"> Lap 4</option>
               <option value="Lap 5"> Lap 5</option>
               <option value="Lap 6"> Lap 6</option>
               <option value="Lap 7"> Lap 7</option>
               <option value="Lap 8"> Lap 8</option>
               <option value="Lap 9"> Lap 9</option>
               <option value="Lap 10"> Lap 10</option>

                      </select>
                    </div>
              </div>


              <div class="row">
                  <div class="col-sm">
                      <label for="address2">Release Point</label>
                      <input type="text" class="form-control" name="address2" id="address2" placeholder="Address" required>
                  </div>
              </div>

              <div class="row">
                  <div class="col-sm">
                      <label for="speed2">Set Min Speed</label>
                      <input type="number" class="form-control" name="speed2" id="speed2" placeholder="Speed" required>
                  </div>

                  <div class="col-sm">
                      <label for="additional_points2">Set Additional Points</label>
                      <input type="number" class="form-control" name="additional_points2" id="additional_points2" placeholder="Additional Points" required>
                  </div>
              </div>

              <br>

              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Scheduled Race</button>
              </div>
              </form>
                              </div>
                          </div>
                     </div>

                          {{-- update modal --}}

                      </td>
                      @elseif($race ->r_status == 1)
                        <td>
                            <form action="/admin/race/end/{{$race ->r_id }}" method="POST" enctype="multipart/form-data" style="display: inline;">
                                @csrf
                                @method('PUT')

                                <button type="submit"  class="btn  btn-danger" style="display:inline;"><i class="fa fa-stop" onclick="return confirm('Are you sure you want to end the race?')"> </i></button>
                            </form>
                            </td>
                      @else
                      <td>


                                <button type="submit"  class="btn  btn-danger" style="display:inline;"><i class="fa fa-stop"> </i></button>

                          </td>
                      @endif

                      {{-- here --}}
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

{{--  --}}



  </body>
  </html>


  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKOU_JfykYBj4kDS8ryXPSd0kxsygDcGU&libraries=places"></script>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


  <script>
  $(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.editbtn', function () {
      var id = $(this).data('id');
      $('#editmodal').modal('show');


         let updateroutes = "/admin/race/"+id;
          $("#updateroute").attr("action", updateroutes);


      $.get('/admin/race/'+id+'/edit', function (data) {
        console.log(data);

           $('#description2').val(data.description);

           $('#date_start2').val(data.date_start);
           $('#time_start2').val(data.time_start);
           $('#time_end2').val(data.time_end);
           $('#address2').val(data.address);
           $('#speed2').val(data.min_speed);
           $('#additional_points2').val(data.additional_points);
           $('#date_end2').val(data.date_end);
       });

    });
  });



    </script>


<script>
   $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>




{{--  --}}
@endsection

