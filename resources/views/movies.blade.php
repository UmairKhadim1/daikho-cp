@extends('layouts.backend.app')
@section('title','Movies')
@push('css')
    <link href="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
    rel="stylesheet">
    <style>
        .overlay{
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 999;
            background: rgba(255,255,255,0.6) url({{asset('public/assets/loading.gif')}}) center no-repeat;
        }
        body{
            
        }
        /* Turn off scrollbar when body element has the loading class */
        body.loading{
            overflow: hidden;   
        }
        /* Make spinner image visible when body element has the loading class */
        body.loading .overlay{
            display: block;
        }
       

    </style>
@endpush
@section('content')

<div class="container-fluid">
    @if(session('successMsg'))
        <div class="alert alert-success" roles="alert">
            {{ session('successMsg') }}
        </div>
        
    @endif
   
            <!-- #END# Basic Examples -->
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL MOVIES
                                <span class="badge bg-red">{{count($movies) }}</span>
                            </h2>
                           
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-basic-example" >
                                    <thead>
                                        <tr>
                                            <th>VIDEO ID</th>
                                            <th>TITLE</th>
                                           
                                            <th>FREE STATUS</th>
                                           <th>FREE DURATION</th>
                                            
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>VIDEO ID</th>
                                            <th>TITLE</th>
                                          
                                            <th>FREE STATUS</th>
                                            <th>FREE DURATION</th>
                                          
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($movies as $key=>$movie)
                                            
                                     
                                         <tr>
                                            <td>{{ $movie->videoid }}</td>
                                            <td>{{ $movie->title }}</td>
                                            
                                            <td class="text-center"> 
                                                <form action="" >
                                                    @csrf
                                                    @method('PUT')
                                             @if ($movie->is_free==0)
                                             <p>
                                                <input name="free_status" type="checkbox" id="{{$movie->videoid}}"/>
                                                <label for="{{$movie->videoid}}"></label>
                                              </p>
                                             
                                             @else
                                             <p>
                                                <input name="free_status" type="checkbox" id="{{$movie->videoid}}" checked="checked" />
                                                <label for="{{$movie->videoid}}"></label>
                                              </p>
                                            
                                             @endif
                                                </form>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="{{$movie->videoid}}" id="time-{{$movie->videoid}}" value="{{$movie->free_duration}}"> seconds 
                                                <button class="btn btn-primary m-3" id="btn-{{$movie->videoid}}" onclick="updateTime({{$movie->videoid}})">Update</button>
                                            </td>
                                           
                                      
                                            
                                        </tr>
                                           @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
        <div class="overlay"></div>
@endsection

@push('js')
        <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Custom Js -->
  
    <script src="{{ asset('public/assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function(){
            $(":checkbox").click(function(event){
                duration=$('#time-'+event.target.id);
                updBtn=$('#btn-'+event.target.id);
                 $.ajax({
                    url:  "{{url('updateFree')}}" + '/' + event.target.id,
                    dataType: 'json',
                    type:  'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({'status':event.target.checked, _token:'{{csrf_token()}}'}),
                    processData: false,
                   
                    success: function( data){
                       
                         console.log(JSON.stringify( data.result[0].is_free));
                        duration.val(data.result[0].free_duration);
                        if (data.result[0].free_duration>0) {
                            duration.prop('disabled',true);
                            updBtn.prop('disabled',true);
                        }else{
                            duration.prop('disabled',false);
                            updBtn.prop('disabled',false);
                        }
                         Swal.fire(
                             'Done!',
                             data.success,
                             'success'
                             )
                    },
                    
                    error: function(errorThrown ){
                        console.log( errorThrown );
                    }
                });
 
 
            });
        });
        // Add remove loading class on body element depending on Ajax request status
$(document).on({
    ajaxStart: function(){
        $("body").addClass("loading"); 
    },
    ajaxStop: function(){ 
        $("body").removeClass("loading"); 
    }    
});
function updateTime(id){
        var time=$('#time-'+id).val();
        $.ajax({
                    url:  "{{url('updateTime')}}" + '/' + id+ '/' + time,
                    dataType: 'json',
                    type:  'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({'status':event.target.checked, _token:'{{csrf_token()}}'}),
                    processData: false,
                    success: function( data){
                         console.log(JSON.stringify( data ));
                         Swal.fire({
                        title: 'Done',
                        text: "Updated Time!",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                        }).then((result) => {
                            
                        })

                    },
                    error: function(errorThrown ){
                        console.log( errorThrown );
                    }
                });
    }
    </script>
 
@endpush






