@extends('layouts.admin')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
	<div class="row">
    <div class="col-md-12">
      <div id="container2" style="height: 400px; min-width: 310px"></div>
    </div>
	</div>
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
@endpush
@push('script')
{{-- <script src="https://code.highcharts.com/highcharts.js"></script>s --}}
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script type="text/javascript">

// $(document).ready(function() {
//     var options = {
//         credits: {
//           enabled: false
//         },
//         title: {
//             text: 'Data Bulanan Ini'
//         },
//         chart: {
//             renderTo: 'container',
//             type: 'line'
//         },
//         xAxis: {
//             categories: [{}],
//             labels: {
//               style: {
//                 // font: 'normal 10px Verdana, sans-serif'
//               }
//             },
//             title: {
//                 text: 'Tanggal'
//             }
//         },
//         yAxis: {
//             title: {
//                 text: 'Jumlah'
//             }
//         },
//         plotOptions: {
//             line: {
//                 dataLabels: {
//                     enabled: false
//                 },
//                 enableMouseTracking: false
//             }
//         },
//         series: [{}]
//     };
    
//     var url =  "{{ route('chart') }}";
//     $.getJSON(url,  function(data) {
//         options.xAxis.categories = data['tanggal'];
//         options.series[0].name = 'November';
//         options.series[0].data = data['jumlah'];
//         var chart = new Highcharts.Chart(options);
//     });
// });

$(function () {

    $.getJSON('{{ route('chart') }}', function (data) {
      console.log(data);
        // Create the chart
        Highcharts.stockChart('container2', {


            rangeSelector: {
                selected: 1
            },

            title: {
                text: 'TES PSIKOLOGI BINA ASIH'
            },

            series: [{
                name: 'Jumlah',
                data: data,
                tooltip: {
                    valueDecimals: 0
                }
            }]
        });
    });

});

  </script>
@endpush
