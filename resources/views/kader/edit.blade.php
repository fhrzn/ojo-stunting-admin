@extends('layouts.adminbsb')
@section('title')
    Ubah Data Kader
@endsection
@section('style')
    
@endsection
@section('body')
    <!-- Basic Validation -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>UBAH DATA KADER</h2>                    
                </div>
                <div class="body">
                    @include('layouts.partials.alert')
                    <form id="form_validation" method="POST" action="{{route('kader-update', $kader->id)}}">
                        {{ csrf_field() }}
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="username" required value="{{$kader->username}}">
                                <label class="form-label">Nama Pengguna</label>
                            </div>
                        </div>                        
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" required value="{{$kader->password}}">
                                <label class="form-label">Password</label>
                            </div>
                        </div>                        
                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Validation -->
@endsection
@section('script')
    <!-- Jquery Validation Plugin Css -->
    <script src="../../plugins/jquery-validation/jquery.validate.js"></script>
    <script src="../../js/pages/forms/form-validation.js"></script>
    <script>
        $('#toggle-kader').addClass('active');
        $('#tambah-kader').addClass('active');
    </script>
@endsection