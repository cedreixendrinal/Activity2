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
            <h4 style="font-weight: bold" class="mt-1">Events</h4>
          </div>

          <div class="col-sm-3">
            <div class="input-group input-group-sm" >



            </div>
          </div>

          <div class="col-sm-3">
            {{-- modal --}}
               <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary  mt-1" data-toggle="modal" data-target="#exampleModalScrollable">
                       Add New Event
                     </button>

                     <!-- Modal -->
                     <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                       <div class="modal-dialog modal-lg " role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalScrollableTitle">Event Information</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form action="/admin/event" method="POST" enctype="multipart/form-data">
                               @csrf

                               <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Title" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="category">Category</label>
                                        <select class="form-select" aria-label="Default select example" name="sel_category" id="sel_category" >
                                           <option class="opt1" value="" disabled selected hidden>Select Item</option>
                                            @foreach($categories as $category)
                                              <option value="{{$category->id}}"> {{$category->category_code}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6" id="date_from">
                                        <label for="date_from">Date From</label>
                                        <input type="date" class="form-control" name="date_from" id="date_from" placeholder="Date From" required>
                                    </div>
                                    <div class="col-sm-6" id="date_to">
                                        <label for="date_to">Date To</label>
                                        <input type="date" class="form-control" name="date_to" id="date_to" placeholder="Date To" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6" id="date_from">
                                        <label for="url">URL</label>
                                        <input type="text" class="form-control" name="url" id="url" placeholder="URL" required>
                                    </div>
                                    <div class="col-sm-6" id="date_from">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" name="price" id="price" placeholder="Price" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm">
                                    <label for="remarks">Remarks</label>
                                    <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Remarks" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="image_1">Add Image</label>
                                        <input type="file" class="form-control" name="image_1" id="image_1" >
                                    </div>
                                    <!-- <div class="col-sm-4">
                                        <label for="image_2">Add Image</label>
                                        <input type="file" class="form-control" name="image_2" id="image_2" >
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="image_3">Add Image</label>
                                        <input type="file" class="form-control" name="image_3" id="image_3" >
                                    </div> -->
                                </div>
                                <!-- <br>
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="category">Educational Attainment</label>
                                        <br>
                                        <label class="form-check-label" for="defaultCheck1">
                                            Senior High
                                        </label>
                                        <input class="mr-2" type="checkbox" value="" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            College
                                        </label>
                                        <input class="mr-2" type="checkbox" value="" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Masters
                                        </label>
                                        <input class="mr-2" type="checkbox" value="" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Doctorate
                                        </label>
                                        <input class="mr-2" type="checkbox" value="" id="defaultCheck1">
                                    </div>


                                </div> -->
                             </div>

                        </div>

                               <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Add Event</button>
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
   -webkit-line-clamp: 1; /* number of lines to show */
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
                <table class="table table-head-fixed text-nowrap table-striped table-hover" id="myTable">
                  <thead class="thead-light">
                    <tr>
                     <th>ID</th>
                      <th>Title</th>
                      <th>Date From</th>
                      <th>Date To</th>
                      <th>Price</th>
                      <th>Category</th>
                      <th>No of Registrant</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    @foreach($events as $event)
                    <tr>

                      <td class="align-middle">{{$event ->id }}</td>
                      <td class="align-middle">{{$event ->title}}</td>
                      {{-- <td class="align-middle">
                        @if($transaction ->t_type == 1)
                            Income
                        @elseif($transaction ->t_type == 2)
                            Expense
                        @else
                            Transfer
                        @endif
                      </td> --}}
                      <td class="align-middle">{{$event ->date_from}}</td>
                      <td class="align-middle">{{$event ->date_to}}</td>
                      <td class="align-middle">{{$event ->price}}</td>
                      <td class="align-middle">Category</td>
                      <td class="align-middle">{{$event ->no_of_registrant}}</td>
                      <td class="align-middle">
                          {{-- update modal --}}
                          <button type="button" class="btn editbtn" style="background: none;
                          color: inherit;
                          border: none;
                          padding: 0;
                          font: inherit;
                          cursor: pointer;
                          outline: inherit;
                          margin-top:-5px;
                          "> <i class="fas fa-edit"></i> Edit</button>

                          <div class="modal fade" id="editmodal" role="dialog" aria-labelledby="exampleModalLabel"
                          aria-bs-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel"> Update Category Information </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-bs-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                      <div class="modal-body">
                                        <form action="" method="POST" enctype="multipart/form-data" id="formid">
                                        @csrf
                                        @method('PUT')

                                        <div class="container">
                                            <div class="row">
                                              <div class="col-sm">
                                                <label for="bank_name">Bank Name</label>
                                                <input type="text" class="form-control" name="bank_name2" id="bank_name2" placeholder="Bank Name" required>

                                              </div>
                                              <div class="col-sm">
                                                <label for="description">Description</label>
                                                <input type="text" class="form-control" name="description2" id="description2" placeholder="First Name" required>

                                              </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm">
                                                    <label for="balance">Initial Balance</label>
                                                    <input type="text" class="form-control" name="balance2" id="balance2" placeholder="Initial Balance" required>

                                                </div>
                                                <div class="col-sm">
                                                    <label for="acc_no">Account No.</label>
                                                    <input type="text" class="form-control" name="acc_no2" id="acc_no2" placeholder="Account No." required>

                                                </div>
                                              </div>



                                              <div class="row">
                                                <div class="col-sm">
                                                    <label for="contact_person">Contact Person</label>
                                                    <input type="text" class="form-control" name="contact_person2" id="contact_person2" placeholder="Contact Person" required>

                                                </div>
                                                <div class="col-sm">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" class="form-control" name="phone2" id="phone2" placeholder="phone" required>

                                                </div>
                                              </div>

                                              <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="url">Internet Banking Url</label>
                                                    <input type="text" class="form-control" name="url2" id="url2" placeholder="Internet Banking Url" required>

                                                </div>
                                              </div>

                                              </div>

                                        </div>


                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
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
              {{$events->links()}}
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
    // function myFunction() {
    //   $('#exampleModalScrollable').modal('show');
    // }
    </script>


<script>
  $(document).ready(function () {

      $('.editbtn').on('click', function () {

          $('#editmodal').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function () {
              return $(this).text();
          }).get();

          console.log(data);

          let updateroute = "/bank/"+data[0].toString();
          $("#formid").attr("action", updateroute);

          $('#bank_name2').val(data[1]);
          $('#description2').val(data[2]);
          $('#balance2').val(data[3]);
          $('#acc_no2').val(data[4]);
          $('#contact_person2').val(data[5]);
          $('#phone2').val(data[6]);
          $('#url2').val(data[7]);





        //   let valcategory_type2 = data[7].toString();
        //   $('#category_type2 option[value="' + valcategory_type2 +'"]').prop("selected", true);

        //   let valStatus = data[8].toString();
        //   $('#status2 option[value="' + valStatus +'"]').prop("selected", true);

        //   let prof_img_val = "uploads/category/"+data[9].toString();
        //   $('#download_prof_image').prop("href", prof_img_val);





      });


      $(document).on('change', '#sel_type', function (e) {
            e.preventDefault();
            type = $(this).val();
            var element = document.getElementById('category_details');
            element.innerHTML = ""; //empty

            var transfer_from = document.getElementById('transfer_from');
            transfer_from.innerHTML = ""; //empty

            var transfer_to = document.getElementById('transfer_to');
            transfer_to.innerHTML = ""; //empty

            if(type== 2){
                transfer_from.innerHTML = ""; //empty
                transfer_to.innerHTML = ""; //empty
                document.getElementById("account").disabled = false;
                document.getElementById("description").disabled = false;
                element.innerHTML = '<label for="sel_category">Category</label>\
                                <select class="form-select" aria-label="Default select example" name="sel_category" id="sel_category" required>\
                                </select>';


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'get-categories',
                    type:'get',
                    dataType:'json',

                    success:function (response) {
                        console.log(response);
                        // var len = 0;
                        if (response.data != null) {
                            // len = response.data.length;
                            $("#sel_category").empty();
                            $.each(response.data, function (key, item) {
                            $('#sel_category').append('<option class="opt1" value="" disabled selected hidden>Select Category</option>\
                                                       <option value='+item.id+'>'+item.name+'</option>');

                            });

                        }


                    }
                });
            }else if(type== 3) {
                element.innerHTML = "";
                transfer_from.innerHTML = '<label for="sel_transfer_from">Transfer From</label>\
                                <select class="form-select" aria-label="Default select example" name="sel_transfer_from" id="sel_transfer_from" required>\
                                </select>';

                transfer_to.innerHTML = '<label for="sel_transfer_to">Transfer To</label>\
                <select class="form-select" aria-label="Default select example" name="sel_transfer_to" id="sel_transfer_to" required>\
                </select>';

                document.getElementById("account").disabled = true;
                document.getElementById("description").disabled = true;


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'get-bank',
                    type:'get',
                    dataType:'json',

                    success:function (response) {
                        console.log(response);
                        // var len = 0;
                        if (response.data != null) {
                            // len = response.data.length;
                            $("#sel_transfer_from").empty();
                            $("#sel_transfer_to").empty();
                            $.each(response.data, function (key, item) {
                            $('#sel_transfer_from').append('<option class="opt1" value="" disabled selected hidden>Select Transfer From</option>\
                                                       <option value='+item.id+'>'+item.bank_name+'</option>');

                            $('#sel_transfer_to').append('<option class="opt1" value="" disabled selected hidden>Select Transfer To</option>\
                            <option value='+item.id+'>'+item.bank_name+'</option>');

                            });

                        }


                    }
                });


            }else{
               element.innerHTML = "";
               transfer_from.innerHTML = ""; //empty
               transfer_to.innerHTML = ""; //empty
               document.getElementById("account").disabled = false;
                document.getElementById("description").disabled = false;
            }


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

