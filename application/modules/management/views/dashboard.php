<style>
.ongoing:hover { 
    background-color: #EAC117;
    cursor: pointer;
}
</style>
<div style="display:none" class="loading">Loading&#8230;</div>
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon purple">
                                    <i class="iconly-boldBookmark"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Laporan Masuk</h6>
                                <h6 class="font-extrabold mb-0"><?= $summary_top->laporan_masuk ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div onclick="laporanOngoing()" class="card ongoing">
                    <div class="card-body px-3 py-4-5">
                        <div  class="row">
                            <div class="col-md-4">
                                <div class="stats-icon blue">
                                    <i class="iconly-boldBookmark"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="lg text-muted font-semibold">Laporan On Going</h6>
                                <h6 class="font-extrabold mb-0"><?= $summary_top->laporan_ongoing ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon green">
                                    <i class="iconly-boldBookmark"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Laporan Selesai</h6>
                                <h6 class="font-extrabold mb-0"><?= $summary_top->laporan_selesai ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon red">
                                    <i class="iconly-boldBookmark"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Laporan Dibatalkan</h6>
                                <h6 class="font-extrabold mb-0"><?= $summary_top->laporan_tidak_selesai ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                 <h4>Grafik Laporan Masuk</h4>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" id="tahunGrafik">
                                    <option>2022</option>
                                    <option >2023</option>
                                    <option selected>2024</option>
                                    <option >2025</option>
                                </select>
                            </div>
                        </div>
                       
                      
                    </div>
                    <div class="card-body" style="position: relative;">
                        <div id="chart-laporan-masuk" style="min-height: 300px;"></div>
                    </div>
            
                </div>
            
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Tingkat Kepuasan Pelayanan</h4>
                    </div>
                    <div class="card-body" style="position: relative;">
                        <div id="chart-kepuasan-pelanggan" style="min-height: 300px;"></div>
                    </div>
            
                </div>
            
            </div>
            
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Blast Kuesioner Summary</h4>
                    </div>
                    <div class="card-body" style="position: relative;">
                        <div id="chart-jumlah-petugas" style="min-height: 300px;"></div>
                    </div>            
                </div>            
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Jumlah Kendaraan All Ruas</h4>
                    </div>
                    <div class="card-body" style="position: relative;">
                        <div id="chart-jumlah-kendaraan" style="min-height: 300px;"></div>
                    </div>            
                </div>            
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Jumlah Agent All Ruas</h4>
                    </div>
                    <div class="card-body" style="position: relative;">
                        <div id="chart-jumlah-agent" style="min-height: 300px;"></div>
                    </div>            
                </div>            
            </div>

            
           
            
        </div>
    </div>
    
</section>
 <!--Extra Large Modal -->
 <div class="modal fade text-left w-100" id="ongoing-modal" tabindex="-1" role="dialog" aria-labelledby="ongoing-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel16">Daftar Laporan TRACE On-going</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                        <table id="table_on_going" class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Ruas</th>
                                    <th>Nama Pelapor</th>
                                    <th>No. Hp</th>
                                    <th>KM</th>
                                    <th>Waktu</th>                                 
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="table_on_going_tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary ml-1"
                    data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$( document ).ready(function() {

    var gDataLaporanMasuk = JSON.parse(`<?php echo $summary_grafik_laporan_masuk; ?>`);
    var gDataRating = JSON.parse(`<?php echo $summary_rating_laporan_masuk; ?>`);
    var gDataBlastStatus = JSON.parse(`<?php echo $summary_blast_status; ?>`);
    var gDataPetugasAllRuas = JSON.parse(`<?php echo $summary_allruas_petugas; ?>`);
    var gDataAgentAllRuas = JSON.parse(`<?php echo $summary_allruas_agent; ?>`);
    var gDataKendaraanAllRuas = JSON.parse(`<?php echo $summary_allruas_kendaraan; ?>`);

        var options1 = {
          series: [{
          name: 'Total Laporan Masuk',
          data: gDataLaporanMasuk.data,
            }],
            chart: {
            height: 400,
            type: 'bar',
            },
            plotOptions: {
            bar: {
                borderRadius: 10,
                dataLabels: {
                position: 'top', // top, center, bottom
                },
                }
            },
            colors: [ // this array contains different color code for each data
                "rgb(67, 94, 190);"
            ],
            dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val;
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#"]
            }
            },
            
            xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            position: 'bottom',
            axisBorder: {
                show: true
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                type: 'gradient',
                gradient: {
                    colorFrom: '#D8E3F0',
                    colorTo: '#BED1E6',
                    stops: [0, 100],
                    opacityFrom: 0.4,
                    opacityTo: 0.5,
                }
                }
            },
            tooltip: {
                enabled: true,
            }
            },
            yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function (val) {
                return val + " Laporan";
                }
            }
            
            }
        };

        var options2 = {
          series: [30,20,50],
          chart: {         
          height: 420,
          type: 'pie',
            },
            labels: ['Tidak Puas', 'Puas', 'Sangat Puas'],
            responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                width: 200
                },
                legend: {
                position: 'bottom'
                }
            }
            }]
        };

        var optionsKepuasan = {
          series: gDataRating.data,
          chart: {
          type: 'donut',
        },
        labels: gDataRating.label,
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        console.log();
        var optionsBlastStatus = {
          series: [{
          data: [gDataBlastStatus[0].total_laporan, gDataBlastStatus[0].laporan_belum_dikirim, gDataBlastStatus[0].laporan_terkirim, gDataBlastStatus[0].laporan_gagal_kirim]
        }],
          chart: {
          type: 'bar',
          height: 300
        },
        plotOptions: {
          bar: {
            borderRadius: 0,
            horizontal: true,
            columnWidth: '10%',
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: ['Total Blast','Belum Dikirim','Terkirim','Gagal Kirim'],
        }
        };

        var options3 = {
          series: gDataPetugasAllRuas.data,
          chart: {
          height: 320,
          type: 'radialBar',
            },
            plotOptions: {
            radialBar: {
                dataLabels: {
                name: {
                    fontSize: '22px',
                },
                value: {
                    fontSize: '16px',
                    formatter: function(val) {
                                        return parseInt(val);
                                    },
                },
                total: {
                    show: true,
                    label: 'Total',
                    formatter: function (val) {

                        let array = gDataPetugasAllRuas.data;
                    
                        let add=0;
                        for (var i = 0; i< array.length; i++)
                        {
                            add += parseInt(array[i]);
                        }

                        return add;
                    }
                }
                }
            }
            },
            labels: ['MCS', 'Ambulance', 'Rescue', 'Derek'],
        };

        var options4 = {
            series: gDataKendaraanAllRuas.data,
            chart: {
            height: 320,
            type: 'radialBar',
            },
            plotOptions: {
            radialBar: {
                dataLabels: {
                name: {
                    fontSize: '22px',
                },
                value: {
                    fontSize: '16px',
                    formatter: function(val) {
                                        return parseInt(val);
                                    },
                },
                total: {
                    show: true,
                    label: 'Total',
                    formatter: function (w) {
                        let array = gDataKendaraanAllRuas.data;
                    
                        let add=0;
                        for (var i = 0; i< array.length; i++)
                        {
                            add += parseInt(array[i]);
                        }

                        return add;
                        
                        }
                }
                }
            }
            },
            labels: ['MCS', 'Ambulance', 'Derek', 'Rescue'],
        };

        var options5 = {
            series: gDataAgentAllRuas.data,
            chart: {
            height: 320,
            type: 'radialBar',
            },
            plotOptions: {
            radialBar: {
                dataLabels: {
                name: {
                    fontSize: '22px',
                },
                value: {
                    fontSize: '16px',
                    formatter: function(val) {
                                        return parseInt(val);
                                    },
                },
                total: {
                    show: true,
                    label: 'Total',
                    formatter: function (w) {
                        let array = gDataAgentAllRuas.data;
                    
                        let add=0;
                        for (var i = 0; i< array.length; i++)
                        {
                            add += parseInt(array[i]);
                        }

                        return add;
                    }
                }
                }
            }
            },
            labels: ['CSO', 'Command Center', 'TIC'],
        };

        var chart1 = new ApexCharts(document.querySelector("#chart-laporan-masuk"), options1);
        chart1.render();

        var chart2 = new ApexCharts(document.querySelector("#chart-kepuasan-pelanggan"), optionsKepuasan);
        chart2.render();    

        var chart3 = new ApexCharts(document.querySelector("#chart-jumlah-petugas"), optionsBlastStatus);
        chart3.render();

        var chart4 = new ApexCharts(document.querySelector("#chart-jumlah-kendaraan"), options4);
        chart4.render();

        var chart5 = new ApexCharts(document.querySelector("#chart-jumlah-agent"), options5);
        chart5.render();


        $('#tahunGrafik').on('change', function(e) {
            e.preventDefault();
            var tahun=this.value;
            var url = base_url + 'management/getSummaryGrafikLaporanMasuk';

            $.ajax({
                url: url,
                method: "POST",
                data: {tahun:tahun},
                beforeSend: function() {
                    $('.loading').show();
                },
                success: function(response) {
                    console.log(JSON.parse(response));
                   
                    var series=JSON.parse(response);
                    console.log(series.data);
                    chart1.updateSeries([{
                        data: series.data
                    }]);                       

                    $('.loading').hide();
                }

            });


        });

});

function formatTable(data)
{
    var res;

    data.map(function(item) {

       res+='<tr>'+            
                '<td>'+item.ruas_name+'</td>'+
                '<td>'+item.laporan_name+'</td>'+
                '<td>'+item.laporan_phone_no+'</td>'+
                '<td>'+item.laporan_km+'</td>'+
                '<td>'+item.laporan_created_timestamp+'</td>'+
                '<td>'+item.status_name+'</td>'+
            '</tr>';
    });

    return res; 
}


function laporanOngoing()
{
   
    var url = base_url + '/management/laporanOngoing';

    $.ajax({
        url: url,
        method: "GET",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('.loading').show();
        },
        success: function(response) {
            
            var item=JSON.parse(response);
            
            if(item.length==0)
            {
                $("#table_on_going > tbody").html("");
                $('#table_on_going').append("<tr><td style='text-align:center;' colspan='6'>Tidak Ada Data</td></tr>");
              
            }else
            {   
                $("#table_on_going > tbody").html("");
                $('#table_on_going').append(formatTable(item));
            }
                     
          
            $('#ongoing-modal').modal('show');
            $('.loading').hide();
        }

    });
}



  
    
   
// if(localStorage.sidebar == "undefined"){
//     console.log('ok');
// }
// if(localStorage.sidebar)
// {
//     console.log((Number)localStorage.sidebar);
//     //$('#sidebar').removeClass("active");
// }else
// {   
//     console.log('ya');
//     //$('#sidebar').removeClass("active");
// }



</script>
