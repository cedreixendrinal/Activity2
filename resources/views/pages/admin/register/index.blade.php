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
            <h4 style="font-weight: bold" class="mt-1">Register Pigeon</h4>
          </div>

          <div class="col-sm-3">
            <div class="input-group input-group-sm" >



            </div>
          </div>

          <div class="col-sm-3">
            {{-- modal --}}
               <!-- Button trigger modal -->


                     @foreach($status as $current_status)
                     @if($current_status->status == 0)
                     <button type="button" class="btn btn-primary  mt-1" data-toggle="modal" data-target="#exampleModalScrollable">
                        Register Pigeon
                      </button>
                     @endif
                  @endforeach

                     <!-- Modal -->
                     <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                       <div class="modal-dialog  " role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalScrollableTitle">Pigeon Information</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form action="/admin/register" method="POST" enctype="multipart/form-data" autocomplete="off">
                               @csrf

                               <div class="container">

                                <div class="row">
                                <label for="Race">Select Race Event</label>
                                      <div class="col-sm">
                                          <select class="form-select" aria-label="Default select example" name="race_id" id="race_id" >
                                            <option class="opt1" value="" disabled selected hidden>Select Race</option>
                                              @foreach($races as $race)
                                                <option value="{{$race->id}}"> {{$race->description}} </option>
                                              @endforeach
                                          </select>
                                      </div>

                                  </div>

                                  <div class="row">
                                      <div class="col-sm">

                                          {{-- <select class="form-select" aria-label="Default select example" name="kalapati_id" id="kalapati_id" >
                                            <option class="opt1" value="" disabled selected hidden>Select Pigeon</option>
                                              @foreach($kalapatis as $kalapati)
                                                <option value="{{$kalapati->k_id}}"> {{$kalapati->k_ring_no}} </option>
                                              @endforeach
                                          </select> --}}

                                          <label for="Pigeon" class="form-label">Select Pigeon</label>
                                          <input class="form-control" list="datalistOptions" id="txt" placeholder="Select Pigeon">
                                          <datalist id="datalistOptions">
                                            @foreach($kalapatis as $kalapati)
                                            <option value=" {{$kalapati->k_ring_no}}" data-id="{{$kalapati->k_id}}">
                                                @endforeach
                                          </datalist>
                                          <input style="display:none" type="text" id="pigeon_id" name="pigeon_id">
                                      </div>

                                  </div>

                                  <div class="row">
                                    <div class="col-sm">
                                        <label for="serial_code">Serial Code</label>
                                        <input type="text" class="form-control" name="serial_code" id="serial_code" placeholder="Serial Code" required>
                                    </div>
                                 </div>

                                 <div class="row">
                                    <div class="col-sm">
                                        <label for="distance">Distance</label>
                                        <input type="text" class="form-control" name="distance" id="distance" placeholder="Distance" required>
                                    </div>
                                 </div>

                                <br>

                        </div>

                               <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Register Pigeon</button>
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

                     <th>Race</th>
                     <th>Date Created</th>
                      <th>Owner</th>
                      <th>Ring No</th>
                      <th>Serial Code</th>
                      <th>Distance</th>
                      <th>Status</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($participants as $participant)
                    <tr>


                      <td class="align-middle">{{$participant ->r_description}}</td>
                      <td class="align-middle">{{$participant ->r_create_at}}</td>

                      <td class="align-middle">{{$participant ->u_name}}</td>
                      <td class="align-middle">{{$participant ->k_ring_no}}</td>
                      <td class="align-middle">{{$participant ->p_serial_code}}</td>
                      <td class="align-middle">{{$participant ->p_distance}}</td>
                      @if($participant ->p_status == 0)
                        <td class="align-middle">Not Arrived</td>
                      @else
                        <td class="align-middle">Arrived</td>
                      @endif

                      <td class="align-middle">
                          {{-- update modal --}}
                          <button type="button" data-id="{{ $participant->p_id }}"  class="btn editbtn" style="background: none;
                          color: inherit;
                          border: none;
                          padding: 0;
                          font: inherit;
                          cursor: pointer;
                          outline: inherit;
                          margin-top:-5px;
                          "> <i class="fas fa-edit"></i>Edit </button>

                          <div class="modal fade"  id="editmodal" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-bs-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel"> Update Registered Pigeon  </h5>
                                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                          <span aria-bs-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                      <div class="modal-body">
                                        <form action="" method="POST" enctype="multipart/form-data" id="updateroute">
                                        @csrf
                                        @method('PUT')

                                        <div class="container">

                              <div class="row">
                              <label for="Race">Select Race Event</label>
                                    <div class="col-sm">
                                        <select class="form-select" aria-label="Default select example" name="race_id2" id="race_id2" >
                                          <option class="opt1" value="" disabled selected hidden>Select Race</option>
                                            @foreach($races as $race)
                                              <option value="{{$race->id}}"> {{$race->description}} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm">

                                        {{-- <select class="form-select" aria-label="Default select example" name="kalapati_id" id="kalapati_id" >
                                          <option class="opt1" value="" disabled selected hidden>Select Pigeon</option>
                                            @foreach($kalapatis as $kalapati)
                                              <option value="{{$kalapati->k_id}}"> {{$kalapati->k_ring_no}} </option>
                                            @endforeach
                                        </select> --}}

                                        <label for="Pigeon" class="form-label">Select Pigeon</label>
                                        <input class="form-control" list="datalistOptions" id="txt" placeholder="Select Pigeon">
                                        <datalist id="datalistOptions">
                                          @foreach($kalapatis as $kalapati)
                                          <option value=" {{$kalapati->k_ring_no}}" data-id="{{$kalapati->k_id}}">
                                              @endforeach
                                        </datalist>
                                        <input style="display:none" type="text" id="kalapati_id2" name="kalapati_id2">
                                    </div>

                                </div>

                                <div class="row">
                                  <div class="col-sm">
                                      <label for="serial_code">Serial Code</label>
                                      <input type="text" class="form-control" name="serial_code2" id="serial_code2" placeholder="Serial Code" required>
                                  </div>
                               </div>

                               <div class="row">
                                  <div class="col-sm">
                                      <label for="distance">Distance</label>
                                      <input type="text" class="form-control" name="distance2" id="distance2" placeholder="Distance" required>
                                  </div>
                               </div>

                              <br>

                      </div>

                             <div class="modal-footer">
                               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                               <button type="submit" class="btn btn-primary">Update Pigeon</button>
                             </div>
                             </form>

                              </div>
                          </div>
                     </div>

                          {{-- update modal --}}

                      </td>


                      {{-- here --}}
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="mt-2">

            </div>
          </div>
        </div>
</div>
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


         let updateroutes = "/admin/register/"+id;
          $("#updateroute").attr("action", updateroutes);


      $.get('/admin/register/'+id+'/edit', function (data) {
        console.log(data);
           $('#distance2').val(data.distance);
           $('#serial_code2').val(data.serial_code);
           $('#kalapati_id2').val(data.kalapati_id);
           $('#race_id2').val(data.race_id);

       });

    });
  });



    </script>


<script>
   $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<script>
    $('#txt').on('change', function() {
        var pigeon_id =  $("#datalistOptions option[value='" + $('#txt').val() + "']").attr('data-id');

        $("#pigeon_id").val(pigeon_id);

var obj = $("#datalistOptions").find("option[value='" + val + "']");

if(obj != null && obj.length > 0){
    // alert("valid");  // allow form submission
}

else{
    alert("invalid"); // don't allow form submission
}

});



</script>



{{--  --}}
@endsection

