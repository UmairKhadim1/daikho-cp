@extends('layouts.backend.app')
@section('title','Series')
@push('css')
    <link href="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
    rel="stylesheet">
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
                                ALL Series
                                <span class="badge bg-red">{{count($series) }}</span>
                            </h2>
                           
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" >
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>TITLE</th>
                                           
                                         
                                            
                                            <th>SEASONS</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>TITLE</th>
                                          
                                            
                                            
                                            <th>SEASONS</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($series as $key=>$ser)
                                            
                                     
                                         <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $ser->series_name }}</td>
                                            
                                           
                                            
                                            <td>
                                                @if ($ser->ids != " ")
                                                @foreach(explode(',', $ser->ids) as $key=>$season) 
                                                <a href="{{route('season',[$ser->series_id,$season,$key+1])}}">Season {{$key+1}}</a> <br>
                                               
                                                @endforeach
                                                
                                                @else 
                                                <p>No season</p>
                                                @endif
                                                
                                              
                                               
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

 
@endpush






