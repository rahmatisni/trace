<style>

.form-control:disabled, .form-control[readonly] {
    background-color: #fff;
    opacity: 1;
}

</style>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Rekapitulasi Penilaian Petugas</h3>
                <p class="text-subtitle text-muted">Melihat penilaian petugas dari seluruh area.</p>
            </div>
            
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Filtering Report</h4>
                <hr>
            </div>
            <div class="card-body">
                <form id="formReport" method="POST" action="<?=base_url('management/reporting_export')?>">
                <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Jenis Report :</label>
                                <select class="form-select" id="jenis" name="jenis" required>
                                    <option value="" disabled="" selected>Pilih Jenis Report</option>
                                    <option value="1">Laporan Masuk</option>
                                    <option value="2">Laporan Detail Petugas </option>
                                    <option value="3">Laporan Summary Petugas  </option>
                                    <!-- <option value="2">Response Time</option>
                                    <option value="3">Rating Feedback</option>
                                    <option value="4">Permintaan Bantuan</option>
                                    <option value="5">Waktu Penanganan</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Ruas :</label>
                                <select class="form-select" id="ruas" name="ruas" required>
                                <option value="" disabled="" selected="">Pilih Ruas</option>
                                    <option value="0">All Ruas</option>
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
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Dari Tanggal :</label>
                                <input type="text" id="tgl1" class="form-control date" placeholder="-" name="tgl1" required>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Sampai Tanggal :</label>
                                <input type="text" id="tgl2" class="form-control date" placeholder="-" name="tgl2" required>
                            </div>
                        </div>
                
                </div>
                <div class="form-actions d-flex justify-content-end mt-4">
                   
                    <button type="submit" id="btnExport" class="btn btn-success me-1"><i class="fa fa-file-excel"></i> Download Excel</button>
                    
                </div>
                </form>
            </div>
                

        </div>
    </section>
</div>
<script>
$( document ).ready(function() {
    //console.log( "ready!" );

    //const ruasChoices = new Choices($('#ruas')[0]);

    var options={
        mondayFirst      : true,
        format           : 'yyyy-mm-dd',
        minDate          : new Date(0, 0),
        maxDate          : new Date(9999, 11, 31),
        weekDayLabels    : ['Mo', 'Tu', 'We', 'Th', 'Fr', 'St', 'Su'],
        shortMonthLabels : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        singleMonthLabels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        todayButton      : true,
        todayButtonLabel : 'Today',
        clearButton      : true,
        clearButtonLabel : 'Clear'
    }

    document.getElementById('tgl1').DatePickerX.init(options);
    document.getElementById('tgl2').DatePickerX.init(options);


    // $('#formReport').submit(function() {
    //     var tg1 =  document.getElementById('tgl1').DatePickerX.getValue();  
    //     var tg2 =  document.getElementById('tgl2').DatePickerX.getValue();  
        
    //     if(tgl1 !=' ')
    //     console.log(tgl1);
    //     // your code here
    // });

    // $("#btnExport").click(function(){
        
    //     var tgl1= $("#tgl1").val();
    //     var tgl2= $("#tgl2").val();
    //     var option= $("#option").val();
    //     //console.log(tgl1,tgl2,option);
        
    //     var url = base_url + 'management/reporting_export';

    //     $.ajax({
    //         url: url,
    //         method: "POST",
    //         data: {tgl1:tgl1,tgl2:tgl2,option:option},
    //         beforeSend: function() {
    //             //$('#addLaporan').prop('disabled', true);
    //         },
    //         success: function(response) {
    //             console.log(response);

    //         }
    //     });



    // });







});




</script>