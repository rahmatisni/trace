<?php

// var_dump('as');
?>

<style>
    .keterangan { 
        width:50%;
        table-layout: fixed;
    }

    .kendaraan { 
        width:80%;
        table-layout: fixed;
    }
    
    .table tr {
        cursor: pointer;
    }

    .bcopy{
        position: absolute;
        right: 0;
        margin-right:10px;
    }
  
    .nav-tabs {
        border: 0.1px solid;
        border-color: #f8f9fa;
    }
   
    .nav-tabs, .nav-tabs .nav-link {
        border: 0.1px solid #f2f7ff;
    }

    .nav-tabs .nav-link.active {
        border: none;
        position: relative;
        color: white;
        background-color: #1949e3;
        font-weight: 900;
    }

    .card .card-header {
        border: none;
        margin-bottom: 30px;
    }

    .card-header {
        padding: 0rem;
    }
</style>
<div style="display:none" class="loading">Loading&#8230;</div>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Permintaan Bantuan</h3>
                <p class="text-subtitle text-muted">Tiket prioritas dapat dinaikkan sampai 3 kali tingkat kenaikan.</p>
               
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <button id="addLaporan" class="btn btn-primary mb-3 mt-3 float-end">
                        <i class="fa fa-plus-circle"></i> Buat Laporan Baru</button>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">                                    
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="bd-tab" data-bs-toggle="tab" href="#bd-panel" role="tab" aria-controls="bd-panel" aria-selected="true">Belum Ditindak <span class="notif badge bg-danger"></span></a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link " id="dt-tab" data-bs-toggle="tab" href="#dt-panel" role="tab" aria-controls="dt-panel" aria-selected="true">Ditindak</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="sd-tab" data-bs-toggle="tab" href="#sd-panel" role="tab" aria-controls="sd-panel" aria-selected="true">Selesai Ditindak</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="bd-panel" role="tabpanel" aria-labelledby="bd-tab">
                            <div class="table-responsive ">
                                <table width="100%" class="table table-hover" id="table-bd">
                                    <thead class="table-primary">
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Waktu</th>
                                            <th>Pelapor</th>
                                            <th>No Hp</th>
                                            <th>Ruas</th>
                                            <th>KM</th>
                                            <th>Jalur</th>
                                            <th>Kendaraan</th>
                                            <th>No Polisi</th>
                                            <th>Kendala</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="dt-panel" role="tabpanel" aria-labelledby="dt-tab">
                            <div class="table-responsive">
                                <table width="100%" class="table table-hover " id="table-dt">
                                    <thead class="table-primary">
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Waktu</th>
                                            <th>Pelapor</th>
                                            <th>No Hp</th>
                                            <th>Ruas</th>
                                            <th>KM</th>
                                            <th>Jalur</th>
                                            <th>Kendaraan</th>
                                            <th>No Polisi</th>
                                            <th>Kendala</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="sd-panel" role="tabpanel" aria-labelledby="sd-tab">
                            <div class="table-responsive">
                                <table width="100%" class="table table-hover " id="table-sd">
                                    <thead class="table-primary">
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Waktu</th>
                                            <th>Pelapor</th>
                                            <th>No Hp</th>
                                            <th>Ruas</th>
                                            <th>KM</th>
                                            <th>Jalur</th>
                                            <th>Kendaraan</th>
                                            <th>No Polisi</th>
                                            <th>Kendala</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      


        <!-- Modal -->
        <div class="modal text-left fade" id="add-edit-laporan-modal" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tittle-modal">Tambah Permintaan Bantuan</h5>
                        <button type="button" class="close rounded-pill"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical" id="formLaporan">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-6">                                    
                                        <div class="form-group">
                                            <label for="first-name-vertical">Nama Pelapor</label>
                                            <input type="text" class="form-control" name="id" id="id" value="0" hidden>
                                            <input type="text" class="form-control" name="status_id" id="status_id" value="1" hidden>
                                            <input type="text" class="form-control" name="priority_id" id="priority_id" value="1" hidden>
                                            <input type="text" class="form-control" name="ruas_group" id="ruas_group" value="0" hidden>
                                            <input type="text" class="form-control" name="nama" id="nama" required>
                                            <p><small class="text-muted">Deskripsikan Nama Lengkap Pelapor</small>
                                        </div>
                                    
                                  
                                        <div class="form-group">
                                            <label for="email-id-vertical">No Handphone (Terhubung di Aplikasi Whatsapp)</label>
                                            <input type="text"  class="form-control" name="hp" id="hp" required>
                                            <p><small class="text-muted">Nomor Handphone dimulai dari 08 Cth. 0822XXXXX</small></p>
                                        </div>
                                    
                                  
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Jenis Kendaraan</label>
                                            <input type="text"  class="form-control" id="jenis" name="jenis" required>
                                            <p><small class="text-muted">Deskripsikan Jenis Kendaraan Cth. Toyota Avanza </small>
                                            </p>
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-info-vertical">Warna Kendaraan</label>
                                            <input type="text"  class="form-control" id="warna" name="warna" required>
                                            <p><small class="text-muted">Deskripsikan Warna Kendaraan Cth. Hitam Metalik</small>
                                            </p>
                                        </div>
                                      

                                        <div class="form-group">
                                            <label for="contact-info-vertical">No Polisi</label>
                                            <input type="text" class="form-control" name="nopol" id="nopol" required>
                                            <p><small class="text-muted">Cth. B 1234 AKL</small>
                                        </p>
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-info-vertical">Jenis Kendala</label>
                                            <select class="form-select" id="kendala" name="kendala" required>
                                                <option value="" disabled="" selected="">Pilih Kendala</option>
                                                <?php 
                                                    if(count($kendalaOption)> 0)
                                                    {
                                                        foreach ($kendalaOption as $row) 
                                                        {
                                                            echo '<option value='.$row->kendala_id.'>'.$row->kendala.'</option>';
                                                        }
                                                    } 
                                                    else
                                                    {
                                                        echo'<option value="0">Data Not Found</option>';  
                                                    }
                                                ?>        
                                               
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-6">                                    
                                        <div class="form-group">
                                            <label for="first-name-vertical">Ruas</label>
                                            <select class="choices form-select choices__input" id="ruas" name="ruas" required>
                                                    <option value="" disabled="" selected="">Pilih Ruas</option>
                                                    <?php 
                                                    if(count($ruasOption)> 0)
                                                    {
                                                        foreach ($ruasOption as $row) 
                                                        {
                                                            echo '<option value='.$row->ruas_id.'>'.$row->ruas_name.'</option>';
                                                        }
                                                    } 
                                                    else
                                                    {
                                                        echo'<option value="0">Data Not Found</option>';  
                                                    }
                                                ?>                                                            
                                                </select>
                                            </select>
                                        </div>
                                    
                                  
                                        <div class="form-group">
                                            <label for="email-id-vertical">KM</label>
                                            <input type="text" class="form-control" name="km" id="km" required>
                                            <p><small class="text-muted">Cth. 10+200</small>
                                        </p>
                                        </div>
                                    
                                  
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Jalur</label>
                                            <select class="form-select" id="jalur" name="jalur" required>
                                                    <option value="" disabled="" selected="">Pilih Jalur</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                            </select>
                                            <p><small class="text-muted">Jalur A Keluar Jakarta Jalur B Menuju Jakarta</small>
                                        </p>
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-info-vertical">Keterangan :</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" rows="10"></textarea>
                                        </div>
                                                                   
                                       
                                    </div>
                                 
                                </div>
                            </div>
                       
                    </div>
                    <div class="modal-footer">
                        
                        <button type="submit" id="btnSubmit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Terbitkan</span>
                        </button>
                        <div class="cancel">
                            <button type="button" id="btnCancelLaporan" class="btn btn-dark ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Batalkan Laporan</span>
                            </button>
                        </div>
                        <div class="prioritas">
                            <button type="button" id="btnNaikPrioritas" class="btn btn-danger ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Naikkan Prioritas</span>
                            </button>
                        </div>
                       
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</div>
<script>
     var tabelbd,tabelsd,tabeldt;

$( document ).ready(function() {
  
    const ruasChoices = new Choices($('#ruas')[0]);

    tabelbd = $('#table-bd').DataTable({
			"processing": false, 	 
			"serverSide": true,
			"order": [],
			"oLanguage": {
				sZeroRecords: "<center>Data tidak ditemukan</center>",
				sLengthMenu: "Tampilkan _MENU_ data   ",
				sSearch: "Cari data:",
				sInfo: "Menampilkan: _START_ - _END_ dari total : _TOTAL_ data",
				oPaginate: {
					sFirst: "Awal", "sPrevious": "Sebelumnya",
					sNext: "Selanjutnya", "sLast": "Akhir"
				},
			},
            "fnDrawCallback": function () {
				//$('#loading-body').hide();
			},	
			"ajax": {
				"url": base_url+"cso/ajax_list_laporan_cso_bd",
				"type": "POST",
				"data": function (data) {	
                      
				},
                "error": function(jqXHR, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
                }
			},
            "createdRow": function(row, data, index) {

                    //custom priority colour
                    switch(data[0])
                    {
                        case '1' :
                            $(row).addClass('table-light');
                        break;
                        case '2' :
                            $(row).addClass('table-warning');
                        break;
                        case '3' :
                            $(row).addClass('table-danger');
                        break;
                    }
                    
                    if( (data[12]=='Selesai Ditindak') || (data[12]=='Selesai Tanpa Ditindak'))
                    {
                        $(row).removeClass('table-light');
                        $(row).removeClass('table-warning');
                        $(row).removeClass('table-danger');
                        $(row).addClass('table-success');
                    }

            },
            "columns": [
                { "width": "1%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "10%" },
                { "width": "9%" },
                { "width": "5%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "11%" },
                { "width": "8%" }
              
               
            ],
			"columnDefs": [
				{
					"targets": [0,1,2,3,4,5,6,7,8,9,10,11,12], 
                    "className": 'text-center no-wrap',
					"orderable": false, 
				},
                {
					"targets": [0], 
                    "className": 'dt-control',
                    "data": null,
					"orderable": false,
                    "defaultContent": '',
				},
                {
					"targets": [11], 
                    "className": 'dt-ket',
					"orderable": false,
                    "defaultContent": '',
				},
                {
					"targets": [1,13,14,15,16,17,18],
                    "visible": false,
                    "orderable":false,
                    "searchable": false,
				},
               
			],"lengthMenu":[
				[10,100,-1],[10,100,"All"]
			],
            "initComplete": function () {
                setInterval(function () {
                    childRowsBD = tabelbd.rows($('.shown'));
                    tabelbd.ajax.reload(null, false);
                    setOnline();
                }, 3000);
            }

	});

    tabeldt = $('#table-dt').DataTable({
			"processing": false, 	 
			"serverSide": true,
			"order": [],
			"oLanguage": {
				sZeroRecords: "<center>Data tidak ditemukan</center>",
				sLengthMenu: "Tampilkan _MENU_ data   ",
				sSearch: "Cari data:",
				sInfo: "Menampilkan: _START_ - _END_ dari total : _TOTAL_ data",
				oPaginate: {
					sFirst: "Awal", "sPrevious": "Sebelumnya",
					sNext: "Selanjutnya", "sLast": "Akhir"
				},
			},
            "fnDrawCallback": function () {
				//$('#loading-body').hide();
			},	
			"ajax": {
				"url": base_url+"cso/ajax_list_laporan_cso_dt",
				"type": "POST",
				"data": function (data) {	
                      
				},
                "error": function(jqXHR, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
                }
			},
            "createdRow": function(row, data, index) {

                    //custom priority colour
                    switch(data[0])
                    {
                        case '1' :
                            $(row).addClass('table-light');
                        break;
                        case '2' :
                            $(row).addClass('table-warning');
                        break;
                        case '3' :
                            $(row).addClass('table-danger');
                        break;
                    }
                    
                    if( (data[12]=='Selesai Ditindak') || (data[12]=='Selesai Tanpa Ditindak'))
                    {
                        $(row).removeClass('table-light');
                        $(row).removeClass('table-warning');
                        $(row).removeClass('table-danger');
                        $(row).addClass('table-success');
                    }

            },
            "columns": [
                { "width": "1%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "10%" },
                { "width": "9%" },
                { "width": "5%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "11%" },
                { "width": "8%" }
              
               
            ],
			"columnDefs": [
				{
					"targets": [0,1,2,3,4,5,6,7,8,9,10,11,12], 
                    "className": 'text-center no-wrap',
					"orderable": false, 
				},
                {
					"targets": [0], 
                    "className": 'dt-control',
                    "data": null,
					"orderable": false,
                    "defaultContent": '',
				},
                {
					"targets": [11], 
                    "className": 'dt-ket',
					"orderable": false,
                    "defaultContent": '',
				},
                {
					"targets": [1,13,14,15,16,17,18],
                    "visible": false,
                    "orderable":false,
                    "searchable": false,
				},
               
			],"lengthMenu":[
				[10,100,-1],[10,100,"All"]
			],
            "initComplete": function () {
                setInterval(function () {
                    childRowsDT = tabeldt.rows($('.shown'));
                    tabeldt.ajax.reload(null, false);
                    setOnline();
                }, 3000);
            }

	});

    tabelsd = $('#table-sd').DataTable({
			"processing": false, 	 
			"serverSide": true,
			"order": [],
			"oLanguage": {
				sZeroRecords: "<center>Data tidak ditemukan</center>",
				sLengthMenu: "Tampilkan _MENU_ data   ",
				sSearch: "Cari data:",
				sInfo: "Menampilkan: _START_ - _END_ dari total : _TOTAL_ data",
				oPaginate: {
					sFirst: "Awal", "sPrevious": "Sebelumnya",
					sNext: "Selanjutnya", "sLast": "Akhir"
				},
			},
            "fnDrawCallback": function () {
				//$('#loading-body').hide();
			},	
			"ajax": {
				"url": base_url+"cso/ajax_list_laporan_cso_sd",
				"type": "POST",
				"data": function (data) {	
                      
				},
                "error": function(jqXHR, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
                }
			},
            "createdRow": function(row, data, index) {

                    //custom priority colour
                    switch(data[0])
                    {
                        case '1' :
                            $(row).addClass('table-light');
                        break;
                        case '2' :
                            $(row).addClass('table-warning');
                        break;
                        case '3' :
                            $(row).addClass('table-danger');
                        break;
                    }
                    
                    if( (data[12]=='Selesai Ditindak') || (data[12]=='Selesai Tanpa Ditindak'))
                    {
                        $(row).removeClass('table-light');
                        $(row).removeClass('table-warning');
                        $(row).removeClass('table-danger');
                        $(row).addClass('table-success');
                    }

            },
            "columns": [
                { "width": "1%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "10%" },
                { "width": "9%" },
                { "width": "5%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "8%" },
                { "width": "11%" },
                { "width": "8%" }
              
               
            ],
			"columnDefs": [
				{
					"targets": [0,1,2,3,4,5,6,7,8,9,10,11,12], 
                    "className": 'text-center no-wrap',
					"orderable": false, 
				},
                {
					"targets": [0], 
                    "className": 'dt-control',
                    "data": null,
					"orderable": false,
                    "defaultContent": '',
				},
                {
					"targets": [11], 
                    "className": 'dt-ket',
					"orderable": false,
                    "defaultContent": '',
				},
                {
					"targets": [1,13,14,15,16,17,18],
                    "visible": false,
                    "orderable":false,
                    "searchable": false,
				},
               
			],"lengthMenu":[
				[10,100,-1],[10,100,"All"]
			],
            "initComplete": function () {
                setInterval(function () {
                    childRowsSD = tabelsd.rows($('.shown'));
                    tabelsd.ajax.reload(null, false);
                    setOnline();
                }, 3000);
            }

	});
   

    $('a[href="#bd-panel"]').on('shown.bs.tab', function (e) {
        console.log("tab0");
        //$('.notif').text('');
    });

    $('a[href="#dt-panel"]').on('shown.bs.tab', function (e) {
        console.log("tab1");
        //Notifikasi(1);
    });

    $('a[href="#sd-panel"]').on('shown.bs.tab', function (e) {
        console.log("tab2");
        //Notifikasi();
    });

    function format(data) {
        
        //console.log(data);
        var formasi=data[19];
        var size = Object.keys(formasi).length;
        var res='';
        var clipboard=data[5]+'|'+data[6]+'|'+data[7]+'|'+data[8]+'|'+data[9]+'|'+data[3]+'|'+data[4]+'|'+data[10];
        for (var item in formasi) {
            res +='<tr style="text-align: center;"  class="table-light">';
            res +='<td>'+formasi[item].jenis_kendaraan+'</td>';
            res +='<td>'+formasi[item].kendaraan_nomor+'</td>';
            res +='<td>'+formasi[item].nama_petugas1+' ('+formasi[item].npp_petugas1+')</td>';
            res +='<td>'+formasi[item].nama_petugas2+' ('+formasi[item].npp_petugas2+')</td>';
            res +='</tr>';
        }

        return (
            '<div class="bcopy"><button type="button" class="rocket btn btn-outline-dark " onClick="copyLaporan(`'+clipboard+'`)">Copy</button></div>'+
            '<table class="table keterangan table-bordered table-light">'+
                        '<tr class="table-dark">'+
                            '<th colspan="3" style="text-align: center;" >Priority Status</th>'+                           
                        '</tr>'+       
                       
                        '<tr class="table-light">'+
                            '<td >Priority Normal By</td>'+
                            '<td >'+data[13]+'</td>'+
                            '<td>'+data[14]+'</td>'+
                        '</tr>'+

                        '<tr class="table-warning">'+
                            '<td >Priority Medium By</td>'+
                            '<td >'+data[15]+'</td>'+
                            '<td >'+data[16]+'</td>'+
                        '</tr>'+
                                  
                        '<tr class="table-danger">'+
                            '<td >Priority High By</td>'+
                            '<td >'+data[17]+'</td>'+
                            '<td >'+data[18]+'</td>'+
                        '</tr>'+
            '</table>'+

            '<table class="table kendaraan table-bordered table-light">'+
                        
                        '<tr class="table-dark">'+
                            '<th colspan="4" style="text-align: center;" >Formasi Petugas Assigned</th>'+                           
                        '</tr>'+  
                        
                        '<tr style="text-align: center;"  class="table-info">'+
                            '<td >Jenis</td>'+
                            '<td >Nomor</td>'+
                            '<td >Petugas 1</td>'+
                            '<td >Petugas 2</td>'+
                        '</tr>'+res+


                                  
                        
            '</table>'
        );
    }

    $('#table-bd tbody').on('click', 'td.dt-control', function () {
        //console.log('child row');
        var tr = $(this).closest('tr');
        var row = tabelbd.row(tr);
        //console.log(row.data());
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(tabelbd.row( this ).data())).show();
            tr.addClass('shown');
        }

        //console.log('td');
    });

    $('#table-dt tbody').on('click', 'td.dt-control', function () {
        //console.log('child row');
        var tr = $(this).closest('tr');
        var row = tabeldt.row(tr);
        //console.log(row.data());
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(tabeldt.row( this ).data())).show();
            tr.addClass('shown');
        }

        //console.log('td');
    });

    $('#table-sd tbody').on('click', 'td.dt-control', function () {
        //console.log('child row');
        var tr = $(this).closest('tr');
        var row = tabelsd.row(tr);
        //console.log(row.data());
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(tabelsd.row( this ).data())).show();
            tr.addClass('shown');
        }

        //console.log('td');
    });

    var childRowsBD = null;
    tabelbd.on('draw', function () {
        //console.log('draw BD');
                // If reloading table then show previously shown rows
        if (childRowsBD) {

            childRowsBD.every(function (rowIdx, tableLoop, rowLoop) {
                d = this.data();
                this.child(format(tabelbd.row( this ).data())).show();
                this.nodes().to$().addClass('shown');
            });

            // Reset childRows so loop is not executed each draw
            childRowsBD = null;
        }

    });

    var childRowsDT = null;
    tabeldt.on('draw', function () {
        //console.log('draw DT');
                // If reloading table then show previously shown rows
        if (childRowsDT) {

            childRowsDT.every(function (rowIdx, tableLoop, rowLoop) {
                d = this.data();
                this.child(format(tabeldt.row( this ).data())).show();
                this.nodes().to$().addClass('shown');
            });

            // Reset childRows so loop is not executed each draw
            childRowsDT = null;
        }

    });

    var childRowsSD = null;
    tabelsd.on('draw', function () {
        //console.log('draw');
                // If reloading table then show previously shown rows
        if (childRowsSD) {

            childRowsSD.every(function (rowIdx, tableLoop, rowLoop) {
                d = this.data();
                this.child(format(tabelsd.row( this ).data())).show();
                this.nodes().to$().addClass('shown');
            });

            // Reset childRows so loop is not executed each draw
            childRowsSD = null;
        }

    });

    ruasChoices.passedElement.element.addEventListener(
        'change',
        function(event) {
            var id= event.detail.value;
            var url = base_url + 'cso/getRuasGroup';

            $.ajax({
                url: url,
                method: "POST",
                data: {id:id},
                beforeSend: function() {
                    
                },
                success: function(response) {
                    var response=JSON.parse(response);
                    //console.log(response);
                    $('#ruas_group').val(response.ruas_group);
                }

            });
        },
        false,
    );

    $('#table-bd tbody').on('click', 'tr td:not(.dt-control):not(.dt-ket)', function () {
        const row=tabelbd.row( this ).data();
        //console.log(row);
        if(row==undefined){
            //console.log('data kosong');
            return false;
        }
        var waktu=row[2];
        var waktus=waktu.replace('</br>',' ');
        var hp=row[4];
        var nopol=row[9];

        var url = base_url + 'cso/getDetailLaporan';

        $.ajax({
            url: url,
            method: "POST",
            data: {waktu:waktus,hp:hp,nopol:nopol},
            beforeSend: function() {
                $('.loading').show();
            },
            success: function(response) {
                $('.loading').hide();
                response=JSON.parse(response);
                //console.log(response);
                $('#tittle-modal').text('Update Permintaan Bantuan');
                $('#id').val(response.laporan_id);
                $('#nama').val(response.laporan_name);
                $('#jenis').val(response.laporan_vehicle_category);
                $('#warna').val(response.laporan_vehicle_colour);
                $('#nopol').val(response.laporan_plat_no);
                $('#nopol').val(response.laporan_plat_no);
                $('#kendala').val(response.laporan_problem_category);
                ruasChoices.setChoiceByValue(response.laporan_ruas_id);
                $('#km').val(response.laporan_km);
                $('#jalur').val(response.laporan_jalur);
                $('#keterangan').val(response.laporan_description);
                $('#hp').val(response.laporan_phone_no);
                $('#priority_id').val(response.laporan_priority_status_id);
                $('#status_id').val(response.status_id);
              
                if((response.status_id==5)||(response.status_id==6))
                {               
                    Swal.fire(
                            'Laporan Selesai!',
                            'Laporan Telah Berhasil Diselesaikan',
                            'info'
                            );
                    return false;
                }else
                {
                    switch(response.laporan_priority_status_id)
                    {
                        
                        case '1':
                            $('.prioritas').show();
                            $('.cancel').show();
                            $('#btnNaikPrioritas').removeClass("btn-primary").removeClass("btn-danger").addClass('btn-warning');
                        break;
                        case '2':
                            $('.prioritas').show();
                            $('.cancel').show();                        
                            $('#btnNaikPrioritas').removeClass("btn-primary").removeClass("btn-warning").addClass('btn-danger');
                        break;
                        case '3':
                            $('#btnNaikPrioritas').removeClass("btn-primary").removeClass("btn-warning").addClass('btn-danger');
                            $('.prioritas').hide();
                            $('.cancel').show();
                        break;
                        
                    }

                }

                $('#btnNaikPrioritas').show();
                $('#btnSubmit').text('Update Laporan');
                $('#add-edit-laporan-modal').modal('show');
                
            }

        });

    });

    $('#addLaporan').on('click', function () {
        $('#tittle-modal').text('Tambah Permintaan Bantuan');
        $('#formLaporan')[0].reset();
        $('#btnNaikPrioritas').hide();
        $('#btnSubmit').text('Terbitkan Laporan');       
        $('#btnSubmit').prop('disabled', false);
        $('.cancel').hide();
        $('#add-edit-laporan-modal').modal('show');


    });


    $('#btnCancelLaporan').on('click', function () {

        $('#add-edit-laporan-modal').modal('hide');
        Swal.fire({
        title: 'Batalkan Laporan Masuk ?',
        text: "Mohon Konfirmasi, Untuk Membatalkan Laporan Masuk.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Batalkan',
        cancelButtonText: 'Cancel',
        allowOutsideClick: false,
        }).then((result) => {
        
            if (result.isConfirmed) {

                var url = base_url + '/cso/cancelLaporan';
                var id = $('#id').val();
                //console.log(id);
               
                $.ajax({
                    url: url,
                    method: "POST",
                    data: {laporan_id:id,user_id:<?=$this->session->user_id?>},
                    beforeSend: function() {
                        $('.loading').show();         
                    },
                    success: function(response) {
                        $('.loading').hide(); 
                        //console.log(response);
                                        
                        Swal.fire(
                            'Terimakasih',
                            'Laporan Telah Berhasil Dicancel',
                            'success'
                            )
                        

                        $('#table-bd').DataTable().ajax.reload();
                    }

                });


            }
    })

    });

    $('#btnNaikPrioritas').on('click', function () {
       
        var url = base_url + '/cso/AddOrEditLaporan';
        var pri= parseInt($('#priority_id').val());
        
        if(pri==3)
        {
            pri=1;
        }
        
        $('#priority_id').val(pri+1);

        var formData = new FormData($("#formLaporan")[0]);
    
        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#add-edit-laporan-modal').modal('hide');
                $('.loading').show();
            },
            success: function(response) {
                
                $('.loading').hide();
                response=JSON.parse(response);
               
                if(response.status)
                {
                    $('#add-edit-laporan-modal').modal('hide');
                    $('#btnSubmit').prop('disabled', false);
                    Swal.fire(
                    'Berhasil',
                    'Laporan telah berhasil di'+response.event,
                    'success'
                    );
                }

                $('#table-bd').DataTable().ajax.reload();
                
            }

        });

   });

    $("#formLaporan").submit(function(e){
        e.preventDefault();

        var url = base_url + '/cso/AddOrEditLaporan';
        var formData = new FormData($("#formLaporan")[0]);

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#add-edit-laporan-modal').modal('hide');
                $('.loading').show();
            },
            success: function(response) {
                
                $('.loading').hide();
                response=JSON.parse(response);
               
                if(response.status)
                {                    
                    Swal.fire(
                    'Berhasil',
                    'Laporan telah berhasil di'+response.event,
                    'success'
                    );
                }

                $('#table-bd').DataTable().ajax.reload();
                
            }

        });

    });

});

function showDetailKeterangan(ket)
{
    Swal.fire({
    
        html:
        '<p style="color:black;">'+ket+'</p>',
        showConfirmButton: false,
    })
}

function copyLaporan(data)
{
    var res=data.split("|");
    var result=res[0]+' : KM '+res[1]+'/'+res[2]+' .. KR '+res[3]+' .. '+res[4]+' .. '+res[5]+' '+res[6]+'(WA) '+res[7];
    //console.log(result);
    //result.slice();    
    
    navigator.clipboard.writeText(result).then(() => {
        Toastify({
            text: "Copy to Clipboard",
            duration: 2000,
            gravity:"bottom",
            position: "right",
            closePosition: "top right",
            backgroundColor: "#1f2d5a",
        }).showToast();
    },() => {
        console.error('Failed to copy');
    });



   
}
</script>