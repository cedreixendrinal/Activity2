@extends('layouts.resident')

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
            <h4 style="font-weight: bold" class="mt-1">Race Result</h4>
          </div>

          <div class="col-sm-3">
            <div class="input-group input-group-sm" >



            </div>
          </div>

          <div class="col-sm-3">
            {{-- modal --}}
               <!-- Button trigger modal -->
                     <!-- <button type="button" class="btn btn-primary  mt-1" data-toggle="modal" data-target="#exampleModalScrollable">
                       Assign Pigeon
                     </button> -->

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
                             <form action="/admin/kalapati" method="POST" enctype="multipart/form-data">
                               @csrf

                               <div class="container">

                               <div class="row">
                                    <div class="col-sm">
                                    <select class="form-select" aria-label="Default select example" name="user_id" id="user_id" >
                                           <option class="opt1" value="" disabled selected hidden>Select Item</option>

                                        </select></div>

                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <label for="ring_no">Ring No</label>
                                        <input type="text" class="form-control" name="ring_no" id="ring_no" placeholder="Ring No" required>
                                    </div>

                                </div>

                                <br>

                        </div>

                               <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Assign Pigeon</button>
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
       <button type="button" class="btn btn-primary btnRace">
        View Race Information
      </button>
      <button type="button" class="btn btn-primary btnPigeon" >
        View My Pigeon
      </button>
      <button type="button" class="btn btn-primary btnForecast" >
      Forecast
      </button>
      {{-- <button class="btn btn-success" onclick="exportTableToExcel('myTable', 'Race Result')">Export Result</button> --}}
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
                     <th>Position</th>
                     <th>Arrival</th>
                     <th>Owner</th>
                     <th>Kalapati Ring No</th>
                     <th>Distance</th>
                     <th>Speed</th>
                     <th>Pigeon Count</th>
                     <th>Percentage</th>
                     <th>Points</th>

                    </tr>
                  </thead>
                  <tbody id="OrderTbody" class="OrderTbody">

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

                <!-- Button trigger modal -->


                  <!-- Modal -->
                  <div class="modal fade" id="raceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalScrollableTitle">Race Information</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">


                                <div class="col-md-12" style="font-size:20px;">
                                        <div class="row">
                                          <div class="col-sm-6">
                                             Address:
                                          </div>
                                          <div class="col-sm-6 "  id="address" style="font-weight: bold">

                                          </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            Time Release:
                                          </div>
                                          <div class="col-sm-6 "  id="release" style="font-weight: bold">

                                          </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            Points:
                                          </div>
                                          <div class="col-sm-6 "  id="points" style="font-weight: bold">

                                          </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            Total Entry:
                                          </div>
                                          <div class="col-sm-6 "  id="entry" style="font-weight: bold">

                                          </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                              Total Arrived:
                                            </div>
                                            <div class="col-sm-6 "  id="arrived" style="font-weight: bold">

                                            </div>
                                          </div>

                                          <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                              Percentage:
                                            </div>
                                            <div class="col-sm-6 "  id="percentage" style="font-weight: bold">

                                            </div>
                                          </div>
                                        <hr>



                     </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
         {{-- modal --}}



                  <!-- Modal -->
                  <div class="modal fade" id="forecastModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalScrollableTitle">Forecast</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">


                                <div class="col-md-12" style="font-size:20px;">
                                        <div class="row">
                                          <div class="col-sm-6">
                                             Release Point:
                                          </div>
                                          <div class="col-sm-6 "  id="rp" style="font-weight: bold">

                                          </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            Distance:
                                          </div>
                                          <div class="col-sm-6 "  id="distance" style="font-weight: bold">

                                          </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            Release Time:
                                          </div>
                                          <div class="col-sm-6 "  id="rt" style="font-weight: bold">

                                          </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            1400 Mpm:
                                          </div>
                                          <div class="col-sm-6 "  id="14" style="font-weight: bold">

                                          </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                1300 Mpm:
                                            </div>
                                            <div class="col-sm-6 "  id="13" style="font-weight: bold">

                                            </div>
                                          </div>

                                          <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                1200 Mpm:
                                            </div>
                                            <div class="col-sm-6 "  id="12" style="font-weight: bold">

                                            </div>
                                          </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                1100 Mpm:
                                            </div>
                                            <div class="col-sm-6 "  id="11" style="font-weight: bold">

                                            </div>
                                          </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                1000 Mpm:
                                            </div>
                                            <div class="col-sm-6 "  id="10" style="font-weight: bold">

                                            </div>
                                          </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                900 Mpm:
                                            </div>
                                            <div class="col-sm-6 "  id="9" style="font-weight: bold">

                                            </div>
                                          </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                800 Mpm:
                                            </div>
                                            <div class="col-sm-6 "  id="8" style="font-weight: bold">

                                            </div>
                                          </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                700 Mpm:
                                            </div>
                                            <div class="col-sm-6 "  id="7" style="font-weight: bold">

                                            </div>
                                          </div>
                                        <hr>



                     </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
         {{-- modal --}}

  <!-- Modal -->
  <div class="modal fade" id="pigeonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Pigeon Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


                <div class="col-md-12 pigeons" style="font-size:20px;" id="pigeons">



              </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
      </div>
    </div>
  </div>
{{-- modal --}}


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

    fetch();
    getRace();
    getMyPigeon();
    forecast();
    function fetch(){

      var count = 1;
            $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
            $.ajax({
                          type: "GET",
                          url: "/member/get-result",
                          dataType: "json",
                          success: function (response) {

                              if (response.data != null) {
                                //   console.log(response);
                                  $('.OrderTbody').html("");
                                  $.each(response.data, function (key, item) {


                                    var speed = parseFloat(item.speed).toFixed(3);

                                      $('.OrderTbody').append('<tr>\
                                          <td>' + count++ + '</td>\
                                          <td>' + item.arrival + '</td>\
                                          <td>' + item.loft_name + '</td>\
                                          <td>' + item.ring_no + '</td>\
                                          <td>' + item.distance + '</td>\
                                          <td>' + speed + '</td>\
                                          <td>' + item.pigeon_placed + '/' + item.pigeon_count +'</td>\
                                          <td>' + (item.pigeon_placed /item.pigeon_count) * 100 +'%</td>\
                                          <td>' + item.points + '</td>\
                                      \</tr>');

                                  });



                                }
                              }
                        });
              }
                setInterval(fetch, 1000);


        function getRace(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.btnRace', function () {
            var user_id = $(this).data('id');
            $('#raceModal').modal('show');

            $.ajax({
                          type: "GET",
                          url: "/member/get-race",
                          dataType: "json",
                          success: function (response) {

                              if (response.data != null) {

                                console.log(response);
                                 $('#address').text(response.data.address);
                                 $('#points').text(response.data.additional_points);
                                 $('#release').text(response.data.date_start);
                                 $('#arrived').text(response.participant_arrived);
                                 $('#entry').text(response.participant_count);
                                var percent = (response.participant_arrived / response.participant_count) * 100;
                                 $('#percentage').text(percent+'%');
                                }
                              }
                        });

            });
        }

        function getMyPigeon(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.btnPigeon', function () {
            var user_id = $(this).data('id');
            $('#pigeonModal').modal('show');

                $.ajax({
                            type: "GET",
                            url: "/member/get-pigeon",
                            dataType: "json",
                            success: function (response) {
                                $('.pigeons').html("");
                                if (response.data != null) {
                                    $.each(response.data, function (key, item) {

                                         console.log(item.kalapati_id);
                                         var status;
                                         if(item.status == 1 ){
                                            status = "Arrived";
                                         }else{
                                            status = "Pending";
                                         }
                                         $('.pigeons').append('<div class="row">\
                                                <div class="col-sm-3">\
                                                    Ring No. :\
                                                </div>\
                                                <div class="col-sm-3 "  id="" style="font-weight: bold">\
                                                    ' + item.ring_no + '\
                                                </div>\
                                                <div class="col-sm-3">\
                                                    Status :\
                                                </div>\
                                                <div class="col-sm-3 "  id="" style="font-weight: bold">\
                                                    ' + status + '\
                                                </div>\
                                            </div>\
                                            \<hr>');
                                    });

                                }
                          }
                });


            });
        }


        function forecast(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.btnForecast', function () {
            var user_id = $(this).data('id');
            $('#forecastModal').modal('show');

                $.ajax({
                            type: "GET",
                            url: "/member/get-forecast",
                            dataType: "json",
                            success: function (response) {
                                $('.pigeons').html("");
                                if (response.data != null) {


                                if (response.data != null) {
                                            // console.log(response);
                                    $('#rp').text(response.data.data1.address);
                                    $('#distance').text(response.data.data2.distance);
                                    $('#rt').text(response.data.data1.date_start);


                                    var var14 = ((response.data.data2.distance / 1400) * 1000) ;


                                    // var newDateObj = new Date(response.data.data1.date_start.getTime() + var14);

                                    $('#14').text(response.data.fourteen);
                                    $('#13').text(response.data.thirteen);
                                    $('#12').text(response.data.twelve);
                                    $('#11').text(response.data.eleven);
                                    $('#10').text(response.data.ten);
                                    $('#9').text(response.data.nine);
                                    $('#8').text(response.data.eight);
                                    $('#7').text(response.data.seven);


                                }
                                }
                          }
                });


            });
        }


    });



    </script>

<script>
    function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
    }
}
</script>





{{--  --}}
@endsection

