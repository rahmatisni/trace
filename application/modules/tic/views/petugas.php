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
</style>
<div style="display:none" class="loading">Loading&#8230;</div>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manajemen Data Petugas</h3>
                <p class="text-subtitle text-muted">Petugas Area terdiri dari Derek, Ambulance, Rescue dan Mobile Customer Service</p>
               
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <button id="addPetugas" class="btn btn-primary mb-3 mt-3 float-end"><i class="fa fa-plus-circle"></i> Tambah Petugas</button>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">

            <div class="card-body">
                <div class="table-responsive ">
                    <table width="99%" class="table" id="tablePetugas">
                        <thead class="table-primary ">
                            <tr>
                                <th>No</th>                       
                                <th>Npp</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis</th>
                                <th>Ruas</th>
                                <th>No Hp</th>
                                <th>Status</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal text-left fade" id="add-edit-petugas-modal" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tittle-modal">Tambah Data Petugas</h5>
                        <button type="button" class="close rounded-pill"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical" id="formPetugas">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-12">                                    
                                        <div class="form-group">
                                            <label for="first-name-vertical">Nama Petugas</label>
                                            <input type="text" class="form-control" name="id" id="id" value="0" hidden>
                                            <input type="text" class="form-control" name="nama" id="nama" required>                                           
                                        </div>
                                    
                                  
                                        <div class="form-group">
                                            <label for="email-id-vertical">No Handphone<small class="text-muted">(Terhubung Di WhatsApp)</small></label>
                                            <input type="text"  class="form-control" name="hp" id="hp">
                                        </div>

                                        <div class="form-group status-all" >
                                            <label for="contact-info-vertical">Status</label>
                                                <select  class="form-select choices__input" id="status" name="status" required>
                                                    <option value="0" placeholder>Non Karyawan</option>          
                                                    <option value="1" placeholder>Karyawan</option>                                                                                    
                                                </select>
                                        </div>
                                  
                                        <div class="form-group txt-status">
                                            <label for="contact-info-vertical">NIK / NIP Petugas</label>
                                            <input type="text"  class="form-control" id="nik" name="nik">                                           
                                        </div>

                                        <!-- <div class="form-group">
                                            <label for="contact-info-vertical">NPP Petugas</label>
                                            <input type="text"  class="form-control" id="npp" name="npp" required>                                           
                                        </div> -->

                                        <div class="form-group">
                                            <label for="contact-info-vertical">Jenis Petugas</label>
                                            <select  class="choices form-select choices__input" id="jenis" name="jenis" required>
                                                    <option value="0" placeholder>Pilih ID Kendaraan</option>
                                                    <?php 
                                                    if(count($kendaraanJenisOption)> 0)
                                                    {
                                                        foreach ($kendaraanJenisOption as $row) 
                                                        {
                                                            echo '<option value='.$row->jenis_kendaraan_id.'>'.$row->jenis_kendaraan.'</option>';
                                                        }
                                                    } 
                                                    else
                                                    {
                                                        echo'<option value="0">Data Not Found</option>';  
                                                    }
                                                ?>                                                            
                                                </select>
                                        </div>
                                        

                                        <div class="form-group">
                                            <label for="contact-info-vertical">Ruas</label>
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
                       
                    </div>
                    <div class="modal-footer">
                        
                        <button type="submit" id="btnSubmit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                       
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</div>
<script>
 var ruasChoices,jenisChoices;
$( document ).ready(function() {
    var tabelpetugas;
    $('.txt-status').hide();
    ruasChoices= new Choices($('#ruas')[0]);
    jenisChoices= new Choices($('#jenis')[0]);

    $('#status').on('change', function() {
       
        var selectedValue = $(this).val();
        if(selectedValue=='0')
        {   
            $('.txt-status').hide();
        }else
        {
            $('.txt-status').show();
        }
       
    });


    tabelpetugas = $('#tablePetugas').DataTable({
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
				"url": base_url+"tic/ajax_list_petugas",
				"type": "POST",
				"data": function (data) {	
                       
				},
                "error": function(jqXHR, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
                }
			},
            "columnDefs": [
				{
					"targets": [0,7], //first column / numbering column
                    "className": 'text-center',
					"orderable": false, //set not orderable
				},
            ],
            "columns": [
                { "width": "5%" },
                { "width": "10%" },
                { "width": "15%" },
                null,
                null,
                null,
                { "width": "10%" },
                { "width": "10%" }
            ],
            "lengthMenu":[
				[10,100,-1],[10,100,"All"]
			]

	});


    $( "#addPetugas" ).click(function() {        
        $('#formPetugas')[0].reset();
        $('#npp').prop("readonly",false);  
        $('#nik').prop("readonly",false);            
        $('#tittle-modal').text('Tambah Data Petugas');
        $('#add-edit-petugas-modal').modal('show');
        $('.status-all').show();
    });

    $( "#formPetugas" ).submit(function( event ) {       
        event.preventDefault();
        
        var url = base_url + '/tic/AddOrEditPetugas';
        var formData = new FormData($("#formPetugas")[0]);

        // for (var pair of formData.entries()) {
        //     console.log(pair[0]+ ', ' + pair[1]); 
        // }        

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.loading').show();  
                $('#add-edit-petugas-modal').modal('hide');    
            },
            success: function(response) {
                //console.log(response);
                response=JSON.parse(response);
                console.log(response);
                $('.loading').hide();
                if(response.status)
                {
                   
                    
                    Swal.fire(
                        'Berhasil',
                        'Data berhasil disimpan',
                        'success'
                    );
                }else
                {
                    
                    Swal.fire(
                        'Mohon Maaf',
                        'Petugas Telah Terdaftar',
                        'info'
                    );
                }
              
                $('#tablePetugas').DataTable().ajax.reload();
                
            }

        });

        
    });
    
});

function editPetugas(npp,ruas)
{
    //console.log(nik,ruas);
    $('.txt-status').hide();
    $('.status-all').hide();
    var url = base_url + '/tic/getPetugasDetail';

    $.ajax({
            url: url,
            method: "POST",
            data: {npp:npp,ruas:ruas},
           
            beforeSend: function() { 
                $('.loading').show();      
            },
            success: function(response) {
                $('.loading').hide();   
                response=JSON.parse(response);
                console.log(response);
              
                $('#id').val(response.id_petugas);               
                $('#nama').val(response.nama_petugas);
                $('#nik').val(response.nik_petugas);  
                $('#npp').prop("readonly",true);         
                $('#nik').prop("readonly",true);             
                $('#hp').val(response.no_hp);
                $('#npp').val(response.npp_petugas);              
               
                ruasChoices.setChoiceByValue(response.ruas_id);
                jenisChoices.setChoiceByValue(response.jenis_petugas);
                $('#tittle-modal').text('Edit Data Petugas');
                $('#add-edit-petugas-modal').modal('show');
              
                
            }

        });
}

function deletePetugas(npp,ruas)
{
   
    Swal.fire({
        title: 'Apakah Anda Yakin ?',
        text: "Data Petugas Yang dihapus tidak dapat dikembalikan lagi",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Tentu',
        cancelButtonText: 'Tidak'
        }).then((result) => {
        
            if (result.isConfirmed) {


                var url = base_url + '/tic/deletePetugas';

                $.ajax({
                        url: url,
                        method: "POST",
                        data: {npp:npp,ruas:ruas},
                    
                        beforeSend: function() { 
                            $('.loading').show();      
                        },
                        error: function (request, error) {
                            
                            Swal.fire(
                                'Mohon Maaf ',
                                'Petugas Telah Berada Dalam Formasi',
                                'error'
                                );
                                $('.loading').hide();   
                            $('#tablePetugas').DataTable().ajax.reload();
                        },
                        success: function(response) {
                            $('.loading').hide();   
                           
                            Swal.fire(
                                'Berhasil',
                                'Petugas Telah Dihapus',
                                'success'
                                );
                        
                            $('#tablePetugas').DataTable().ajax.reload();
                        }

                    });


            }
    })

}

</script>