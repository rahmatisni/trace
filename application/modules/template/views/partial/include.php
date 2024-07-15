<!-- CSS -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="<?= base_url('assets/js/extensions/') ?>css2.css">
<link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap.css">
<link rel="stylesheet" href="<?= base_url('assets/vendors/iconly/') ?>bold.css">
<link rel="stylesheet" href="<?= base_url('assets/vendors/perfect-scrollbar/') ?>perfect-scrollbar.css">
<link rel="stylesheet" href="<?= base_url('assets/vendors/bootstrap-icons/') ?>bootstrap-icons.css">
<link rel="stylesheet" href="<?= base_url('assets/css/') ?>app.css">
<link rel="stylesheet" href="<?= base_url('assets/vendors/DataTables/') ?>datatables.css">
<link rel="stylesheet" href="<?= base_url('assets/vendors/choices.js/') ?>choices.min.css" />
<link rel="shortcut icon" href="<?= base_url('assets/images/') ?>favicon.svg" type="image/x-icon">
<link rel="stylesheet" href="<?= base_url('assets/vendors/sweetalert2/') ?>sweetalert2.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendors/fontawesome/') ?>all.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendors/DatePickerX/dist/css/') ?>DatePickerX.min.css">
<link rel="stylesheet" href="<?= base_url('assets/vendors/toastify/') ?>toastify.css">
<link rel="stylesheet" href="<?= base_url('assets/vendors/apexcharts/') ?>apexcharts.css">
<style>
    .toast-close {
        position: absolute;
        top: 0;
        right: 0;
        padding: 0;
        background-color: $white;
        line-height: 1;
        opacity: 1;
    }

    body {
        font-size: 0.875rem !important;
    }
</style>
<!-- JS -->
<script src="<?= base_url('assets/js/') ?>jquery-3.6.1.min.js"></script>
<script src="<?= base_url('assets/vendors/choices.js/') ?>choices.min.js"></script>
<script src="<?= base_url('assets/vendors/DataTables/') ?>datatables.js"></script>
<script src="<?= base_url('assets/vendors/perfect-scrollbar/') ?>perfect-scrollbar.min.js"></script>
<script src="<?= base_url('assets/js/') ?>bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/extensions/') ?>sweetalert21.js"></script>
<script src="<?= base_url('assets/js/') ?>moment.js"></script>
<script src="<?= base_url('assets/vendors/fontawesome/') ?>all.min.js"></script>
<script src="<?= base_url('assets/vendors/DatePickerX/dist/js/') ?>DatePickerX.min.js"></script>
<script src="<?= base_url('assets/vendors/toastify/') ?>toastify.js"></script>
<script src="<?= base_url('assets/vendors/apexcharts/') ?>apexcharts.js"></script>

<script>
    var base_url = "<?= base_url() ?>";

    function notif(text) {
        Toastify({
            text: text,
            duration: 50000,
            close: true,
            gravity: "top",
            position: "right",
            closePosition: "top right",
            backgroundColor: "#1f2d5a",
            onClick: function() {
                $('.notif').text('');
                console.log('hapus');
            }
        }).showToast();

    }

    function Notifikasi(item) {
        var a = $('.notif').text();
        console.log('masuk');
        console.log(a);
        if (a == '') {
            a = 0;
        }

        var jumlah = parseInt(a);
        $('.notif').text(jumlah + item);
        // var audio = document.getElementById('notif-sound');
        const audio = new Audio("https://freesound.org/data/previews/501/501690_1661766-lq.mp3");
        audio.play();
        setTimeout(() => {
            audio.pause();
            audio.currentTime = 0;
        }, 10000); // 10000 milliseconds = 10 seconds
    }


    $(".toast-close").on('click', function() {
        $('.notif').text('');
    });


    $(document).ready(function() {

        console.log(localStorage.getItem('sd'));

        if (localStorage.getItem('sd') == 'yes') {
            console.log('ada');
            document.getElementById('sidebar').classList.add('active');
            //document.getElementById('sidebar').classList.toggle('active');
        } else {
            // const audio = new Audio("https://freesound.org/data/previews/501/501690_1661766-lq.mp3");
            // audio.play();
            // setTimeout(() => {
            //     audio.pause();
            //     audio.currentTime = 0;
            // }, 10000); // 10000 milliseconds = 10 seconds
            console.log('tidak ada');
            document.getElementById('sidebar').classList.remove('active');
            //document.getElementById('sidebar').classList.toggle('active');
        }


    });
</script>