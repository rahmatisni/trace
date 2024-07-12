<style>
    .keterangan {
        width:50%;
        table-layout: fixed;
    }
    
    .table tr {
        cursor: pointer;
    }

   

</style>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Proses Penerusan Laporan Masuk</h3>
                <p class="text-subtitle text-muted">Command Center meneruskan laporan permasalahan kepada ruas yang bersangkutan.</p>
            </div>
            
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">                                    
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="bd-tab" data-bs-toggle="tab" href="#bd-panel" role="tab" aria-controls="bd-panel" aria-selected="true">Belum Diteruskan<span class="notif badge bg-danger">1</span></a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link " id="dt-tab" data-bs-toggle="tab" href="#dt-panel" role="tab" aria-controls="dt-panel" aria-selected="true">Diteruskan</a>
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
                                    <table width="99%" class="table table-bordered" id="table-bd">
                                        <thead class="table-dark">
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
                                    <table width="99%" class="table table-bordered" id="table-dt">
                                        <thead class="table-dark">
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
                                    <table width="99%" class="table table-bordered" id="table-sd">
                                        <thead class="table-dark">
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
                        <h5 class="modal-title" id="tittle-modal">Assign Ruas</h5>
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
                                            <label for="contact-info-vertical">Ruas</label>
                                            <input type="text" class="form-control" name="id" id="id" value="0" hidden>
                                            <select  class="choices form-select choices__input" id="ruas" name="ruas" required>
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
                                        
                                    <br>
                                                                   
                                       
                                    
                                </div>
                            </div>
                           
                       
                    </div>
                    <div class="modal-footer">
                        
                        <button type="submit" id="btnSubmit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Teruskan</span>
                        </button>
                        
                    </div>
                    </form>
                </div>
            </div>
        </div>
    
    </section>
    
</div>



<script>
    var ruasChoices;
$(document).ready(function() {
    var tabelbd,tabeldt,tabelsd;
    ruasChoices= new Choices($('#ruas')[0]);
    
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
				"url": base_url+"commandcenter/ajax_list_laporan_commandcenter_bd",
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
			"columnDefs": [
				{
					"targets": [0,1,2,3,4,5,6,7,8,9,10,11,12], //first column / numbering column
                    "className": 'text-center',
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
					"targets": [13,14,15,16,17,18],
                    "visible": false,
                    "orderable":false,
                    "searchable": false,
				}
               
			],"lengthMenu":[
				[10,100,-1],[10,100,"All"]
			],
            "initComplete": function () {
                        setInterval(function () {
                            childRowsBD = tabelbd.rows($('.shown'));
                            var  rows2 = tabelbd.page.info().recordsDisplay;    
                                    
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
				"url": base_url+"commandcenter/ajax_list_laporan_commandcenter_dt",
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
                    null
                    
            ],
			"columnDefs": [
				{
					"targets": [0,1,2,3,4,5,6,7,8,9,10,11], //first column / numbering column
                    "className": 'text-center',
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
                
               
			],"lengthMenu":[
				[10,100,-1],[10,100,"All"]
			],
            "initComplete": function () {
                        setInterval(function () {
                            childRowsDT = tabeldt.rows($('.shown'));
                            tabeldt.ajax.reload(null, false);
                            console.log('refreshing');
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
				"url": base_url+"commandcenter/ajax_list_laporan_commandcenter_sd",
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
                    null
                    
            ],
			"columnDefs": [
				{
					"targets": [0,1,2,3,4,5,6,7,8,9,10,11,12], //first column / numbering column
                    "className": 'text-center',
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
               
			],"lengthMenu":[
				[10,100,-1],[10,100,"All"]
			],
            "initComplete": function () {
                        setInterval(function () {
                            childRows = tabelsd.rows($('.shown'));
                            tabelsd.ajax.reload(null, false);
                            console.log('refreshing');
                        }, 3000);
                    }

	});

    function format(data) {
        // `d` is the original data object for the row
        console.log(data);
        return (
            '<table class="table keterangan table-bordered table-light">'+
                                 
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
        console.log('ok');
        var url = base_url + '/commandcenter/assignRuas';
        var formData = new FormData($("#formAssign")[0]);

        // for (var pair of formData.entries()) {
        //     console.log(pair[0]+ ', ' + pair[1]); 
        // }  
        // return false; 

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#btnSubmit').prop('disabled', true);
            },
            success: function(response) {
               // console.log(response);
                // response=JSON.parse(response);
               
                if(response)
                {
                    $('#add-edit-laporan-modal').modal('hide');
                    $('#btnSubmit').prop('disabled', false);
                    Swal.fire(
                    'Berhasil',
                    'Laporan telah berhasil diteruskan',
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
        console.log('draw BD');
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
        console.log('draw DT');
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
        console.log('draw');
                // If reloading table then show previously shown rows
        if (childRowsSD) {

            childRowsSD.every(function (rowIdx, tabelsd, rowLoop) {
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
    console.log(ruas,id);
    $('#add-edit-laporan-modal').modal('show');
    ruasChoices.setChoiceByValue(ruas.toString());
    $('#id').val(id);
}


</script>