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
                <h3>Manajemen Data Kendaraan</h3>
                <p class="text-subtitle text-muted">Kendaraan yang tersedia dan siap beroperasi di Area.</p>
               
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <button id="addKendaraan" class="btn btn-primary mb-3 mt-3 float-end"><i class="fa fa-plus-circle"></i> Tambah Kendaraan</button>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">

            <div class="card-body">
                <div class="table-responsive ">
                    <table width="99%" class="table" id="tablePetugas">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>  
                                <th>Jenis</th>                     
                                <th>Kode</th>                              
                                <th>Ruas</th>
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
         <div class="modal text-left fade" id="add-edit-kendaraan-modal" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tittle-modal">Tambah Kendaraan Baru</h5>
                        <button type="button" class="close rounded-pill"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical" id="formKendaraan">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-12">   
                                        
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Jenis Kendaraan</label>
                                            <select  class="choices form-select choices__input" id="jenis" name="jenis" required>
                                                    <option value="0" placeholder>Pilih Jenis Kendaraan</option>
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
           
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="id" id="id" value="0" hidden>
                                            <label for="contact-info-vertical">Kode Kendaraan</label>
                                            <input type="text"  class="form-control" id="kode" name="kode" required>         
                                            <p><small class="text-muted">Contoh : Ambulance=K-01, Derek=G-09,Rescue=L-23 , Mobile Customer Service=210 </small></p>
                                                     
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
    
    ruasChoices= new Choices($('#ruas')[0]);
    jenisChoices= new Choices($('#jenis')[0]);


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
				"url": base_url+"tic/ajax_list_kendaraan",
				"type": "POST",
				"data": function (data) {	
                       
				},
                "error": function(jqXHR, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
                }
			},
            "columnDefs": [
				{
					"targets": [0,2,5], //first column / numbering column
                    "className": 'text-center',
					"orderable": false, //set not orderable
				},
            ],
            "columns": [
                { "width": "5%" },
                { "width": "15%" },
                { "width": "20%" },
                null,
                null,
                { "width": "10%" }
            ],
            "lengthMenu":[
				[10,100,-1],[10,100,"All"]
			]

	});


    $( "#addKendaraan" ).click(function() {
      
        $('#tittle-modal').text('Tambah Kendaraan Baru');
        $('#add-edit-kendaraan-modal').modal('show');
        $("#formKendaraan")[0].reset();


    });

    $( "#formKendaraan" ).submit(function(event) {
        event.preventDefault();

        var url = base_url + '/tic/AddOrEditKendaraan';
        var formData = new FormData($("#formKendaraan")[0]);

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
                $('#add-edit-kendaraan-modal').modal('hide');
            },
            success: function(response) {
               
                response=JSON.parse(response);
                //console.log(response);
                if(response)
                {
                    $('.loading').hide(); 
                  
                    Swal.fire(
                    'Berhasil',
                    'Kendaraan Telah Berhasil Ditambahkan',
                    'success'
                    );
                }else
                {
                    //console.log('salah');
                    $('.loading').hide(); 
                  
                    Swal.fire(
                    'Mohon Maaf',
                    'Kendaraan Telah Terdaftar',
                    'info'
                    );
                }
               

                $('#tablePetugas').DataTable().ajax.reload();
                
            }

        });
       
    });

});


function editKendaraan(id,ruas,status)
{
    
    if(status!='0')
    {
        Swal.fire(
            'Mohon Maaf',
            'Kendaraan Sedang Bertugas',
            'info'
            );
        
        return false;
    }
    
    //console.log(ruas,id,status);

    var url = base_url + '/tic/getKendaraanDetail';

    $.ajax({
            url: url,
            method: "POST",
            data: {id:id,ruas:ruas},
           
            beforeSend: function() { 
                $('.loading').show();      
            },
            success: function(response) {
                $('.loading').hide();   
                response=JSON.parse(response);
                console.log(response);
                $('#tittle-modal').text('Edit Data Kendaraan');
                $('#add-edit-kendaraan-modal').modal('show');
                //$('#modal-title').html('Edit Kendaraan');
                $('#id').val(response.kendaraan_id);               
                $('#kode').val(response.kendaraan_nomor);
                ruasChoices.setChoiceByValue(response.ruas_id);
                jenisChoices.setChoiceByValue(response.kendaraan_jenis);
              
                
            }

        });
}


function deleteKendaraan(id,ruas,status)
{
    if(status!='0')
    {
        Swal.fire(
            'Mohon Maaf',
            'Kendaraan Sedang Bertugas',
            'info'
            );
        
        return false;
    }

    Swal.fire({
        title: 'Apakah Anda Yakin ?',
        text: "Kendaraan Yang dihapus tidak dapat dikembalikan lagi",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Tentu',
        cancelButtonText: 'Tidak'
        }).then((result) => {
        
            if (result.isConfirmed) {


                var url = base_url + '/tic/deleteKendaraan';

                $.ajax({
                        url: url,
                        method: "POST",
                        data: {id:id,ruas:ruas},
                    
                        beforeSend: function() { 
                            $('.loading').show();      
                        },error: function (request, error) {
                            
                            Swal.fire(
                                'Mohon Maaf ',
                                'Kendaraan Telah Berada Dalam Formasi',
                                'error'
                                );
                                $('.loading').hide();   
                            $('#tablePetugas').DataTable().ajax.reload();
                        },
                        success: function(response) {
                            $('.loading').hide();   
                           
                            Swal.fire(
                                'Berhasil',
                                'Kendaraan Telah Dihapus',
                                'success'
                                );
                        
                            $('#tablePetugas').DataTable().ajax.reload();
                        }

                    });


            }
    })

}

</script>