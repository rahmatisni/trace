<html>
<style>
	@import url('https://fonts.googleapis.com/css?family=Poppins&display=swap');

	* {
		padding: 0;
		margin: 0;
		box-sizing: border-box;
		font-family: 'Poppins';
		color: #FFFFFF;
		text-align: center;
	}

	body {
		background-color: #000000;
		background-image: url(<?=base_url("assets/images/bg/no-min.jpg")?>);

		/* Full height */
		height: 100%;
		/* Center and scale the image nicely */	
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}

	section.notFound {
		display: flex;
		justify-content: center;
		align-items: center;
		margin: 0 5%;
		height: 100vh;
	}

	section.notFound h1 {
		color: red;
		font-size: 100px;
	}

	section.notFound h2 {
		font-size: 50px;
	}

	section.notFound h1,
	h2,
	h3 {
		margin-bottom: 40px;
	}

	div.text {
		height: 50vh;
	}

	div.text a {
		text-decoration: none;
		margin-right: 20px;
	}

	div.text a:hover {
		color: red;
		text-decoration: underline;
	}

	@media only screen and (max-width: 768px) {
		section.notFound {
			flex-direction: column;
			justify-content: space-around;
		}

		section.notFound div.img img {
			width: 70vw;
			height: auto;
		}

		section.notFound h1 {
			font-size: 50px;
		}

		section.notFound h2 {
			font-size: 25px;
		}

		div.text a:active {
			color: red;
			text-decoration: underline;
		}
	}
</style>

<body>
	<section class="notFound">
		<h2>"Maaf anda tidak memiliki akses kuisioner"</h2>		
	</section>
</body>

</html>