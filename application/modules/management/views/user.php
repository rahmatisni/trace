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
                <h3>Management User</h3>
                <p class="text-subtitle text-muted">Menambahkan Data Agen CSO, Command Center, dan TIC Area. </p>
               
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <button id="addUser" class="btn btn-primary mb-3 mt-3 float-end">
                        <i class="fa fa-plus-circle"></i> Tambah User Baru</button>
                </nav>
            </div>
           
        </div>
    </div>
    <section class="section">
        <div class="card">

            <div class="card-body">
                <div class="table-responsive ">
                    <table width="99%" class="table" id="tableUser">
                        <thead class="table-primary">
                            <tr>       
                                <th>ID</th>                         
                                <th>Nama</th>
                                <th>NPP</th>
                                <th>Jabatan</th>
                                <th>Ruas Group</th>         
                                <th>Acion</th>                              
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal text-left fade" id="add-edit-user-modal" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tittle-modal">Tambah User Baru</h5>
                        <button type="button" class="close rounded-pill"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form form-vertical" id="formUser">
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
                                            <label for="first-name-vertical">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="id" id="id" value="0" hidden>
                                            <input type="text" class="form-control" name="ruas_group" id="ruas_group" value="0" hidden>
                                            <input type="text" class="form-control" name="nama" id="nama" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">NPP</label>
                                            <input type="text" class="form-control" name="npp" id="npp" required>
                                            <div class="valid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                Npp Tersedia.
                                            </div>
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                Npp telah digunakan.
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">Role User</label>
                                            <select class="choices form-select choices__input" id="role" name="role" required>
                                                    <option value="" disabled="" selected="">Pilih Role</option>
                                                    <?php 
                                                    if(count($roleOption)> 0)
                                                    {
                                                        foreach ($roleOption as $row) 
                                                        {
                                                            echo '<option value='.$row->role_id.'>'.$row->role.'</option>';
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
                                            <label for="first-name-vertical">Password</label>
                                            <input type="password" class="form-control" name="password1" id="password1" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="first-name-vertical">Konfirmasi Password</label>
                                            <input type="password" class="form-control" name="password2" id="password2" required>
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
$( document ).ready(function() {
    var tabelUser;

    const ruasChoices = new Choices($('#ruas')[0]);

    const roleChoices = new Choices($('#role')[0]);
    
    tabelUser = $('#tableUser').DataTable({
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
				"url": base_url+"management/ajax_list_user",
				"type": "POST",
				"data": function (data) {	
                       
				},
                "error": function(jqXHR, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
                }
			},
            "lengthMenu":[
				[10,100,-1],[10,100,"All"]
		 ],"columnDefs": [
		 	{
		 		"targets": [0,1,2,3,4,5], 
                "className": 'text-center',
				"orderable": false, 
		 	}
               
		 ],"columns": [
                    { "width": "8%" },
                    { "width": "25%" },
                    null,
                    null,
                    null,
                    null,

                 
                  
            ],
            

	});

    $('#npp').on('input', function() {
        //console.log('cek npp');

        
        var url = base_url + '/management/cekNPP';
        var npp = $('#npp').val();
        var ruas = $('#ruas').val();

        //console.log(npp,ruas);

        if(!npp)
        {
            $("#npp").removeClass("is-valid");
            $("#npp").removeClass("is-invalid");
        }else
        {
            $.ajax({
                    url: url,
                    method: "POST",
                    data: {npp:npp,ruas:ruas},
                    beforeSend: function() {
                        //$('.loading').show();         
                    },
                    success: function(response) {
                        //console.log(response);
                        response=parseInt(response);
                        if(response)
                        {
                            //console.log('ok');
                            $("#npp").removeClass("is-valid");
                            $("#npp").addClass("is-invalid");
                           
                        }
                        else
                        {
                            //console.log('nok');
                            $("#npp").removeClass("is-invalid");
                            $("#npp").addClass("is-valid");
                        }
                    }

                });
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

    $( "#addUser" ).click(function() {
      
      $('#tittle-modal').text('Tambah User Baru');
      $('#add-edit-user-modal').modal('show');
      $("#npp").removeClass("is-valid");
      $("#npp").removeClass("is-invalid");
      $("#formUser")[0].reset();

    });

    $( "#formUser" ).submit(function( event ) {
        event.preventDefault();
        //console.log('ok');

        var pass1 = $('#password1').val();
        var pass2 = $('#password2').val();

        if(pass1!==pass2)
        {
            Swal.fire(
                'Error',
                'Password Konfirmasi Tidak Sama',
                'error'
                );
            
            return false;
        }

        var url = base_url + '/management/AddOrEditUser';
        var formData = new FormData($("#formUser")[0]);

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
                $('#add-edit-user-modal').modal('hide');
                $('.loading').show();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Swal.fire(
                            'Error',
                            'User Gagal Ditambahkan',
                            'error'
                        );
                
                $('.loading').hide();
            },
            success: function(response) {
                
                $('.loading').hide();
               
                response=JSON.parse(response);
                console.log(response);
                if(response.event=='tambah')
                {
                    if(response.status)
                    {   
                        Swal.fire(
                            'Berhasil',
                            'User Telah Berhasil Ditambah',
                            'success'
                        );
                    }else
                    {
                        Swal.fire(
                            'Error',
                            'User Gagal Ditambahkan',
                            'error'
                        );
                    }
                   
                }else
                {

                }

                $('#tableUser').DataTable().ajax.reload();
                
            }

        });
        
        

    });



});

</script>