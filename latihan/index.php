<?php
	session_start();

	//hapus session
	session_destroy();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript">
		function harus_login(){
			var ok = confirm("Untuk melakukan reservasi, Anda harus login terlebih dahulu");

			if (ok) {
				window.location = "login.php";
			}
			else {
				window.location = "index.php";
			}
		}
	</script>
</head>
<body>
	<div class="wrapper" id="header">
		<div id="judul">
			<h1 id="nama-hotel">HOTEL SMK</h1>
		</div>
		<div id="menu">
			<a href="" class="a-menu">Home</a>
			<a href="" class="a-menu">Kamar</a>
			<a href="" class="a-menu">Fasilitas</a>
			<a href="" class="a-menu" id="a-login">Login</a>
		</div>
	</div>
	<div class="wrapper" id="banner">
		<img src="gambar/exterior.jpg" id="gmbr-banner">
	</div>

	<div class="wrapper" id="reservasi">
		<form action="" method="post">
			<div id="bagian1">
				<div class="form1">
					<label for="tgl-checkin">Tanggal Chekin</label>
					<input type="date" name="tgl-checkin" class="input-form1" id="tgl-checkin">
				</div>
				<div class="form1">
					<label for="tgl-checkout">Tanggal Chekout</label>
					<input type="date" name="tgl-checkout" class="input-form1" id="tgl-checkout">
				</div>
				<div class="form1">
					<label for="jumlah">Jumlah Kamar</label>
					<input type="number" name="jumlah" class="input-form1" id="jumlah">
				</div>
				
				<div class="form1" id="tombol">
					<a href="login.php" id="a-pesan">
						<div id="tombol-pesan">Pesan</div>
					</a>
				</div>
			</div>
			<div id="bagian2">
				<h1>Form Pemesanan</h1>
				<div class="form2">
					<label for="nama-pemesan">Nama Pemesanan</label>
					<input type="text" name="nama-pemesan" class="input-form2" id="nama-pemesan">
				</div>
				<div class="form2">
					<label for="email">Email</label>
					<input type="text" name="email" class="input-form2" id="email">
				</div>
				<div class="form2">
					<label for="no-handphone">No Handphone</label>
					<input type="text" name="no-handphone" class="input-form2" id="no-handphone">
				</div>
				<div class="form2">
					<label for="nama-tamu">Nama Tamu</label>
					<input type="text" name="nama-tamu" class="input-form2" id="nama-tamu">
				</div>
				<div class="form2">
					<label for="tipe-kamar">Tipe Kamar</label>
					<select name="tipe-kamar" class="input-form2">
						<option value="Superior">Superior</option>
						<option value="Deluxe">Deluxe</option>
						<option value="Grand Deluxe">Grand Deluxe</option>
						
					</select>
				</div>
				<div class="form2">
					<input type="submit" name="confirm" class="confirm-form2" value="Konfirmasi Pesanan">
				</div>

			</div>			
		</form>
	</div>

	<div class="wrapper" id="tentang">reservasi</div>
	<div class="wrapper" id="fasilitas">fasilitas</div>
	<div class="wrapper" id="kamar">kamar</div>
	<div class="wrapper" id="footer">footer</div>

</body>
</html>