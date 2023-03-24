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
            <h4 style="font-weight: bold" class="mt-1">Race Log</h4>
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

<div class="container-fluid">
  @if (session('success'))
      <div class="alert alert-success">
        {{session('success')}}
      </div>
  @endif
  <div class="col-sm-3">
    <div class="input-group input-group-sm" >

    <form action="/member/search" method="GET">
        <div class="row">
          <div class="col">
            <select class="form-select" aria-label="Default select example" name="race_id" id="race_id" style="width: 150px;">
              <option class="opt1" value="" disabled selected hidden>Select Race</option>
                @foreach($allRaces as $allRace)
                  <option value="{{$allRace->id}}"> {{$allRace->description}} - {{ date('M/d/Y h:i:s A', strtotime($allRace->date_start)); }}</option>
                @endforeach
            </select>
          </div>
          <div class="col">
            <input type="submit" name="query" class="btn btn-primary">
          </div>
        </div>
    </form>

    </div>
  </div>
  <br>
  <button type="button" class="btn btn-primary btnRace">
    View Race Information
  </button>
<br><br>


  {{-- <button class="btn btn-success" onclick="exportTableToExcel('myTable', 'Race Result')">Export Result</button> --}}
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
                     <th>Flight</th>
                     <th>Points</th>

                    </tr>
                  </thead>
                  <tbody id="OrderTbody" class="OrderTbody">
                    @php
                    $i = 1;
                    @endphp
                    @if($races != "")
                        @foreach ($races as $race)

                        <tr>
                          <td class="align-middle">{{$i++ }}</td>
                          <td class="align-middle">{{$race ->arrival }}</td>
                          <td class="align-middle">{{$race ->loft_name }}</td>
                          <td class="align-middle">{{$race ->ring_no }}</td>
                          <td class="align-middle">{{$race ->distance }}</td>
                          <td class="align-middle">{{$race ->speed }}</td>
                          <td class="align-middle">{{$race ->pigeon_placed }} / {{$race ->pigeon_count }}</td>
                          <td class="align-middle">{{$race ->flight }}</td>
                          <td class="align-middle">{{$race ->points }}</td>



                        </tr>
                        @endforeach
                      @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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


                            @if ($current_race == "")
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

                            @else
                            <div class="col-md-12" style="font-size:20px;">
                                <div class="row">
                                  <div class="col-sm-6">
                                    Address:



                                  </div>
                                  <div class="col-sm-6 "  id="address" style="font-weight: bold">
                                    {{ $current_race->address }}
                                  </div>
                                </div>
                                <hr>
                                <div class="row">
                                  <div class="col-sm-6">
                                    Time Release:
                                  </div>
                                  <div class="col-sm-6 "  id="release" style="font-weight: bold">
                                    {{ $current_race->date_start }}
                                  </div>
                                </div>
                                <hr>
                                <div class="row">
                                  <div class="col-sm-6">
                                    Points:
                                  </div>
                                  <div class="col-sm-6 "  id="points" style="font-weight: bold">
                                    {{ $current_race->additional_points }}
                                  </div>
                                </div>
                                <hr>
                                <div class="row">
                                  <div class="col-sm-6">
                                    Total Entry:
                                  </div>
                                  <div class="col-sm-6 "  id="entry" style="font-weight: bold">
                                    {{ $participant_count }}
                                  </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                      Total Arrived:
                                    </div>
                                    <div class="col-sm-6 "  id="arrived" style="font-weight: bold">
                                        {{ $participant_arrived }}
                                    </div>
                                  </div>

                                  <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                      Percentage:
                                    </div>
                                    <div class="col-sm-6 "  id="percentage" style="font-weight: bold">
                                        {{ ($participant_arrived / $participant_count) * 100 }}
                                    </div>
                                  </div>
                                <hr>



             </div>
                            @endif


                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
         {{-- modal --}}
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

<script>
     $(document).ready(function () {
       $('body').on('click', '.btnRace', function () {
        console.log("view race");
            $('#raceModal').modal('show');

    });
});
</script>






{{--  --}}
@endsection

