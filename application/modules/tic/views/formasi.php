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
                <h3>Manajemen Formasi Petugas</h3>
                <p class="text-subtitle text-muted">Kendaraan yang tersedia dan siap beroperasi di Area.</p>
               
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <button id="addFormasi" class="btn btn-primary mb-3 mt-3 float-end"><i class="fa fa-plus-circle"></i> Tambah Formasi Petugas</button>
                    <button onclick="resetFormasi()" style="margin-right:10px;" class="btn btn-danger mb-3 mt-3 float-end" disabled><i class="fa fa-user"></i> Reset Formasi</button>
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
                                <th>Jenis Kendaraan</th>                     
                                <th>Nomor Kendaraan</th>
                                <th>Ruas</th>                              
                                <th>Petugas 1</th>
                                <th>Petugas 2</th>
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


        <!-- Modal Add-->
        <div class="modal text-left fade" id="add-edit-laporan-formasi" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tittle-modal">Tambah Formasi Petugas</h5>
                        <button type="button" class="close rounded-pill"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical" id="formFormasi">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-12">     
                                    
                                    <div class="form-group">
                                            <label for="contact-info-vertical">Ruas</label>
                                                <select  class="choices form-select choices__input" id="ruas" name="ruas" required>
                                                <option value="0" placeholder>Pilih Ruas</option>
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
                                                                            
                                    </div>
                                        
                                    <div class="form-group">
                                            <label for="first-name-vertical">Jenis Kendaraan</label>  
                                            <input type="text" class="form-control" name="id" id="id" value="0" hidden>  
                                            <input type="text" class="form-control" name="kendaraan_nomor" id="kendaraan_nomor" value="0" hidden>                                                                           
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
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="first-name-vertical">Nomor Kendaraan</label>                                                                                                                   
                                            <select  class="choices form-select choices__input" id="kendaraan_id" name="kendaraan_id" required>
                                                    <option placeholder>Pilih Nomor Kendaraan</option>                                                                                                       
                                                </select>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">Petugas 1</label>                                                                                                                   
                                            <select  class="choices form-select choices__input" id="petugas_1" name="petugas_1" required>
                                                    <option placeholder>Pilih Petugas 1</option>                                                   
                                                                                                        
                                                </select>
                                            </select>
                                        </div>

                                        <div class="mt-3 form-check form-group form-switch">
                                            <input class="form-check-input" type="checkbox" id="cb_petugas2">
                                            <label class="form-check-label" for="cb_petugas2"> Aktifkan Petugas Tambahan</label>
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">Petugas 2</label>                                                                                                                   
                                            <select  class="choices form-select choices__input" id="petugas_2" name="petugas_2">
                                                    <option placeholder>Pilih Petugas 2</option>                                                 
                                                </select>
                                            </select>
                                        </div>

                                       

                                        
                                    
                                       
                                        
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

         <!-- Modal Edit-->
         <div class="modal text-left fade" id="edit-laporan-formasi" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tittle-modal">Edit Formasi Petugas</h5>
                        <button type="button" class="close rounded-pill"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical" id="formEditFormasi">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-12">                                   
                                                                            
                                        <div class="form-group">
                                        <input type="text" class="form-control" name="id_e" id="id_e" value="0" hidden>     
                                        <input type="text" class="form-control" name="ruas_e" id="ruas_e" value="0" hidden>         
                                            <label for="first-name-vertical">Petugas 1</label>                                                                                                                   
                                            <select  class="choices form-select choices__input" id="petugas_1_e" name="petugas_1_e" required>
                                                    <option placeholder>Pilih Petugas 1</option>                                                   
                                                                                                        
                                                </select>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">Petugas 2</label>                                                                                                                   
                                            <select  class="choices form-select choices__input" id="petugas_2_e" name="petugas_2_e">
                                                    <option placeholder>Pilih Petugas 2</option>                                                 
                                                </select>
                                            </select>
                                        </div>
                                       
                                        
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

var kendaraan,jenis,petugas1,petugas2;

$( document ).ready(function() {
    var tabelpetugas;
    
    ruasChoices= new Choices($('#ruas')[0]);

    kendaraan= new Choices($('#kendaraan_id')[0],{
        loadingText: 'Loading...',
    });
    
    petugas1= new Choices($('#petugas_1')[0],{
        loadingText: 'Loading...',
        shouldSort: false,
    });

    petugas2= new Choices($('#petugas_2')[0],{
        loadingText: 'Loading...',
        shouldSort: false,
    });

    jenis= new Choices($('#jenis')[0],{
        loadingText: 'Loading...',
    });

    petugas1_e= new Choices($('#petugas_1_e')[0],{
        loadingText: 'Loading...',
    });

    petugas2_e= new Choices($('#petugas_2_e')[0],{
        loadingText: 'Loading...',
    });

    kendaraan.disable();    
    petugas1.disable();

    const list_init=[];
    var list={};
    list["value"]="NULL";   
    list["label"]='Tidak Dipilih';   
    list["selected"]=true;   
    list_init.push(list);
    petugas2.setValue(list_init);

    petugas2.disable();
    $('#cb_petugas2').prop('disabled','disabled');

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
				"url": base_url+"tic/ajax_list_formasi_petugas",
				"type": "POST",
				"data": function (data) {	
                       
				},
                "error": function(jqXHR, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
                }
			},
            "columnDefs": [
				{
					"targets": [0,2,7], //first column / numbering column
                    "className": 'text-center',
					"orderable": false, //set not orderable
				},
            ],
            "columns": [
                { "width": "3%" },
                { "width": "15%" },
                { "width": "10%" },
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

    $('#addFormasi').click(function(){
        $('#add-edit-laporan-formasi').modal('show');
        $('#formFormasi')[0].reset();
        kendaraan.disable();    
        petugas1.disable();
        petugas2.disable();
        jenis.disable();  

    });

    $('#ruas').on('change', function() {
        //console.log( this.value );
        jenis.setChoiceByValue('0');  
        jenis.enable();    
        kendaraan.clearStore();    
        petugas1.clearStore();      

    });

    $('#jenis').on('change', function() {
        //alert( this.value );
        kendaraan.enable();
        kendaraan.clearStore();
        
        var url = base_url + 'tic/getKendaraan';
        var ruas = $('#ruas').val();

        $.ajax({
            url: url,
            method: "POST",
            data: {ruas:ruas,jenis:this.value},
            beforeSend: function() {
                //$('#addLaporan').prop('disabled', true);
            },
            success: function(response) {
                console.log(JSON.parse(response));
                var data=JSON.parse(response);

                const list_finish=[];
              
                for (var row of data) 
                {
                    var list={};
                    list["value"]=row.kendaraan_id;   
                    list["label"]=row.kendaraan_nomor;   
                    list_finish.push(list);
                  
                }

                console.log((list_finish));
                kendaraan.setValue(list_finish);

            }
        });    
        
        var url = base_url + 'tic/getPetugas';
        var ruas = $('#ruas').val();
        $.ajax({
            url: url,
            method: "POST",
            data: {ruas:ruas,jenis:this.value},
            beforeSend: function() {
                //$('#addLaporan').prop('disabled', true);
            },
            success: function(response) {
                console.log(JSON.parse(response));
                var data=JSON.parse(response);
                let lenght=data.length;
                petugas1.enable();
                $('#cb_petugas2').prop('disabled',false);
                const list_finish=[];
              
                for (var row of data) 
                {
                    var list={};
                    list["value"]=row.id_petugas;   
                    list["label"]=row.nama_petugas;   
                    list_finish.push(list);
                }

                petugas1.clearStore();
                petugas1.setValue(list_finish); 
              
            }
        });  

       

    });

    
    kendaraan.passedElement.element.addEventListener(
        'addItem',
        function(event) {
            $('#kendaraan_nomor').val(event.detail.label);
        },
        false,
    );

    $('#petugas_1').on('change', function() {
        $("#cb_petugas2").prop('checked',false); 
        petugas2.clearStore();
        const list_finish=[];
        var list={};
        list["value"]="NULL";   
        list["label"]='Tidak Dipilih';   
        list["selected"]=true;   
        list_finish.push(list);
        petugas2.setValue(list_finish);
        petugas2.disable();

    });

    $("#cb_petugas2").change(function() {
        if(this.checked) {
            //console.log('ada');
           
            var url = base_url + 'tic/getPetugasKedua';
            var pt1 = $('#petugas_1').val();
            var ruas = $('#ruas').val();
            var jenis = $('#jenis').val();
            //console.log(pt1);
            $.ajax({
                url: url,
                method: "POST",
                data: {ruas:ruas,ex:pt1,jenis:jenis},
                beforeSend: function() {
                    //$('#addLaporan').prop('disabled', true);
                },
                success: function(response) {
                    //console.log(response);
                    //console.log(JSON.parse(response));
                    var data=JSON.parse(response);
                    let lenght=data.length;
          
                    petugas2.enable();
                    

                    const list_finish=[];
                
                    for (var row of data) 
                    {
                        var list={};
                        list["value"]=row.id_petugas;   
                        list["label"]=row.nama_petugas;   
                        list_finish.push(list);
                    }

                    petugas2.clearStore();               
                    petugas2.setValue(list_finish); 
                   

                }
            }); 



        }else
        {
            //console.log('tidak ada');
            petugas2.clearStore();
            const list_finish=[];
            var list={};
            list["value"]="NULL";   
            list["label"]='Tidak Dipilih';   
            list["selected"]=true;   
            list_finish.push(list);
            petugas2.setValue(list_finish);
            petugas2.disable();
        }
    });


    $( "#formFormasi" ).submit(function( event ) {       
        event.preventDefault();
       //console.log($('#jenis').val());

        if($('#jenis').val()==0){
           //console.log('oks');
           
            
            Swal.fire(
                'Error',
                'Silahkan Pilih Jenis Kendaraan',
                'error'
                );
            
            return false;

        }

        if($('#petugas_1').val()==$('#petugas_2').val()){
           //console.log('oks');
           
            
            Swal.fire(
                'Error',
                'Petugas Tidak Boleh Sama',
                'error'
                );
            
            return false;

        }


        var url = base_url + '/tic/AddOrEditFormasi';
        var formData = new FormData($("#formFormasi")[0]);

        // for (var pair of formData.entries()) {
        //     console.log(pair[0]+ ', ' + pair[1]); 
        // }  
        
        //return false;

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.loading').show();      
                $('#add-edit-laporan-formasi').modal('hide');
            },
            success: function(response) {
                $('.loading').hide();  
                //console.log(response);
                response=JSON.parse(response);
                //console.log(response);
                if(response.status)
                {
                   
                    Swal.fire(
                    'Berhasil',
                    response.keterangan,
                    'success'
                    );
                }
                else
                {
                    
                    Swal.fire(
                    'Mohon Maaf',
                     response.keterangan,
                    'info'
                    );
                }

                $('#tablePetugas').DataTable().ajax.reload();
                
            }

        });



       
    });

    $( "#formEditFormasi" ).submit(function( event ) {       
        event.preventDefault();
  
        if($('#petugas_1_e').val()==$('#petugas_2_e').val()){
                   
            Swal.fire(
                'Error',
                'Petugas Tidak Boleh Sama',
                'error'
                );
            
            return false;

        }


        var url = base_url + '/tic/EditFormasi';
        var formData = new FormData($("#formEditFormasi")[0]);

        // for (var pair of formData.entries()) {
        //     console.log(pair[0]+ ', ' + pair[1]); 
        // }  
        //     return false;

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.loading').show();      
                $('#edit-laporan-formasi').modal('hide');
            },
            success: function(response) {
                //console.log(response);
                $('.loading').hide();      
                response=JSON.parse(response);
               
                if(response)
                {
                
                    Swal.fire(
                    'Berhasil',
                    'Data Formasi berhasil di update',
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

function editFormasi(id,status)
{
    //console.log(id,status);
    if(status!='0')
    {
        Swal.fire(
            'Mohon Maaf',
            'Formasi Sedang Bertugas',
            'info'
            );
        
        return false;
    }

    var url = base_url + '/tic/getFormasiDetail';
    var npp1,npp2;
    $.ajax({
            url: url,
            method: "POST",
            data: {id:id},
        
            beforeSend: function() { 
                $('.loading').show();      
            },
            success: function(response) {
                // $('.loading').hide();   
                response=JSON.parse(response);
                //console.log(response);
                
                $('#id_e').val(response.data_petugas_id);   
                $('#ruas_e').val(response.ruas_id);   
               
                npp1=response.npp_petugas_1;
                npp2=response.npp_petugas_2;
                // jenis.setChoiceByValue(response.kendaraan_jenis);

                var url = base_url + 'tic/getPetugasExisting';
                // kendaraan.enable();
                petugas1_e.clearStore();
                petugas2_e.clearStore();
                //console.log(response.ruas_id);
                $.ajax({
                    url: url,
                    method: "POST",
                    data: {ruas:response.ruas_id,jenis:response.kendaraan_jenis},
                    beforeSend: function() {
                        //$('#addLaporan').prop('disabled', true);
                    },
                    success: function(response) {
                        $('.loading').hide();   
                        //console.log(JSON.parse(response));
                        var data=JSON.parse(response);
                        //console.log(data);
                        const list_finish=[];
                    
                        for (var row of data) 
                        {
                            var list={};
                            list["value"]=row.id_petugas;   
                            list["label"]=row.nama_petugas;   
                            list["selected"]=false;
                            list_finish.push(list);
                        
                        }
                        
                        //console.log(npp1);
                        petugas1_e.setValue(list_finish);
                        var extra={value:'0', label:'Tidak Dipilih'}
                        list_finish.push(extra);
                        petugas2_e.setValue(list_finish);
                        petugas1_e.setChoiceByValue(npp1);
                        petugas2_e.setChoiceByValue(npp2);
                        $('#edit-laporan-formasi').modal('show');
                    }

                 });    
                
            }

        });
}

function deleteFormasi(id,status)
{

    if(status!='0')
    {
        Swal.fire(
            'Mohon Maaf',
            'Formasi Sedang Bertugas',
            'info'
            );
        
        return false;
    }

    Swal.fire({
        title: 'Apakah Anda Yakin ?',
        text: "Data Formasi Yang dihapus tidak dapat dikembalikan lagi",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Tentu',
        cancelButtonText: 'Tidak'
        }).then((result) => {
        
            if (result.isConfirmed) {


                var url = base_url + '/tic/deleteFormasi';

                $.ajax({
                        url: url,
                        method: "POST",
                        data: {id:id},
                    
                        beforeSend: function() { 
                            $('.loading').show();      
                        },
                        success: function(response) {
                            $('.loading').hide();   
                           
                            Swal.fire(
                                'Berhasil',
                                'Formasi Telah Dihapus',
                                'success'
                                );
                        
                            $('#tablePetugas').DataTable().ajax.reload();
                        }

                    });


            }
    })
}

function resetFormasi()
{
    var ruas='<?= $this->session->ruas?>';
    var ruas_group='<?= $this->session->ruas_group?>';


    Swal.fire({
        title: 'Apakah Anda Yakin ?',
        text: "Data Formasi akan di reset, dan harus disusun kembali.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Tentu',
        cancelButtonText: 'Tidak'
        }).then((result) => {
        
            if (result.isConfirmed) {

                var url = base_url + '/tic/resetFormasi';

                $.ajax({
                        url: url,
                        method: "POST",
                        data: {ruas:ruas,ruas_group:ruas_group},
                    
                        beforeSend: function() { 
                            $('.loading').show();      
                        },
                        success: function(response) {
                            $('.loading').hide();   
                            var response=JSON.parse(response);
                            console.log(response);
                           
                            if(response)
                            {
                                Swal.fire(
                                'Berhasil',
                                'Formasi Telah Direset',
                                'success'
                                );

                            }
                            else
                            {
                                Swal.fire(
                                'Reset Formasi Gagal',
                                'Mohon Pastikan Semua Formasi Telah Selesai Tugas.',
                                'info'
                                );
                            }
                           
                        
                            $('#tablePetugas').DataTable().ajax.reload();
                        }

                    });


            }
    });
}


</script>