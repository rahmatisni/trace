<html lang="en">
    <head>
        <style>
			label{
				font-size:16px;
			}
          .img_credit{
            background:red;
          }

          .img_dev {
            display: block;
            margin-left: auto;
            margin-top: -80px;
            }
			.bok{
				display:block;
				padding: 15px;
				width:80%;
				background-color: #104068;	
				color:white;
				text-align: center;
			}
			.cat {
				margin: 4px;
				background-color: #104068;
				border-radius: 4px;
				border: 1px solid #fff;
				overflow: hidden;
				float: left;
				text-align: center;
			}

			.cat label {
				padding-left: 10px;
				float: left;
				line-height: 3.0em;
				width: auto;
				height: 3.0em;
				color:white;
			}

			.cat label span {
				text-align: center;
				padding: 3px 0;
				display: block;
			}

			.cat label input {
				position: absolute;
				display: none;
				color: #fff !important;
			}

			/* selects all of the text within the input element and changes the color of the text */
			.cat label input+span {
				color: #fff;
			}


			/* This will declare how a selected input will look giving generic properties */
			.cat input:checked+span {
				color: #ffffff;
				text-shadow: 0 0 6px rgba(0, 0, 0, 0.8);
			}

			.crime input:checked+span {
				background-color: #D9D65D;
			}
        </style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trace : Track N Care</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&amp;display=swap" rel="stylesheet">
		<link rel="stylesheet" href="<?= base_url('assets/vendors/sweetalert2/')?>sweetalert2.min.css">
        <link rel="stylesheet" href="<?= base_url('assets/css/')?>bootstrap.css">
        <link rel="stylesheet" href="<?= base_url('assets/vendors/bootstrap-icons/')?>bootstrap-icons.css">
        <link rel="stylesheet" href="<?= base_url('assets/css/')?>app.css">
		<script src="<?= base_url('assets/js/')?>jquery-3.6.1.min.js"></script>
		<script src="<?= base_url('assets/vendors/rater-js/')?>rater-js.js"></script>
		<script src="<?= base_url('assets/js/extensions/')?>sweetalert21.js"></script>
		

    </head>

<body>

    <div class="container">
		<div class="card mt-5">
			<div class="card-content">
				<img class="card-img-top img-fluid" src="<?= base_url('assets/images/bg/')?>banner.png" alt="banner kuesioner" style="height: 10rem">
				<div class="card-body">
					<center>
						<h2>Kuisioner Kepuasan Layanan Petugas Jalan Tol Jasa Marga Group</h2>
						<br>

						<h3>Hi, <?=$profile->laporan_name?></h3><br>

						<h5 class="mb-3">Yuk Kasi Rating Ke Petugas Kami.</h5>
						<h3>(1 Kecewa, 5 Mantap !)</h3>
						<div class="mb-3 mt-3" id="rater"></div>
						<br>
						<div class="puas">
							<h5 class="mb-3 mt-2" id="txt_kepuasan">Jika anda merasa puas, hal apa yang membuat anda merasa puas dengan pelayanan kami ?<br>(dapat memilih lebih dari satu)</h5>
							<div class="mb-3 mt-4">
								<ul class="list-unstyled mb-0 postif">
									<li class="d-inline-block mb-1 me-2 bok">
										<div class="form-check">
											<input type="checkbox" aria-label="an appropriate label" class="form-check-input form-check-primary form-check-success" value="Petugas Ramah" name="pos" id="pos1">
											<label class="form-check-label" for="pos1">Petugas Ramah</label>
										</div>
									</li>
									<li class="d-inline-block mb-1 me-2 bok">
										<div class="form-check">
											<input type="checkbox" class="form-check-input form-check-primary form-check-success"  value="Petugas Tepat Waktu" name="pos" id="pos2">
											<label class="form-check-label" for="pos2">Petugas Tepat Waktu</label>
										</div>
									</li>
									<li class="d-inline-block mb-1 me-2 bok">
										<div class="form-check">
											<input type="checkbox" class="form-check-input form-check-primary form-check-success"  value="Petugas Kompeten" name="pos" id="pos3">
											<label class="form-check-label" for="pos3">Petugas Kompeten</label>
										</div>
									</li>
									<li class="d-inline-block mb-1 me-2 bok">
										<div class="form-check">
											<input type="checkbox" class="form-check-input form-check-primary form-check-success"  value="Tarif Sudah Sesuai" name="pos" id="pos4">
											<label class="form-check-label" for="pos4">Tarif Sudah Sesuai</label>
										</div>
									</li>
									<li class="d-inline-block mb-1 me-2 bok">
										<div class="form-check">
											<input type="checkbox" class="form-check-input form-check-primary form-check-success" value="Lain - lain" name="pos" id="pos5">
											<label class="form-check-label" for="pos5">Lain - lain</label>
										</div>
									</li>
								</ul>
									
							</div>
							
						</div>
						<div class="tidakpuas">
							<h5 class="mb-3 mt-2" id="txt_kepuasan">Jika anda merasa kurang puas, hal apa yang membuat anda kurang puas ?<br>(dapat memilih lebih dari satu)</h5>
							<div class="mb-3 mt-4">
								<ul class="list-unstyled mb-0 postif">
									<li class="d-inline-block mb-1 me-2 bok">
										<div class="form-check">
											<input type="checkbox" aria-label="an appropriate label" class="dis form-check-input form-check-primary form-check-success" value="Petugas Tidak Ramah" name="dis" id="dis1">
											<label class="form-check-label" for="dis1">Petugas Tidak Ramah</label>
										</div>
									</li>
									<li class="d-inline-block mb-1 me-2 bok">
										<div class="form-check">
											<input type="checkbox" class="pos dis form-check-input form-check-primary form-check-success"  value="Petugas Lama Datang" name="dis" id="dis2">
											<label class="form-check-label" for="dis2">Petugas Lama Datang</label>
										</div>
									</li>
									<li class="d-inline-block mb-1 me-2 bok">
										<div class="form-check">
											<input type="checkbox" class="dis pos form-check-input form-check-primary form-check-success"  value="Tidak Kompeten" name="dis" id="dis3">
											<label class="form-check-label" for="dis3">Tidak Kompeten</label>
										</div>
									</li>
									<li class="d-inline-block mb-1 me-2 bok">
										<div class="form-check">
											<input type="checkbox" class="dis form-check-input form-check-primary form-check-success"  value="Tarif Tidak Sesuai" name="dis" id="dis4">
											<label class="form-check-label" for="dis4">Tarif Tidak Sesuai</label>
										</div>
									</li>
									<li class="d-inline-block mb-1 me-2 bok">
										<div class="form-check">
											<input type="checkbox" class="dis form-check-input form-check-primary form-check-success"  value="Lain - lain" name="dis" id="dis5">
											<label class="form-check-label" for="dis5">Lain - lain</label>
										</div>
									</li>
								</ul>
							</div>
						</div>
						
		
						<div class="mb-2">
							<textarea style="width:100%; height:30%;" maxlength="200" rows="5" class="form-control" placeholder="Tulis keluhan kamu disini (200 Karakter)" id="txtarea_keluhan"></textarea>
						</div>
						<div class="mt-4 mb-4">
							<textarea style="width:100%; height:30%;" maxlength="200" rows="5" class="form-control" placeholder="Tulis saran kamu disini (200 Karakter)" id="txtarea_saran"></textarea>
						</div>
						<div class="row mb-3">
							<button id="btnSubmit" class="btn btn-lg btn-primary block">Submit</button>
						</div>
						
					</center>
				</div>
			</div>
		</div>
        
    
    </div>
</body>
<script>
var rating_global = 0;
$(document).ready(function(){
	$(".tidakpuas").hide();
	$(".puas").hide();
	$("#txtarea_keluhan").hide();
	var feedback=[];

	window.raterJs({
		element: document.querySelector("#rater"), 
		starSize: 40,
		max_value: 5,
		step_size: 1,
		rateCallback:function rateCallback(rating, done) {
			this.setRating(rating); 
			done(); 
			rating_global=rating;
			//console.log(rating);
			if(parseInt(rating) <=3 )
			{
				$(".tidakpuas").show();
				$(".puas").hide();
				$( "#pos5" ).prop( "checked", false );
				$("#txtarea_keluhan").hide();
				$("input[type='checkbox']").prop( "checked", false );
				feedback=[];
			}else
			{
				$(".tidakpuas").hide();
				$(".puas").show();
				$( "#dis5" ).prop( "checked", false );
				$("#txtarea_keluhan").hide();
				$("input[type='checkbox']").prop( "checked", false );
				feedback=[];
			}
			
			if (event.cancelable) event.preventDefault();
		}
	});

	
	$("input[type='checkbox']").click(function() {

		if(this.checked)
		{
			feedback.push(this.value);
			console.log(feedback);
		}
		else
		{	
			feedback.pop(this.value);
			console.log(feedback);
		}

	});

	$("#pos5,#dis5").change(function(){
		if(this.checked)
		{
			$("#txtarea_keluhan").show();
		}else
		{
			$("#txtarea_keluhan").hide();
		}
	});
	
	
	$("#btnSubmit").click(function(){
		
		var keluhan=$('#txtarea_keluhan').val();
		var saran=$('#txtarea_saran').val();
		console.log(rating_global,feedback,saran,keluhan);

		if(rating_global<1)
		{
			Swal.fire(
				'Mohon Maaf',
				'Mohon berikan rating terlebih dahulu',
				'info'
			);

			return false;
		}


		var url = `<?=base_url()?>`+ '/kuesioner/submitFeedback';


		$.ajax({
			url: url,
			type: "POST",
			data: {id:id,rating:rating_global,feedback:feedback,saran:saran,keluhan,keluhan },
			beforeSend: function() {
				$('.loading').show();
			},
			success: function (response) {

				console.log(response);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus, errorThrown);
			}
		});



	});

});

</script>

</html>