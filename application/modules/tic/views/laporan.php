<style>
    .keterangan
    {
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
<div class="page-heading" style="margin:0px;">
    <!-- <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-12 order-md-1 order-last">
                <h3>Laporan Masuk</h3>
                <p class="text-subtitle text-muted">Command Center meneruskan laporan permasalahan kepada ruas yang bersangkutan.</p>
            </div>
            
        </div>
    </div> -->
    <section class="section">
        <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card inf">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Laporan On-Going</h6>
                                    <h6 class="font-extrabold mb-0"><?= $info->laporan ?></h6>
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
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Formasi Petugas</h6>
                                    <h6 class="font-extrabold mb-0"><?= $info->formasi ?></h6>
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
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Formasi Standby</h6>
                                    <h6 class="font-extrabold mb-0"><?= $info->standby ?></h6>
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
                                    <h6 class="text-muted font-semibold">Formasi On-Duty</h6>
                                    <h6 class="font-extrabold mb-0"><?= $info->onduty ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                <a class="nav-link" id="sd-tab" data-bs-toggle="tab" href="#sd-panel" role="tab" aria-controls="sd-panel" aria-selected="false">Selesai Ditindak</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="bd-panel" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-hover " id="table-bd">
                                        <thead class="table-primary">
                                            <tr>
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
                                                <th>Action</th>
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
                            <div class="tab-pane fade " id="dt-panel" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-hover" id="table-dt">
                                        <thead class="table-primary">
                                            <tr>
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
                                                <th>Action</th>
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
                            <div class="tab-pane fade" id="sd-panel" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-hover " id="table-sd">
                                        <thead class="table-primary">
                                            <tr>
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
                                                <th>Action</th>
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
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tittle-modal">Assign Petugas</h5>
                        <button type="button" class="close rounded-pill"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical" id="formAssign">
                            <div class="form-body">
                                <div class="row">
                                   
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Mobile Customer Service</label>
                                            <input type="text" class="form-control" name="laporan_id" id="laporan_id" value="0" hidden>
                                            <input type="text" class="form-control" name="ruas_id" id="ruas_id" value="0" hidden>
                                            <select class="choices kendaraan form-select choices__input multiple-remove" id="cs" name="cs[]" multiple>
                                                                                                    
                                                </select>
                                            </select>
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Ambulance</label>                                
                                                <select  class="choices kendaraan form-select choices__input multiple-remove" id="ambulance" name="ambulance[]" multiple>
                                                                                 
                                                </select>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-info-vertical">Rescue</label>
                                            
                                            <select style="margin-bottom:200px;" class="choices kendaraan form-select choices__input multiple-remove" id="rescue" name="rescue[]" multiple>
                                                                                         
                                                </select>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-info-vertical">Derek</label>
                                          
                                            <select style="margin-bottom:200px;" class="choices kendaraan form-select choices__input multiple-remove" id="derek" name="derek[]" multiple>
                                                                                             
                                                </select>
                                            </select>
                                        </div>

                                    <br>
                                                                   
                                       
                                    
                                </div>
                            </div>
                           
                       
                    </div>
                    <div class="modal-footer">
                        
                        <button type="submit" id="btnSubmit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Kirim Petugas</span>
                        </button>
                        
                    </div>
                    </form>
                </div>
            </div>
        </div>
    
    </section>
    
</div>



<script>
    var ruasChoices,csoption,ambulanceoption,rescueoption,derekoption;
    var tabelbd,tabelsd,tabeldt;
$(document).ready(function() {
    
    //var tabelbd,tabelsd,tabeldt;
    //Notifikasi(3);

    csoption = new Choices('#cs',
        {
            removeItemButton: true,
            addItems : true,
        }
    );

     ambulanceoption = new Choices('#ambulance',
        {
            removeItemButton: true,
            addItems : true,
        }
    );

     rescueoption = new Choices('#rescue',
        {
            removeItemButton: true,
            addItems : true,
        }
    );

     derekoption = new Choices('#derek',
        {
            removeItemButton: true,
            addItems : true,
        }
    );

    $('a[href="#bd-panel"]').on('shown.bs.tab', function (e) {
        //console.log("tab0");
        $('.notif').text('');
    });

    $('a[href="#dt-panel"]').on('shown.bs.tab', function (e) {
        console.log("tab1");
        //Notifikasi(1);
    });

    $('a[href="#sd-panel"]').on('shown.bs.tab', function (e) {
        console.log("tab2");
        //Notifikasi();
    });

   

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
				"url": base_url+"tic/ajax_list_laporan_tic_bd",
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

                    if( (data[11]=='Laporan Selesai Ditindak Oleh Petugas') || (data[11]=='Laporan Selesai Tanpa Ditindak oleh Petugas'))
                    {
                        $(row).removeClass('table-light');
                        $(row).removeClass('table-warning');
                        $(row).removeClass('table-danger');
                        $(row).addClass('table-success');
                    }

            },
			"columnDefs": [
				{
					"targets": [0,1,2,3,4,5,6,7,8,9,10,11,12], 
                    "className": '',
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
					"targets": [13,14,15,16,17,18],
                    "visible": false,
                    "orderable":false,
                    "searchable": false,
				},
                
               
			],
            "columns": [
                    { "width": "1%" },
                    { "width": "8%" },
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
            ],
            "lengthMenu":[
				[10,100,-1],[10,100,"All"]
			],
            "initComplete": function () {
                        setInterval(function () {
                            childRowsBD = tabelbd.rows($('.shown'));
                            var  rows = tabelbd.page.info().recordsDisplay;
                            //console.log(rows);
                            tabelbd.ajax.reload( function () {
                                var  rows2 = tabelbd.page.info().recordsDisplay;                            
                                //console.log(rows2);
                                if(rows2>rows) {
                                    var jumlah=rows2-rows;
                                    notif(jumlah+' Data Baru Masuk');
                                    Notifikasi(jumlah);
                                    setOnline();
                                }
                            } );


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
				"url": base_url+"tic/ajax_list_laporan_tic_dt",
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

                    if( (data[11]=='Laporan Selesai Ditindak Oleh Petugas') || (data[11]=='Laporan Selesai Tanpa Ditindak oleh Petugas'))
                    {
                        $(row).removeClass('table-light');
                        $(row).removeClass('table-warning');
                        $(row).removeClass('table-danger');
                        $(row).addClass('table-success');
                    }

            },
			"columnDefs": [
				{
					"targets": [0,1,2,3,4,5,6,7,8,9,10,11,12], //first column / numbering column
                    "className": '',
					"orderable": false, //set not orderable
				},
                {
					"targets": [0], //first column / numbering column
                    "className": 'dt-control',
                    "data": null,
					"orderable": false, //set not orderable
                    "defaultContent": '',
				},
                {
                    "targets": [13,14,15,16,17,18], //first column / numbering column
                    "visible": false,
                    "orderable":false,
                    "searchable": false,
                },
                
               
			],
            "columns": [
                    { "width": "1%" },
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
            ],
            "lengthMenu":[
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
				"url": base_url+"tic/ajax_list_laporan_tic_sd",
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

                    //console.log(data[11]);
                    if( (data[11]=='Selesai Ditindak') || (data[11]=='Selesai Tanpa Ditindak'))
                    {
                        $(row).removeClass('table-light');
                        $(row).removeClass('table-warning');
                        $(row).removeClass('table-danger');
                        $(row).addClass('table-success');
                    }

            },
			"columnDefs": [
				{
					"targets": [0,1,2,3,4,5,6,7,8,9,10,11,12], //first column / numbering column
                    "className": '',
					"orderable": false, //set not orderable
				},
                {
					"targets": [0], //first column / numbering column
                    "className": 'dt-control',
                    "data": null,
					"orderable": false, //set not orderable
                    "defaultContent": '',
				},
                {
					"targets": [12,13,14,15,16,17,18], //first column / numbering column
                    "visible": false,
                    "orderable":false,
                    "searchable": false,
				},
                {
                    "targets": [0],
                    "width": "20%"
                }
               
			], 
            "columns": [
                    { "width": "1%" },
                    { "width": "8%" },
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    null
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

    function format(data) {
        
        console.log(data);
        var formasi=data[19];
        var size = Object.keys(formasi).length;
        var res='';
        for (var item in formasi) {
            res +='<tr style="text-align: center;"  class="table-light">';
            res +='<td>'+formasi[item].jenis_kendaraan+'</td>';
            res +='<td>'+formasi[item].kendaraan_nomor+'</td>';
            res +='<td>'+formasi[item].nama_petugas1+' ('+formasi[item].npp_petugas1+')</td>';
            res +='<td>'+formasi[item].nama_petugas2+' ('+formasi[item].npp_petugas2+')</td>';
            res +='</tr>';
        }

        return (
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
        console.log(row.data());
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

    $("#formAssign").submit(function(e){
        e.preventDefault();
        //console.log('ok');
        var url = base_url + '/tic/assignFormasi';
        var formData = new FormData($("#formAssign")[0]);

        for (var pair of formData.entries()) {
            console.log(pair[0]+ ', ' + pair[1]); 
            console.log('ok'); 
        } 
        

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
                console.log(response);               
                if(response)
                {
                
                    Swal.fire(
                    'Berhasil',
                    'Laporan telah berhasil ditugaskan',
                    'success'
                    );
                }

                $('#table-bd').DataTable().ajax.reload();
                $('#table-dt').DataTable().ajax.reload();
                $('#table-sd').DataTable().ajax.reload();
                
            }

        });

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
    
});

function assignRuas(ruas,id)
{
    //console.log(ruas,id);
    $('#formAssign')[0].reset();
   
    csoption.clearStore();
    ambulanceoption.clearStore();
    rescueoption.clearStore();
    derekoption.clearStore();
   
    var url = base_url + '/tic/getKendaraanAvailable';
        
    $.ajax({
        url: url,
        method: "POST",
        data: {ruas:ruas},
        beforeSend: function() {
            $('#add-edit-laporan-modal').modal('hide');    
            $('.loading').show();      
        },
        success: function(response) {
            
            response=JSON.parse(response);
            //console.log(response);
            
            if(response.ambulance.length!=0)
            {
                const list_finish=[];
                var data =response.ambulance;

                for (var row of data) 
                {
                    var list={};
                    list["value"]=row.kendaraan_id;   
                    list["label"]=row.kendaraan_nomor;   
                    list["selected"]=false;   
                    list_finish.push(list);

                }

                ambulanceoption.setChoices(list_finish);

            }

            if(response.derek.length!=0)
            {
                const list_finish=[];
                var data =response.derek;

                for (var row of data) 
                {
                    var list={};
                    list["value"]=row.kendaraan_id;   
                    list["label"]=row.kendaraan_nomor;   
                    list["selected"]=false;   
                    list_finish.push(list);

                }

                derekoption.setChoices(list_finish);
            }

            if(response.cs.length!=0)
            {
                const list_finish=[];
                var data =response.cs;

                for (var row of data) 
                {
                    var list={};
                    list["value"]=row.kendaraan_id;   
                    list["label"]=row.kendaraan_nomor;   
                    list["selected"]=false;   
                    list_finish.push(list);

                }

                csoption.setChoices(list_finish);
            }

            if(response.rescue.length!=0)
            {
                const list_finish=[];
                var data =response.rescue;

                for (var row of data) 
                {
                    var list={};
                    list["value"]=row.kendaraan_id;   
                    list["label"]=row.kendaraan_nomor;   
                    list["selected"]=false;   
                    list_finish.push(list);

                }

                rescueoption.setChoices(list_finish);
            }

            $('.notif').text('');

        }

    });

    $('#ruas_id').val(ruas);   
    $('#laporan_id').val(id);
    $('.loading').hide();     
    $('#add-edit-laporan-modal').modal('show');
    
}

function reAssignPetugas(ruas,id)
{
    console.log(ruas,id);
   
    csoption.clearStore();
    ambulanceoption.clearStore();
    rescueoption.clearStore();
    derekoption.clearStore();

    var url = base_url + '/tic/getKendaraanAvailable'; 
    $.ajax({
        url: url,
        method: "POST",
        data: {ruas:ruas},
        beforeSend: function() {
            $('#add-edit-laporan-modal').modal('hide');    
            $('.loading').show();      
        },
        success: function(response) {
            response=JSON.parse(response);
            
            if(response.ambulance.length!=0)
            {
                const list_finish=[];
                var data =response.ambulance;

                for (var row of data) 
                {
                    var list={};
                    list["value"]=row.kendaraan_id;   
                    list["label"]=row.kendaraan_nomor;   
                    list["selected"]=false;   
                    list_finish.push(list);

                }

                ambulanceoption.setChoices(list_finish);

            }

            if(response.derek.length!=0)
            {
                const list_finish=[];
                var data =response.derek;

                for (var row of data) 
                {
                    var list={};
                    list["value"]=row.kendaraan_id;   
                    list["label"]=row.kendaraan_nomor;   
                    list["selected"]=false;   
                    list_finish.push(list);

                }

                derekoption.setChoices(list_finish);
            }

            if(response.cs.length!=0)
            {
                const list_finish=[];
                var data =response.cs;

                for (var row of data) 
                {
                    var list={};
                    list["value"]=row.kendaraan_id;   
                    list["label"]=row.kendaraan_nomor;   
                    list["selected"]=false;   
                    list_finish.push(list);

                }

                csoption.setChoices(list_finish);
            }

            if(response.rescue.length!=0)
            {
                const list_finish=[];
                var data =response.rescue;

                for (var row of data) 
                {
                    var list={};
                    list["value"]=row.kendaraan_id;   
                    list["label"]=row.kendaraan_nomor;   
                    list["selected"]=false;   
                    list_finish.push(list);

                }

                csoption.setChoices(list_finish);
            }

        }

    });

    var url = base_url + '/tic/getKendaraanExisting';
    $.ajax({
        url: url,
        method: "POST",
        data: {id:id},
        beforeSend: function() {
            $('#add-edit-laporan-modal').modal('hide');    
            $('.loading').show();      
             
        },
        success: function(response) {
            $('.loading').hide();
            var response=JSON.parse(response);
            console.log(response);
            

            // for (var item in response)
            // {
            //     console.log(item.jenis);
            // }

            for (var i = 0, l = response.length; i < l; i++) {
                var obj = response[i];
                
                if(obj.jenis==1)
                {
                    csoption.setValue([{value:obj.id, label:obj.nomor}]);
                }

                if(obj.jenis==2)
                {
                    ambulanceoption.setValue([{value:obj.id, label:obj.nomor}]);
                }

                if(obj.jenis==3)
                {
                    rescueoption.setValue([{value:obj.id, label:obj.nomor}]);
                }       
                
                if(obj.jenis==4)
                {
                    derekoption.setValue([{value:obj.id, label:obj.nomor}]);
                }

            }
            
            // if(response.kendaraan_assigned != null)
            // {
            //     var data=JSON.parse(response.kendaraan_assigned);                
            //     const list_finish=[];
            //     var data =response.kendaraan_assigned;
            //     console.log('tes');
            //     console.log(data);
            //     $('#assigned').val(response.kendaraan_assigned);
            //     $('#assigned_div').show();
               
            // }

              // derekoption.setValue([
            //     { value: 'One', label: 'Label One', disabled: true },

            //     ]);

            $('#laporan_id').val(id);
            $('#ruas_id').val(ruas);    
            $('#add-edit-laporan-modal').modal('show');
        }

    });

    
}

function petugasArrived(ruas,id)
{
    //console.log(ruas,id);
    Swal.fire({
        title: 'Apakah Anda Yakin ?',
        text: "Mohon Konfirmasi, Petugas Sudah Sampai Di lokasi ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Tentu',
        cancelButtonText: 'Tidak'
        }).then((result) => {
        
            if (result.isConfirmed) {


                var url = base_url + '/tic/petugasArrived';

                $.ajax({
                    url: url,
                    method: "POST",
                    data: {ruas:ruas,laporan_id:id,user_id:<?=$this->session->user_id?>},
                    beforeSend: function() {
                        $('.loading').show();         
                    },
                    success: function(response) {
                        $('.loading').hide(); 
                        //console.log(response);

                        // response=JSON.parse(response);
                    
                        if(response)
                        {
                            // $('#add-edit-laporan-modal').modal('hide');
                            // $('#btnSubmit').prop('disabled', false);
                                        
                            Swal.fire(
                            'Terimakasih',
                            'Data Petugas Telah Di Simpan',
                            'success'
                            )
                        }

                        $('#table-bd').DataTable().ajax.reload();
                        $('#table-dt').DataTable().ajax.reload();
                        $('#table-sd').DataTable().ajax.reload();
                        
                    }

                });


            }
    })
    
}

function petugasDone(ruas,id)
{
    //console.log(ruas,id);
    Swal.fire({
        title: 'Apakah Anda Yakin ?',
        text: "Mohon Konfirmasi, Laporan Telah Selesai Ditindak ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Tentu',
        cancelButtonText: 'Tidak'
        }).then((result) => {
        
            if (result.isConfirmed) {


                var url = base_url + '/tic/petugasDone';

                $.ajax({
                    url: url,
                    method: "POST",
                    data: {ruas:ruas,laporan_id:id,user_id:<?=$this->session->user_id?>},
                    beforeSend: function() {
                        $('.loading').show();     
                    },
                    success: function(response) {
                        $('.loading').hide();     
                        //console.log(response);

                        // response=JSON.parse(response);
                    
                        if(response)
                        {
                            // $('#add-edit-laporan-modal').modal('hide');
                            // $('#btnSubmit').prop('disabled', false);
                                        
                            Swal.fire(
                            'Terimakasih',
                            'Data Petugas Telah Di Simpan',
                            'success'
                            )
                        }

                        $('#table-bd').DataTable().ajax.reload();
                        $('#table-dt').DataTable().ajax.reload();
                        $('#table-sd').DataTable().ajax.reload();
                        
                    }

                });


            }
    });
    

}

function sendBlastMessage(id,no,nama,tanggal,jam,ruas,uri)
{
    var settings = {
        "url": "<?= $this->config->item('url_kata');?>",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "Authorization": "Bearer <?= $this->config->item('token');?>"
        },
        "data": JSON.stringify({
            "to": convertPhoneNumber(no),
            "recipient_type": "individual",
            "type": "template",
            "template": {
            "name": "trace_kuesioner",
            "language": {
                "policy": "deterministic",
                "code": "id"
            },
            "components": [
                {
                "type": "body",
                "parameters": [
                    {
                    "type": "text",
                    "text": nama
                    },
                    {
                    "type": "text",
                    "text": tanggal
                    },
                    {
                    "type": "text",
                    "text": jam
                    },
                    {
                    "type": "text",
                    "text": ruas
                    }
                ]
                },
                {
                "type": "button",
                "sub_type": "url",
                "index": "0",
                "parameters": [
                    {
                    "type": "text",
                    "text": uri
                    }
                ]
                }
            ]
            }
        }),
    };

    
    $.ajax(settings).done(function (response) {
        return(response);
    });
}

function convertPhoneNumber(phoneNumber) {
    if (phoneNumber.startsWith("08")) {
      return "62" + phoneNumber.slice(1);
    }
    return phoneNumber;
}



</script>