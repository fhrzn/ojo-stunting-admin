@extends('layouts.adminbsb')
@section('title')
    Dashboard
@endsection
@section('style')
    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />    
@endsection
@section('index')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-red">
                        <div class="icon">
                            <i class="material-icons">shopping_cart</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL DATA</div>
                            <div class="number count-to" data-from="0" data-to="{{$all}}" data-speed="1000" data-fresh-interval="20">{{$all}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-indigo">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">ANAK 0-2 TAHUN</div>
                            <div class="number count-to" data-from="0" data-to="{{$anak}}" data-speed="1000" data-fresh-interval="20">{{$anak}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-purple">
                        <div class="icon">
                            <i class="material-icons">bookmark</i>
                        </div>
                        <div class="content">
                            <div class="text">WANITA USIA SUBUR</div>
                            <div class="number count-to" data-from="0" data-to="{{$wus}}" data-speed="1000" data-fresh-interval="20">{{$wus}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-3 bg-deep-purple">
                        <div class="icon">
                            <i class="material-icons">favorite</i>
                        </div>
                        <div class="content">
                            <div class="text">IBU HAMIL</div>
                            <div class="number count-to" data-from="0" data-to="{{$ibu_hamil}}" data-speed="1500" data-fresh-interval="20">{{$ibu_hamil}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                    <div class="card">
                        <div class="header">
                            <h2>DESA PERINGKAT STUNTING</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Desa</th>
                                            <th>Total Stunting</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peringkats as $peringkat)
                                            <tr>
                                                <td>{{++$index}}</td>
                                                <td>{{$peringkat->alamat_responden}}</td>
                                                <td>{{$peringkat->total}}</td>
                                            </tr>                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
                <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="card">
                        <div class="header">
                            <h2>KADER TERAKTIF</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="pie_chart" class="flot-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
        </div>
    </section>
@endsection
@section('script')
    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>
    
    <!-- Flot Charts Plugin Js -->
    <script src="plugins/flot-charts/jquery.flot.js"></script>
    <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="plugins/flot-charts/jquery.flot.time.js"></script>
    {{-- <script src="../../js/pages/charts/flot.js"></script> --}}

    <script>
        //Widgets count
        $('.count-to').countTo();

        //Sales count to
        $('.sales-count-to').countTo({
            formatter: function (value, options) {
                return '$' + value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ' ').replace('.', ',');
            }
        });

        $(function(){
            //PIE CHART ==========================================================================================
            var pieChartData = [], pieChartSeries = 4;
            var pieChartColors = ['#E91E63', '#03A9F4', '#FFC107', '#009688'];
            var pieChartDatas = [];
            var kaderName = [];
            var kaderData = {!! json_encode($peringkatKader) !!};
            kaderData.forEach(item => {                
                pieChartDatas.push(item.total);
                kaderName.push(item.username);
            });                        

            for (var i = 0; i < pieChartSeries; i++) {                
                pieChartData[i] = {
                    label: kaderName[i],
                    data: pieChartDatas[i],
                    color: pieChartColors[i]
                }
            }
            $.plot('#pie_chart', pieChartData, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        label: {
                            show: true,
                            radius: 3 / 4,
                            formatter: labelFormatter,
                            background: {
                                opacity: 0.5
                            }
                        }
                    }
                },
                legend: {
                    show: false
                }
            });
            function labelFormatter(label, series) {
                return '<div style="font-size:8pt; text-align:center; padding:2px; color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
            }
            //====================================================================================================
        })
    </script>
    
    {{-- <script src="{{asset('js/pages/index.js')}}"></script>     --}}
    {{-- <script>
        $(function () {
            //Widgets count
            $('.count-to').countTo();

            //Sales count to
            $('.sales-count-to').countTo({
                formatter: function (value, options) {
                    return '$' + value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ' ').replace('.', ',');
                }
            });

            initRealTimeChart();
            initDonutChart();
            initSparkline();
        });

        var realtime = 'on';
        function initRealTimeChart() {
            //Real time ==========================================================================================
            var plot = $.plot('#real_time_chart', [getRandomData()], {
                series: {
                    shadowSize: 0,
                    color: 'rgb(0, 188, 212)'
                },
                grid: {
                    borderColor: '#f3f3f3',
                    borderWidth: 1,
                    tickColor: '#f3f3f3'
                },
                lines: {
                    fill: true
                },
                yaxis: {
                    min: 0,
                    max: 100
                },
                xaxis: {
                    min: 0,
                    max: 100
                }
            });

            function updateRealTime() {
                plot.setData([getRandomData()]);
                plot.draw();

                var timeout;
                if (realtime === 'on') {
                    timeout = setTimeout(updateRealTime, 320);
                } else {
                    clearTimeout(timeout);
                }
            }

            updateRealTime();

            $('#realtime').on('change', function () {
                realtime = this.checked ? 'on' : 'off';
                updateRealTime();
            });
            //====================================================================================================
        }

        function initSparkline() {
            $(".sparkline").each(function () {
                var $this = $(this);
                $this.sparkline('html', $this.data());
            });
        }

        function initDonutChart() {
            Morris.Donut({
                element: 'donut_chart',
                data: [{
                    label: 'Chrome',
                    value: 37
                }, {
                    label: 'Firefox',
                    value: 30
                }, {
                    label: 'Safari',
                    value: 18
                }, {
                    label: 'Opera',
                    value: 12
                },
                {
                    label: 'Other',
                    value: 3
                }],
                colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)', 'rgb(96, 125, 139)'],
                formatter: function (y) {
                    return y + '%'
                }
            });
        }

        var data = [], totalPoints = 110;
        function getRandomData() {
            if (data.length > 0) data = data.slice(1);

            while (data.length < totalPoints) {
                var prev = data.length > 0 ? data[data.length - 1] : 50, y = prev + Math.random() * 10 - 5;
                if (y < 0) { y = 0; } else if (y > 100) { y = 100; }

                data.push(y);
            }

            var res = [];
            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]]);
            }

            return res;
        }
    </script> --}}

    <script>
        $('#dashboard').addClass('active');
        $('#sctn-body').remove();
        
    </script>
@endsection