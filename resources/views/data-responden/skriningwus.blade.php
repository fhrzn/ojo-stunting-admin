@extends('layouts.adminbsb')
@section('title')
    Data Wanita Usia Subur
@endsection
@section('style')
    <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endsection
@section('body')
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        HASIL SKRINING WANITA USIA SUBUR
                    </h2>                                        
                </div>
                <div class="body">
                    @include('layouts.partials.alert')
                    <div class="row clearfix">                        
                        <div class="col-sm-12">                            
                            <h6>Filter</h6>
                            <select class="form-control show-tick">                                
                                <option value="semua">Semua Desa</option>
                                <option value="Balongrejo">Balongrejo</option>
                                <option value="Bendungrejo">Bendungrejo</option>
                                <option value="Berbek">Berbek</option>
                                <option value="Bulu">Bulu</option>
                                <option value="Cepoko">Cepoko</option>
                                <option value="Grojogan">Grojogan</option>
                                <option value="Kacangan">Kacangan</option>
                                <option value="Maguan">Maguan</option>
                                <option value="Mlilir">Mlilir</option>
                                <option value="Ngrawan">Ngrawan</option>
                                <option value="Patranrejo">Patranrejo</option>
                                <option value="Salamrojo">Salamrojo</option>
                                <option value="Semare">Semare</option>
                                <option value="Sendangbumen">Sendangbumen (Sendang Bumen)</option>
                                <option value="Sengkut">Sengkut</option>
                                <option value="Sonopatik">Sonopatik (Sono Patik)</option>
                                <option value="Sumberurip">Sumberurip (Sumber Urip)</option>
                                <option value="Sumberwindu">Sumberwindu</option>
                                <option value="Tiripan">Tiripan</option>
                            </select>
                            <button type="button" class="btn btn-block btn-lg bg-green waves-effect">TERAPKAN</button>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Penyebab</th>
                                    <th>Surveyor</th>
                                    <th>Tanggal Survey</th>  
                                    <th>Aksi</th>                                  
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Penyebab</th>
                                    <th>Surveyor</th>
                                    <th>Tanggal Survey</th>    
                                    <th>Aksi</th>                                
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{$d->nama_responden}}</td>
                                        <td>{{$d->alamat_responden}}</td>
                                        <td>{!!$d->hasil_kuesioner!!}</td>
                                        <td>{{$d->username}}</td>
                                        <td>{{$d->created_at}}</td>
                                        <td>                                            
                                            <button type="button" class="btn btn-danger waves-effect" data-toggle="modal" data-target="#deleteModal" onclick="confirmHapus({{$d->id}})">Hapus</button>
                                            <form action="{{route('responden.delete', $d->id)}}" method="post" id="form{{$d->id}}">
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
                        <h4 class="modal-title" id="defaultModalLabel">Apakah anda yakin mau data ini ?</h4>
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
    <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <script src="../../js/pages/tables/jquery-datatable.js"></script>
    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <script>
        $('#toggle-skrining').addClass('active');
        $('#skrining-wus').addClass('active');

        var idSkrining;

        function confirmHapus(id) {
            idSkrining = id
        }

        $('.hapus-btn').on('click', function(){
            $('#form'+idSkrining).submit();
        })
    </script>
@endsection