@extends('layouts.adminbsb')
@section('title')
    Data Wanita Usia Subur
@endsection
@section('style')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="{{asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
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
                            <!-- <form id="form-filter" action="{{route('responden-anak')}}" method="get"> -->
                                <h6>Filter Desa</h6>
                                <select class="form-control select-desa show-tick" name="alamat">                                
                                    <option id="semua" value="semua">Semua Desa</option>
                                    <option id="Balongrejo" value="Balongrejo">Balongrejo</option>
                                    <option id="Bendungrejo" value="Bendungrejo">Bendungrejo</option>
                                    <option id="Berbek" value="Berbek">Berbek</option>
                                    <option id="Bulu" value="Bulu">Bulu</option>
                                    <option id="Cepoko" value="Cepoko">Cepoko</option>
                                    <option id="Grojogan" value="Grojogan">Grojogan</option>
                                    <option id="Kacangan" value="Kacangan">Kacangan</option>
                                    <option id="Maguan" value="Maguan">Maguan</option>
                                    <option id="Mlilir" value="Mlilir">Mlilir</option>
                                    <option id="Ngrawan" value="Ngrawan">Ngrawan</option>
                                    <option id="Patranrejo" value="Patranrejo">Patranrejo</option>
                                    <option id="Salamrojo" value="Salamrojo">Salamrojo</option>
                                    <option id="Semare" value="Semare">Semare</option>
                                    <option id="Sendangbumen" value="Sendangbumen">Sendangbumen (Sendang Bumen)</option>
                                    <option id="Sengkut" value="Sengkut">Sengkut</option>
                                    <option id="Sonopatik" value="Sonopatik">Sonopatik (Sono Patik)</option>
                                    <option id="Sumberurip" value="Sumberurip">Sumberurip (Sumber Urip)</option>
                                    <option id="Sumberwindu" value="Sumberwindu">Sumberwindu</option>
                                    <option id="Tiripan" value="Tiripan">Tiripan</option>
                                </select>
                                <br><br>
                                <h6>Filter Bulan</h6>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select class="form-control select-bulan show-tick" name="bulan">                                
                                            <option id="semua" value="semua">Semua Bulan</option>
                                            <option id="01" value="01">Januari</option>
                                            <option id="02" value="02">Februari</option>
                                            <option id="03" value="03">Maret</option>
                                            <option id="04" value="04">April</option>
                                            <option id="05" value="05">Mei</option>
                                            <option id="06" value="06">Juni</option>
                                            <option id="07" value="07">Juli</option>
                                            <option id="08" value="08">Agustus</option>
                                            <option id="09" value="09">September</option>
                                            <option id="10" value="10">Oktober</option>
                                            <option id="11" value="11">November</option>
                                            <option id="12" value="12">Desember</option>                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" name="tahun" id="input-tahun" class="form-control" placeholder="Tahun" />
                                        </div>
                                    </div>
                                </div>
                                <button id="btn-submit" class="btn btn-block btn-lg bg-green waves-effect">TERAPKAN</button>
                            <!-- </form>                             -->
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
                                            <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#modal-riwayat" onclick="getRiwayat('{{$d->nama_responden}}', '{{$d->alamat_responden}}')">Riwayat</button>                                            
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
    <!-- Modal Dialogs ====================================================================================================================== -->
        <!-- Modal hapus -->
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

        <!-- Modal riwayat -->
        <div class="modal fade" id="modal-riwayat" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Riwayat <span id="nama-responden"></span></h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>                                        
                                        <th>Penyebab</th>
                                        <th>Surveyor</th>
                                        <th>Tanggal Survey</th>                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Penyebab</th>
                                        <th>Surveyor</th>
                                        <th>Tanggal Survey</th>
                                    </tr>
                                </tfoot>
                                <tbody id="tbody-riwayat">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">                        
                        <!-- <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tidak</button>
                        <button type="button" class="btn btn-danger waves-effect hapus-btn">Ya</button>                         -->
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
    
    <!-- Select Plugin Js -->
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

    <script src="{{asset('js/pages/forms/basic-form-elements.js')}}"></script>

    <!-- Autosize Plugin Js -->
    <script src="{{asset('plugins/autosize/autosize.js')}}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{asset('plugins/momentjs/moment.js')}}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>


    <script>                
        if(window.location.href == "{{url('/responden/wus/filtered')}}" || window.location.href == "{{url('/responden/wus/filtered/semua')}}") {
            window.location.href = "{{url('/responden/wus')}}"                
        }
    
        $('#toggle-skrining').addClass('active');
        $('#skrining-wus').addClass('active');        

        var idSkrining;
        
        const path = window.location.pathname.split('/');        
        if (path[4]!=undefined) {
            var selectorDesa = path[4].includes('%20') ? path[4].split('%20')[0] : path[4]            
        }
        console.log(selectorDesa);
        
        $(`#${selectorDesa}`).attr('selected', 'selected');
        $(`#${path[6]}`).attr('selected', 'selected');
        $('#input-tahun').val(path[5]);        

        function confirmHapus(id) {
            idSkrining = id
        }

        $('#btn-submit').on('click', function(e) {
            console.log('clicked!');
            
            let url = "{{url('/responden/wus')}}"
            let desa = $('.filter-option')[0].innerText;
            let bulan = $('.filter-option')[1].innerText;            
            let tahun = $('#input-tahun').val();

            if (bulan==='Januari') {
                bulan = '01'
            } else if (bulan==='Februari') {
                bulan = '02'
            } else if (bulan==='Maret') {
                bulan = '03'
            } else if (bulan==='April') {
                bulan = '04'
            } else if (bulan==='Mei') {
                bulan = '05'
            } else if (bulan==='Juni') {
                bulan = '06'
            } else if (bulan==='Juli') {
                bulan = '07'
            } else if (bulan==='Agustus') {
                bulan = '08'
            } else if (bulan==='September') {
                bulan = '09'
            } else if (bulan==='Oktober') {
                bulan = '10'
            } else if (bulan==='November') {
                bulan = '11'
            } else if (bulan==='Desember') {
                bulan = '12'
            }

            url = `${url}/filtered`           
            
            if (desa!='Semua Desa') {
                url = `${url}/${desa}`                                
            } else {
                url = `${url}/semua`
            }
            if (tahun!=null && tahun != undefined && tahun!="") {
                url = `${url}/${tahun}`

                if (bulan!='Semua Bulan') {
                url = `${url}/${bulan}`
                } else {
                    url = `${url}/semua`
                }
            }

            window.location.href = url;
            
        })

        function getRiwayat(nama, alamat) {
            $('#tbody-riwayat').empty();
            $('#nama-responden').text(nama);
            console.log(`${nama}, ${alamat}, url: {{url('/responden/riwayat')}}`);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{url("responden/riwayat")}}',
                method: 'GET',
                data: {
                    nama: nama,
                    alamat: alamat
                },
                success: (result) => {                    
                    console.log(result.data);
                    result.data.forEach(data => {
                        $('#tbody-riwayat').append(
                            `<tr><td>${data.hasil_kuesioner}</td><td>${data.surveyor}</td><td>${data.created_at}</td></tr>`                            
                        )
                    });
                },
                error: (err) => {
                    console.log(err.responseJSON);
                }
            })
        }

        $('.hapus-btn').on('click', function(){
            $('#form'+idSkrining).submit();
        })        
    </script>
@endsection