<style>
    .keterangan { width:50%;
        table-layout: fixed;
    }
    
    .table tr {
        cursor: pointer;
    }

    .table {
        table-layout: fixed;
        margin-left: auto;
        margin-right: auto;
    }

    td {
        word-wrap: break-word;  
    }

    .checked {
        color: orange;
    }
</style>
<div style="display:none" class="loading">Loading&#8230;</div>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>List Laporan Masuk</h3>
                <p class="text-subtitle text-muted">Mohon untuk selalu menginformasikan pelanggan untuk mengisi survey penilaian petugas.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
    <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">Advanced Filtering Laporan Masuk</h3>
                <button class="btn btn-sm btn-default" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse"><i class="fa fa-lg fa-caret-down"></i></button>
            </div>
            <div id="filterCollapse" class="card-body collapse">
            
                <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Status Laporan :</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="0" selected>All Status</option>
                                    <option value="5">Selesai Ditindak</option>
                                    <option value="6">Selesai Tanpa Ditindak</option>
                         
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Ruas :</label>
                                <select class="form-select" id="ruasi" name="ruasi">
                                <option value="0" selected>All Ruas</option>
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
                                            echo'<option value="">Data Not Found</option>';  
                                        }
                                    ?>            
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Rating Pelanggan :</label>
                                <select class="form-select" id="rating" name="rating">
                                    <option value="0" selected>All Rating</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>                         
                                </select>
                            </div>
                        </div>
                       
                
                </div>
                <div class="form-actions d-flex justify-content-end mt-4">
                   
                    <button type="button" id="btnResetFilter" class="btn btn-danger me-1"><i class="fa fa-retweet"></i> Reset</button>
                    <button type="submit" id="btnFilter" class="btn btn-primary me-1"><i class="fa fa-filter"></i> Cari data</button>

                    
                </div>
               
            </div>
                

        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive ">
                    <table width="99%" class="table table-bordered" id="tableManagement">
                        <thead class="table-primary">
                            <tr>       
                                <th>ID</th>                         
                                <th>Nama</th>
                                <th>No Hp</th>
                                <th>Ruas</th>
                                <th>KM</th>
                                <th>Jalur</th>
                                <th>Kendaraan</th>
                                <th>No Polisi</th>                                 
                                <th>Status</th>
                                <th>Rating Pelanggan</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal text-left fade" id="add-edit-laporan-modal" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-full " role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark ">
                        <h5 class="modal-title white" id="tittle-modal">Review Laporan Permasalahan</h5>
                        <button type="button" class="close rounded-pill"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical" id="formLaporan">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-3">       
                                        <div class="form-group">
                                            <label for="first-name-vertical">Laporan ID</label>
                                            <input type="text" class="form-control" name="laporan_id" id="laporan_id" readonly>                                           
                                        </div>      
                                        
                                        <div class="form-group">
                                            <label for="first-name-vertical">Level Prioritas</label>
                                            <input type="text" class="form-control" name="prioritas" id="prioritas" readonly>                                           
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">Nama Pelapor</label>
                                            <input type="text" class="form-control" name="nama" id="nama" readonly>                                           
                                        </div>
                                                                      
                                        <div class="form-group">
                                            <label for="email-id-vertical">No Handphone</label>
                                            <input type="text"  class="form-control" name="hp" id="hp" readonly>                                          
                                        </div>
                                                                      
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Tipe Mobil</label>
                                            <input type="text"  class="form-control" id="jenis" name="jenis" readonly>                                       
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-info-vertical">Warna Kendaraan</label>
                                            <input type="text" class="form-control" name="warna" id="warna" readonly>           
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-info-vertical">No Polisi</label>
                                            <input type="text" class="form-control" name="nopol" id="nopol" readonly>                                            
                                        </p>
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-info-vertical">Jenis Kendala</label>
                                            <input type="text" class="form-control" name="kendala" id="kendala" readonly>           
                                        </div>

                                      
                                        
                                    </div>
                                    <div class="col-lg-3">                                    
                                        <div class="form-group">
                                            <label for="first-name-vertical">Ruas</label>
                                            <input type="text" class="form-control" name="ruas" id="ruas" readonly>   
                                        </div>
                                    
                                  
                                        <div class="form-group">
                                            <label for="email-id-vertical">KM</label>
                                            <input type="text" class="form-control" name="km" id="km" readonly>                                          
                                        </p>
                                        </div>
                                    
                                  
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Jalur</label>
                                            <input type="text" class="form-control" name="jalur" id="jalur" readonly>   
                                        </p>
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-info-vertical">Keterangan :</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" rows="19" readonly></textarea>
                                        </div>
                                                                   
                                       
                                    </div>
                                    <div class="col-lg-3">                                    
                                        <div class="form-group">
                                            <label for="first-name-vertical">Waktu Laporan</label>
                                            <input type="text" class="form-control" name="waktu_laporan" id="waktu_laporan" readonly>   
                                        </div>
                                    
                                  
                                        <div class="form-group">
                                            <label for="email-id-vertical">Agent CSO</label>
                                            <input type="text" class="form-control" name="cso" id="cso" readonly>                                          
                                        </p>
                                        </div>
                                    
                                  
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Command Center</label>
                                            <input type="text" class="form-control" name="cc" id="cc" readonly>   
                                        </p>
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-info-vertical">Waktu forward Ke TIC</label>
                                            <input type="text" class="form-control" name="waktu_forward_tic" id="waktu_forward_tic" readonly>   
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-info-vertical">TIC</label>
                                            <input type="text" class="form-control" name="tic" id="tic" readonly>   
                                        </p>
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-info-vertical">Waktu Assign Ke Petugas</label>
                                            <input type="text" class="form-control" name="waktu_assign_petugas" id="waktu_assign_petugas" readonly>   
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-info-vertical">Petugas Yang Melakukan Bantuan</label>
                                            <textarea class="form-control" id="petugas" name="petugas" rows="10" readonly></textarea> 
                                        </div>
                                                                   
                                       
                                    </div>
                                    <div class="col-lg-3">                                    
                                        <div class="form-group">
                                            <label for="first-name-vertical">Waktu Petugas Sampai Dilokasi</label>
                                            <input type="text" class="form-control" name="waktu_sampai_dilokasi" id="waktu_sampai_dilokasi" readonly>   
                                        </div>
                                  
                                       
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Response Time ( dalam menit)</label>
                                            <input type="text" class="form-control" name="response_time" id="response_time" readonly>   
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-info-vertical">Waktu Laporan Selesai</label>
                                            <input type="text" class="form-control" name="waktu_laporan_selesai" id="waktu_laporan_selesai" readonly>   
                                        </div>
                                  
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Saran</label>
                                            <textarea class="form-control" name="saran" id="saran" rows="10" readonly></textarea> 
                                        </div>

                                     
                                        <div class="form-group">
                                            <label for="email-id-vertical">Sudah Mengisi Survey</label>
                                            <input type="text" class="form-control" name="survey" id="survey" readonly>                                
                                        </div>

                                        <div class="form-group">
                                            <label for="email-id-vertical">Rating Pelangan</label>
                                            <div  id="ratingpelanggan" name="ratingpelanggan"></div>                                   
                                       
                                        </div>
                                        
                                                                   
                                       
                                    </div>
                                </div>
                            </div>
                       
                    </div>
                    <div class="modal-footer">                        
                        <button type="button" data-bs-dismiss="modal" class="btn btn-dark ml-1"> Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</div>
<script>
$( document ).ready(function() {
    var tabelLaporan;

    //const ruasChoices = new Choices($('#ruas')[0]);
    

    tabelLaporan = $('#tableManagement').DataTable({
			"processing": true, 	 
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
				"url": base_url + 'management/ajax_list_laporan_management',
				"type": "POST",
				"data": function (data) {	
                        data.status = $('#status').val();
                        data.rating = $('#rating').val();	
                        data.ruasi = $('#ruasi').val();			
				},
                "error": function(jqXHR, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
                }
			},"columns": [
                    { "width": "5%" },
                    { "width": "8%" },
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    { "width": "12%" },
                    null
                  
            ],
			"columnDefs": [
				{
					"targets": [0,1,2,3,4,5,6,7,8,9], 
                    "className": 'text-center',
					"orderable": false, 
				},
                {
                "targets": 9,
                "data": null,
                "render": function (data, type, row, meta){
                        //console.log(data[8]);
                        let starHtml = "";
                        for (let i = 1; i <= data[9]; i++) {
                            starHtml += '<span class="fa fa-star checked"></span>';
                        }
                        if (data[9] < 5){
                            for (let i = data[9]; i < 5; i++) {
                                starHtml += '<span class="fa fa-star"></span>';
                            }
                        }
                        return starHtml;
                    }
                }
               
               
			],"lengthMenu":[
				[10,100,-1],[10,100,"All"]
			],
            // "initComplete": function () {
            //     setInterval(function () {
            //         childRows = tabelLaporan.rows($('.shown'));
            //         tabelLaporan.ajax.reload(null, false);
            //         setOnline();
            //     }, 3000);
            // }

	});


    $('#tableManagement tbody').on('click', 'tr', function () {
       
        const row=tabelLaporan.row( this ).data();
        console.log(row);
        
        var id=row[0];

        var url = base_url + 'management/getDetailLaporanByID';

        $.ajax({
            url: url,
            method: "POST",
            data: {id:id},
            beforeSend: function() {               
                $('.loading').show();            
            },
            success: function(response) {
                
                $('.loading').hide();   
                response=JSON.parse(response);
                //console.log(response);
                $('#laporan_id').val(response.laporan_id);
                $('#prioritas').val(response.status_name);
                $('#nama').val(response.laporan_name);
                $('#hp').val(response.laporan_phone_no);
                $('#jenis').val(response.laporan_vehicle_category);
                $('#warna').val(response.laporan_vehicle_colour);
                $('#nopol').val(response.laporan_plat_no);
                $('#kendala').val(response.kendala);

                $('#ruas').val(response.ruas_name);
                $('#km').val(response.laporan_km);
                $('#jalur').val(response.laporan_jalur);
                $('#keterangan').val(response.laporan_description);

                $('#waktu_laporan').val(response.laporan_created_timestamp);
                $('#cso').val(response.csnama);
                $('#cc').val(response.ccnama);

                
                var now = moment(response.laporan_forward_to_tic_timestamp); 
                var end = moment(response.laporan_created_timestamp);
                var duration = moment.duration(now.diff(end));
                

                $('#waktu_forward_tic').val(response.laporan_forward_to_tic_timestamp+' ('+Math.floor(duration.asMinutes())+' menit)');
                $('#tic').val(response.ticnama);


                var now = moment(response.laporan_forward_to_petugas_timestamp); 
                var end = moment(response.laporan_forward_to_tic_timestamp);
                var duration = moment.duration(now.diff(end));
                
                $('#waktu_assign_petugas').val(response.laporan_forward_to_petugas_timestamp+' ('+Math.floor(duration.asMinutes())+' menit)');

                //petugas
                if(response.data_petugas_id != '[]')
                {
                            
                    var url = base_url + 'management/getPetugasName';

                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {data:response.data_petugas_id},
                        beforeSend: function() {
                            //$('#addLaporan').prop('disabled', true);
                        },
                        success: function(response) {
                            var data=JSON.parse(response);
                            var text='';
                           for (let i = 0; i < data.length; i++) {
                                text += data[i] + "\n";
                            }
                          
                            $('#petugas').val(text);
                        }
                    }); 
                }
                 
              

                
                $('#waktu_sampai_dilokasi').val(response.laporan_petugas_arrived_timestamp);
                $('#waktu_laporan_selesai').val(response.laporan_closed_timestamp);
        
                $('#saran').val(response.feedback_suggest);
               
                $('#survey').val(response.feedback_id==null?'Belum':'Sudah');
                //$('#rating').val(response.feedback_rate);
                $('#add-edit-laporan-modal').modal('show');

                var end = moment(response.laporan_created_timestamp); 
                var now = moment(response.laporan_petugas_arrived_timestamp);
                var duration = moment.duration(now.diff(end));
                
                //console.log(duration.asMinutes());
                $('#response_time').val(Math.floor(duration.asMinutes()));       
                if (response.feedback_rate == 0){
                    $('#ratingpelanggan').html("");
                    $('#ratingpelanggan').append(`
                        <span>-</span>
                    `);                    
                }else{       
                    let starHtml = "";
                    for (let i = 1; i <= response.feedback_rate; i++) {
                        starHtml = starHtml + '<span class="fa fa-star checked"></span>';
                    }
                    if (response.feedback_rate< 5){
                        for (let i = response.feedback_rate; i < 5; i++) {
                            starHtml = starHtml + '<span class="fa fa-star"></span>';
                        }
                    }
                    // return starHtml;
                    $('#ratingpelanggan').html("");
                    $('#ratingpelanggan').append(starHtml);
                }
            }

        });

    });


    $("#btnFilter").click(function(){
        tabelLaporan.ajax.reload(null, false);
    });
    
    
    $("#btnResetFilter").click(function(){
        $('#status').val(0);
        $('#rating').val(0);	
        $('#ruasi').val(0);
    });
    
});


</script>