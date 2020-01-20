@extends('layouts.adminbsb')
@section('title')
    Daftar Kader
@endsection
@section('style')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endsection
@section('body')    
    <!-- Exportable Table -->
    <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            LIST KADER
                        </h2>                                        
                    </div>
                    <div class="body">
                        @include('layouts.partials.alert')
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-basic-example">
                                <thead>
                                    <tr>
                                        <th>Username</th>                                        
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Username</th>                                        
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($kaders as $kader)
                                        <tr>
                                            <td>{{$kader->username}}</td>                                            
                                            <td>
                                                <a href="{{route('kader-edit', $kader->id)}}" type="button" class="btn btn-info waves-effect">Edit</a>
                                                <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#deleteModal" onclick="confirmHapus({{$kader->id}})">Hapus</button>
                                                <form action="{{route('kader-hapus', $kader->id)}}" method="post" id="form{{$kader->id}}">
                                                    {{method_field('DELETE')}}
                                                    {{ csrf_field() }}                                                    
                                                </form>
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

        <!-- Modal Dialogs ====================================================================================================================== -->
        <!-- Default Size -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Apakah anda yakin mau menghapus akun ini ?</h4>
                    </div>
                    <div class="modal-body">
                        Semua data yang berhubungan dengan akun ini juga akan dihapus secara permanen.
                    </div>
                    <div class="modal-footer">                        
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tidak</button>
                        <button type="button" class="btn btn-danger waves-effect hapus-btn">Ya</button>                        
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
    <script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>

    <script>
        $('#toggle-kader').addClass('active');
        $('#list-kader').addClass('active');

        var idKader;

        function confirmHapus(id) {
            idKader = id
        }

        $('.hapus-btn').on('click', function(){
            $('#form'+idKader).submit();
        })
        
    </script>
@endsection