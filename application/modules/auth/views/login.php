<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trace : Track n Care</title>
    <link rel="stylesheet" href="<?= base_url('assets/js/extensions/')?>css2.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/')?>bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/bootstrap-icons/')?>bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/')?>app.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/pages/')?>auth.css">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/sweetalert2/')?>sweetalert2.min.css">
    
    <script src="<?= base_url('assets/js/')?>jquery-3.6.1.min.js"></script>
    <script src="<?= base_url('assets/js/extensions/')?>sweetalert21.js"></script>

</head>

<style>
    body {
    overflow: hidden; 
  }
</style>
  
<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="#"><img src="<?= base_url('assets/images/logo/jmto2.png')?>" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Login</h1>
                   
                    <form id="formLogin" action="<?php echo base_url('auth/cekLogin')?>" method="POST" class="card card-md" autocomplete="off">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <select class="form-control form-control-xl" id="shift" username="shift"  placeholder="Pilih Shift"  autocomplete="off" required>                              
                                <option value="" disabled="" selected="">Silahkan Pilih Shift</option>
                                <optgroup label="CSO">
                                    <option value="1">06:00-15:00 (Shift 1)</option>
                                    <option value="2">09:00-18:00 (Shift 2)</option>
                                    <option value="2">12:00-21:00 (Shift 3)</option>
                                    <option value="2">15:00-24:00 (Shift 4)</option>
                                    <option value="3">21:00-06:00 (Shift 5)</option>  
                                </optgroup> 
                                <optgroup label="JMTC/TIC">
                                    <option value="1">06:00-14:00 (Shift 1)</option>
                                    <option value="2">14:00-22:00 (Shift 2)</option>
                                    <option value="2">22:00-06:00 (Shift 3)</option>                                    
                                </optgroup>               
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                        </div>
                    
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" id="username" name="username"  placeholder="Username"  autocomplete="on" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" id="password"  name="password"  placeholder="Password"  autocomplete="on" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button type="submit" id="btnLogin" class="btn btn-primary btn-block btn-lg shadow-lg mt-5"> <span id="spinner_login" style="margin-right:30px;" class="spinner-border spinner-border" role="status" aria-hidden="true" disabled=""></span> Log in</button>
                    </form>
                    <!-- <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="#"
                                class="font-bold">Sign
                                up</a>.</p>
                        <p><a class="font-bold" href="#">Forgot password?</a>.</p>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>

    <script>

        $( document ).ready(function() {

            $("#spinner_login").hide();       
            $("#btnLogin").click(function(){

                $("#spinner_login").show();
                
            });

            

            <?php if($this->session->flashdata('status')=='error'){ ?>
                Swal.fire(
                    'Login Gagal',
                    'Coba Cek Password Kembali',
                    'error'
                    );
            <?php } ?>

            
            $('#tes').on('click', function(){
                var passInput=$("#password");
                if(passInput.attr('type')==='password')
                    {
                    passInput.attr('type','text');
                }else{
                    passInput.attr('type','password');
                }
            })

        });

        

    </script>
</body>

</html>