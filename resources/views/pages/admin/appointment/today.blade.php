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
            <h4 style="font-weight: bold" class="mt-1">Today's Appointment</h4>
          </div>

          <div class="col-sm-3">
            <div class="input-group input-group-sm" >



            </div>
          </div>

          <div class="col-sm-3">
            {{-- modal --}}
               <!-- Button trigger modal -->
                     <!-- <button type="button" class="btn btn-primary  mt-1" data-toggle="modal" data-target="#exampleModalScrollable">
                       Request an Appointment
                     </button> -->

                     <!-- Modal -->
                     <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                       <div class="modal-dialog " role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalScrollableTitle">Appointment Information</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form action="/resident/appointment" method="POST" enctype="multipart/form-data">
                               @csrf

                               <div class="container">
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="request_date">Request Date</label>
                                        <input type="date" class="form-control" name="request_date" id="request_date" placeholder="Request Date" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <label for="reason">Reason for Checkup</label>
                                        <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
                                    </div>
                                </div>
                             </div>

                        </div>

                               <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Request Appointment</button>
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
img {
    max-width: 100%;
    height: auto;
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
                <table class="table table-head-fixed text-nowrap table-striped " id="myTable" >
                  <thead class="thead-light">
                    <tr>
                     <th>ID</th>
                     <th>Name</th>
                      <th>Reason for Checkup</th>
                      <th>Request Date</th>
                      <th>Status</th>
                      <th>Approved Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($appointments as $appointment)
                    <tr>

                      <td class="align-middle">{{$appointment ->a_id }}</td>
                      <td class="align-middle">{{$appointment ->u_name }}</td>
                      <td class="align-middle">{{$appointment ->a_reason}}</td>
                      <td class="align-middle">{{$appointment ->a_request_date}}</td>
                      @if($appointment ->a_status == 0)
                          <td class="align-middle">Pending</td>
                        @elseif ($appointment ->a_status == 1)
                          <td class="align-middle">In Progress</td>
                        @elseif ($appointment ->a_status == 2)
                          <td class="align-middle">Declined</td>
                        @else
                          <td class="align-middle">Completed</td>
                        @endif

                        <td class="align-middle">{{$appointment ->a_approved_date}}</td>
                        @if($appointment ->a_status == 0)
                            <button data-id="{{ $appointment->a_id }}" type="button" class="btn  btn-primary approveBtn" style="display:inline;"><i class="fa fa-thumbs-up"> </i></button>
                            <button data-id="{{ $appointment->a_id }}" type="submit" class="btn  btn-danger declinedBtn"> <i class="fa fa-thumbs-down"> </i></button>
                          @endif
                          <td class="align-middle">
                          @if($appointment ->a_status == 3)
                               <button data-id="{{ $appointment->a_id }}" type="button" class="btn btn-danger printBtn"> <i class="fas fa-file-alt"></i> Print Prescription</button>
                          @else
                          <button data-id="{{ $appointment->a_id }}" type="button" class="btn btn-primary editbtn"> <i class="fas fa-eye"></i> Examine</button>

                          @endif

                          <!-- {{-- update modal --}}
                          @if($appointment ->a_status == 0)
                            <button data-id="{{ $appointment->a_id }}" type="button" class="btn  btn-primary approveBtn" style="display:inline;"><i class="fa fa-thumbs-up"> </i></button>
                            <button data-id="{{ $appointment->a_id }}" type="submit" class="btn  btn-danger declinedBtn"> <i class="fa fa-thumbs-down"> </i></button>
                          @endif
                          <button type="button" class="btn btn-info editbtn"> <i class="fas fa-eye"></i></button> -->

                          <div class="modal fade" id="editmodal" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-bs-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Transaction Information </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-bs-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                      <div class="modal-body">
                                        <form action="" method="POST" enctype="multipart/form-data" id="todayroute">
                                        @csrf
                                        @method('PUT')

                                        <div class="container">
                                            <div class="row">
                                              <div class="col-sm">
                                                <label for="impression">Impression</label>
                                                <textarea class="form-control" id="impression" name="impression" rows="3"></textarea>
                                                <input style="display: none;" type="text" class="form-control" value="3" name="status2" id="status2">

                                              </div>
                                            </div>

                                            <br>

                                            <div class="row">

                                                <div class="col-sm">
                                                    <input type="text" class="form-control medicine" name="medicine" id="medicine" placeholder="Medicine">

                                                 </div>

                                                 <div class="col-sm">
                                                    <input type="number" class="form-control quantity" name="quantity" id="quantity" placeholder="Quantity">

                                                 </div>

                                                 <div class="col-sm">
                                                    <input type="number" class="form-control times" name="times" id="times" placeholder="Times">

                                                 </div>

                                                <div class="col-sm">
                                                    <button type="button" class="btn btn-primary addToCart">Add</button>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class=" card-body table-responsive p-0" style="z-index: -99999">
                                                      <table id="table_id2" class="table  text-nowrap   table-striped " >
                                                        <thead class="thead-light thead2">
                                                          <tr>

                                                            <th>Medicine</th>
                                                            <th>Quantity</th>
                                                            <th>Times a Day</th>
                                                            <th>Action</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody class="OrderTbody ">

                                                        </tbody>
                                                      </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                  </div>
                                              </div>
                                          </div>





                                              </div>

                                        </div>


                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" name="updatedata" class="btn btn-primary">Save</button>
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


            {{-- approve modal --}}
               <!-- Button trigger modal -->


                     <!-- Modal -->
                     <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollable1Title" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalScrollable1Title">Approve Transaction</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                           <form action="" method="POST" enctype="multipart/form-data" id="approveroute">
                                              @csrf
                                              @method('PUT')

                                              <div class="container">
                                                 <div class="row">
                                                    <div class="col-sm">
                                                      <label for="approved_date2" >Appointment Date</label>
                                                      <input type="date" class="form-control" name="approved_date2" id="approved_date2">
                                                      <input style="display: none;" type="text" class="form-control" value="1" name="status2" id="status2">

                                                      <br>
                                                    </div>
                                                </div>
                                              </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="" class="btn btn-primary">Approve</button>
                                            </div>
                                        </form>
                           </div>
                         </div>
                       </div>
                     </div>
            {{-- approve modal --}}



       {{-- declined modal --}}
               <!-- Button trigger modal -->


                     <!-- Modal -->
                     <div class="modal fade" id="declinedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollable1Title" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalScrollable1Title">Decline Transaction</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                           <form action="" method="POST" enctype="multipart/form-data" id="declineroute">
                                              @csrf
                                              @method('PUT')

                                              <div class="container">
                                              <div class="row">
                                                  <div class="col-sm-12">
                                                   <label for="remarks2">Remarks</label>
                                                     <textarea class="form-control" id="remarks2" name="remarks2" rows="3"></textarea>
                                                     <input style="display: none;" type="text" class="form-control" value="3" name="status2" id="status2">


                                                    </div>
                                                    <br>
                                                  </div>
                                              </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="" class="btn btn-danger">Decline</button>
                                            </div>
                                        </form>
                           </div>
                         </div>
                       </div>
                     </div>
            {{-- declined modal --}}


            {{-- Prescription modal --}}
               <!-- Button trigger modal -->


                     <!-- Modal -->
                     <div class="modal fade" id="presModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollable1Title" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalScrollable1Title">Prescription</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                           <form action="" method="POST" enctype="multipart/form-data" id="">
                                              @csrf
                                              @method('PUT')

                                              <div class="container">
                                              <div class="row">
                                                  <div class="col-sm-12">
                                                   <label for="impression2">Impression:</label>
                                                     <p id="impression2" style="color:black;"></p>

                                                    </div>
                                                    <br>
                                                  </div>
                                              </div>

                                              <div class="row">
                                                <div class="col-12">
                                                      <div class=" card-body table-responsive p-0" style="z-index: -99999">
                                                        <table id="table_id2" class="table  text-nowrap   table-striped " >
                                                          <thead class="thead-light thead2">
                                                            <tr>

                                                              <th>Medicine</th>
                                                              <th>Quantity</th>
                                                              <th>Times a Day</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody class="OrderTbody2">

                                                          </tbody>
                                                        </table>
                                                      </div>
                                                      <!-- /.card-body -->
                                                    </div>
                                                </div>
                                              </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" name="" class="btn btn-danger"> <a id="printpres" style="text-decoration:none;color:white" href="">Print</a> </button>
                                            </div>
                                        </form>
                           </div>
                         </div>
                       </div>
                     </div>
            {{-- Prescription modal --}}
            <div class="mt-2">
              {{$appointments->links()}}
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

        $('body').on('click', '.printBtn', function () {
          var trans_id = $(this).data('id');
          $("#printpres").attr("href", "/admin/appointment/print-prescription/"+trans_id)
      $('#presModal').modal('show');
            $.ajax({
                  type: "GET",
                  url: "/admin/appointment/get-prescription/"+trans_id,
                  dataType: "json",
                  success: function (response) {

                      if (response.data != null) {
                           console.log(response);
                          $('.OrderTbody2').html("");
                          $('#impression2').text("");
                          $.each(response.data, function (key, item) {
                        console.log(response.data);
                           $('#impression2').text(item.impression);
                              $('.OrderTbody2').append('<tr>\
                                  <td>' + item.medicine + '</td>\
                                  <td class="text-wrap">' + item.quantity + '</td>\
                                  <td>' + item.times + '</td></tr>');
                              // calc_total();
                              // get_store_id = item.c_store_id;
                          });
                          // getStores(customer_id);


                        }
                      }
                });
      });
        $('body').on('click', '.editbtn', function () {
      $('#editmodal').modal('show');
       var trans_id = $(this).data('id');
       let todayroutes = "/admin/appointment/today/"+trans_id;
          $("#todayroute").attr("action", todayroutes);
           fetch();


        function fetch(){
            $.ajax({
                  type: "GET",
                  url: "/admin/appointment/get-today-temp/"+trans_id,
                  dataType: "json",
                  success: function (response) {

                      if (response.data != null) {
                           console.log(response);
                          $('.OrderTbody').html("");
                          $.each(response.data, function (key, item) {


                              $('.OrderTbody').append('<tr>\
                                  <td>' + item.medicine + '</td>\
                                  <td class="text-wrap">' + item.quantity + '</td>\
                                  <td>' + item.times + '</td>\
                              <td><button type="button" value="' + item.id + '" class="btn btn-danger deleteListBtn btn-sm">Delete</button></td>\
                              \</tr>');
                              // calc_total();
                              // get_store_id = item.c_store_id;
                          });
                          // getStores(customer_id);


                        }
                      }
                });
        }
        $(document).on('click', '.addToCart', function (e) {
                e.preventDefault();
                var data = {

                'medicine': $('.medicine').val(),
                'quantity': $('.quantity').val(),
                'times': $('.times').val(),
                'appointment_id':trans_id,

                }
                $.ajaxSetup({
                    headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              }
                });

                $.ajax({
                    type: "POST",
                    url: "/admin/appointment/temp-today/",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                           console.log(response);
                        if (response.status == 400) {


                        } else {
                            fetch();


                        }
                    }
                });

              });


// ADD

  // DELETE
  $(document).on('click', '.deleteListBtn', function (e) {
            e.preventDefault();


            var list_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "/admin/appointment/delete-list/" + list_id,
                dataType: "json",
                success: function (response) {
                         console.log(response);
                    if (response.status == 404) {

                    } else {

                        fetch();

                    }
                }
            });




        });
        // DELETE

      });
      });
    </script>


<script>
  $(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.approveBtn', function () {
      $('#approveModal').modal('show');
       var trans_id = $(this).data('id');

         let approveroutes = "/admin/appointment/pending/"+trans_id;
          $("#approveroute").attr("action", approveroutes);

      $.get('/admin/appointment/pending/'+trans_id+'/edit', function (data) {
        console.log(data);
           $('#approved_date2').val(data.request_date);

      });

    });


    $('body').on('click', '.declinedBtn', function () {
      $('#declinedModal').modal('show');
       var trans_id = $(this).data('id');

         let declineroutes = "/admin/appointment/pending/"+trans_id;
          $("#declineroute").attr("action", declineroutes);

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

