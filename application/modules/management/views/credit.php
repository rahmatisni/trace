<html lang="en">
    <head>
        <style>
          .img_credit{
            background:red;
          }

          .img_dev {
            display: block;
            margin-left: auto;
            margin-top: -80px;
            }
        </style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trace : Track N Care</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&amp;display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/css/')?>bootstrap.css">
        <link rel="stylesheet" href="<?= base_url('assets/vendors/bootstrap-icons/')?>bootstrap-icons.css">
        <link rel="stylesheet" href="<?= base_url('assets/css/')?>app.css">
    </head>

<body>
    <nav class="navbar navbar-light">
        <div class="container d-block">
            <a href="<?=base_url('/')?>"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="#">
                Tentang Pengembang Aplikasi Trace
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Latar Belakang Aplikasi</h4>
            </div>
            <div class="card-body">
                <p><strong>Trace (Track and Care)</strong> merupakan aplikasi operasional petugas <strong>PT Jasamarga Tollroad Operator (PT JMTO)</strong> yang digunakan untuk melayani permintaan 
                    bantuan dari pengguna jalan melalui layanan Call Center Jasa Marga <strong>14080</strong> / Twitter Official Jasa Marga <strong>@PTJASAMARGA</strong>.<br><br> Dengan adanya aplikasi ini untuk dapat
                     merekam dan memudahkan petugas operasional dalam menangani setiap proses  penanganan bantuan dari awal laporan masuk diterima oleh petugas 
                     Call Center dan koordinasi penanganan permintaan bantuan oleh Jasa Marga Tollroad Command Center serta Traffic Information Center (TIC) Area, 
                     Penanganan petugas dilapangan, hingga akhir penilaian penanganan bantuan melalui kuisioner oleh pengguna jalan, serta menjadi bukti dari 
                     penilaian respon time performa petugas .</p>
            </div>
        </div>
   
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All The Credits</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p>Version 1.0.0</p>
                                <p>Initiator by JMTC (AF Pranidhana, Syali W)</p>
                                <p>Developed by JMTO IT Plan & Dev (Rahmat Nur Isni , Ashrul Khair)</p>
                            </div>
                            <div class="col-md-4">
                                <img class="img_dev" src="<?=base_url("assets/login-style/images/dev.png")?>"></img>
                            </div>
                        </div>
                       
                       
                    </div>
                </div>

         
    
    </div>
</body>

</html>