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
        <script src="<?= base_url('assets/js/')?>jquery-3.6.1.min.js"></script>
    </head>

<body>
    <nav class="navbar navbar-light">
        <div class="container d-block">
            <a href="<?=base_url('/')?>"><i class="bi bi-chevron-left"></i></a>
            <a class="navbar-brand ms-4" href="#">
                Pengaturan Aplikasi Trace
            </a>
        </div>
    </nav>


    <div class="container">
        
<!-- <section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profile Settings</h4>
                </div>
                <div class="card-body">
                    <p>A switch has the markup of a custom checkbox but uses the
                        <code>.form-switch</code> class to
                        render a toggle switch. Switches also support the disabled attribute.</p>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Default switch
                            checkbox
                            input</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch
                            checkbox
                            input</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDisabled" disabled="">
                        <label class="form-check-label" for="flexSwitchCheckDisabled">Disabled switch
                            checkbox
                            input</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckCheckedDisabled" checked="" disabled="">
                        <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Disabled
                            checked switch
                            checkbox input</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Application Settings</h4>
                </div>
                <div class="card-body">
                    <!-- <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="theme" id="theme" disabled>
                            <label class="form-check-label" for="theme"> Dark Theme </label>
                    </div> -->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="sidebar_btn" name="sidebar_btn" >
                        <label class="form-check-label" for="sidebar_btn"> Always show sidebar </label>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
    </div>
</body>
<script>
$( document ).ready(function() {

    if (typeof(Storage) == "undefined") {
        console.log('Browser tidak didukung');
    } 

    
 
    let a;
    console.log(localStorage.getItem('sd'));

    if(localStorage.getItem('sd')==='yes')
    {
        a=true;
    }else
    {
        a=false;
    }

    $("#sidebar_btn").prop('checked', a);

    var switchStatus = $("#sidebar_btn").is(':checked');
   
    $("#sidebar_btn").on('change', function() {
        if ($(this).is(':checked')) {
            localStorage.setItem('sd','yes');
            console.log(localStorage.getItem('sd'));
        }
        else {
       
            localStorage.setItem('sd','no');
            console.log(localStorage.getItem('sd'));
        }
    });

   

});


</script>

</html>


