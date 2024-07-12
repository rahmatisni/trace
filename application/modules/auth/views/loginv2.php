<!doctype html>
<html lang="en">
    <style>
    select option{
        background-color: white;
        color: black;
    }

    select optgroup{
        color: black;
    }
    

    </style>
  <head>
  	<title>Trace : Track N Care</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">	
	<link rel="stylesheet" href="<?= base_url('assets/login-style/css/')?>style.css">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/sweetalert2/')?>sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

	</head>
	<body class="img js-fullheight" style="background-image: url(assets/login-style/images/bg.jpg);">
	<section class="ftco-section">
		<div class="container animate__animated animate__jackInTheBox">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<img src="<?=base_url('assets/login-style/images/')?>trace.png" style="width:200px;" alt="">
				</div>
			</div>
			<div class="row justify-content-center ">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Track N Care</h3>
		      	<form id="formLogin" action="<?php echo base_url('auth/cekLogin')?>" method="POST"  class="signin-form">
                  <div class="form-group">
                        <select class="form-control custom-select" id="shift" username="shift"  placeholder="Pilih Shift"  autocomplete="off" required>                              
                                <option value="" disabled="" selected="">Pilih Shift</option>
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
                    </div>
		      		<div class="form-group">
		      			<input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
		      		</div>
                   
                    <div class="form-group">
                        <input id="password-field" type="password" id="password"  name="password"  class="form-control" placeholder="Password" required>
                        <span toggle="#password-field" style="color:black;" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btnLogin" class=" form-control btn btn-primary submit px-3"><i style="" class="loading fa fa-circle-o-notch fa-spin mr-2"></i>Sign In</button>
                    </div>
                    <div class="form-group d-md-flex">
                        <div class="w-50">
                            <label class="checkbox-wrap checkbox-primary">Remember Me
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="w-50 text-md-right">
                            <a href="https://wa.me/6282288082106" style="color: #fff">Need Help !</a>
                        </div>
                    </div>
	          </form>
	          <p class="w-100 text-center">&mdash; &copy; JMTO 2022&mdash;</p>
	        
		      </div>
				</div>
			</div>
		</div>
	</section>

    <script src="<?= base_url('assets/js/')?>jquery-3.6.1.min.js"></script>
    <script src="<?= base_url('assets/login-style/js/')?>popper.js"></script>
    <script src="<?= base_url('assets/login-style/js/')?>bootstrap.min.js"></script>
    <script src="<?= base_url('assets/login-style/js/')?>main.js"></script>
    <script src="<?= base_url('assets/js/extensions/')?>sweetalert21.js"></script>
    
    <script>

    $( document ).ready(function() {
        
        $(".loading").hide();
        $("#btnLogin").click(function(){
            $(".loading").show();            
        });

        // Swal.fire(
        //         'Login Gagal',
        //         'Coba Cek Password Kembali',
        //         'error'
        //         );

        // <?php if($this->session->flashdata('status')=='error'){ ?>
        //     Swal.fire(
        //         'Login Gagal',
        //         'Coba Cek Password Kembali',
        //         'error'
        //         );
        // <?php } ?>

      

    });


</script>
	</body>
</html>

