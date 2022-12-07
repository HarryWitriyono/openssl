"<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rekord Mahasiswa</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>

<div class="container mt-3">
<?php 
  function enc($plaintext) {
	  $iv="1234567890111213";
	  $algo="aes-128-ctr";
	  $kunci=sha1("SIAKAD UMB");
	  $chipertext=openssl_encrypt($plaintext,$algo,$kunci,$option=0,$iv);
	  return $chipertext;
  }
  function dec($plaintext) {
	  $iv="1234567890111213";
	  $algo="aes-128-ctr";
	  $kunci=sha1("SIAKAD UMB");
	  $chipertext=openssl_decrypt($plaintext,$algo,$kunci,$option=0,$iv);
	  return $chipertext;
  }
   if (isset($_GET['NPM'])) {
	  $NPM=filter_var($_GET['NPM'],FILTER_SANITIZE_STRING);
	  $kon=mysqli_connect("localhost","root","","siakumb");
	  $sql="select * from mahasiswa where NPM='".$NPM."'";
	  $q=mysqli_query($kon,$sql);
	  $r=mysqli_fetch_array($q);
	  if ($r) {
	     echo '<div class="alert alert-success">
  <strong>Success!</strong> Rekord Mahasiswa siap dikoreksi !.
</div>';
	   } else { 
	     echo '<div class="alert alert-danger">
  <strong>Gagal!</strong> Rekord Mahasiswa gagal dikoreksi !.
</div>';   
	   }
  }
?>
  <h2>Rekord Mahasiswa</h2>
  <form action="" method="post">
    <div class="mb-3 mt-3">
      <label for="NPM">NPM:</label>
      <input type="text" class="form-control" id="NPM" placeholder="Enter NPM" name="NPM" required readonly value="<?php echo dec($r['NPM']);?>">
    </div>
	<div class="mb-3 mt-3">
      <label for="NamaMahasiswa">Nama Mahasiswa:</label>
      <input type="text" class="form-control" id="NamaMahasiswa" placeholder="Enter Nama Mahasiswa" name="NamaMahasiswa" required value="<?php echo dec($r['NamaMahasiswa']);?>">
    </div>
    <div class="mb-3">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required value="<?php echo dec($r['Password']);?>">
    </div>
	<div class="mb-3 mt-3">
      <label for="Alamat">Alamat:</label>
      <textarea class="form-control" rows="5" id="Alamat" name="Alamat" placeholder="Ketik Alamat"required><?php echo dec($r['Alamat']);?></textarea>
    </div>
    <button type="submit" class="btn btn-primary" name="bSimpan"><i class='fas fa-drum'></i>  Simpan Rekord Koreksi</button>
	<a href="daftarmhsw.php" class="btn btn-success" target="_blank"><i class='fas fa-user-graduate'></i> Lihat Daftar Mahasiswa</a>
	<a href="carimhsw.php" class="btn btn-success"><i class='fas fa-search'></i> Cari Mahasiswa</a>
  </form>
  <?php
  if (isset($_POST['bSimpan'])) {
	   $NPM=filter_var($_POST['NPM'],FILTER_SANITIZE_STRING);
	   $NamaMahasiswa=filter_var($_POST['NamaMahasiswa'],FILTER_SANITIZE_STRING);
	   $Password=filter_var($_POST['pswd'],FILTER_SANITIZE_STRING);
	   $Alamat=filter_var($_POST['Alamat'],FILTER_SANITIZE_STRING);
	   $kon=mysqli_connect("localhost","root","","siakumb");
	   $NPM=substr(enc($NPM),0,strlen(enc($NPM))-1);
	   $NamaMahasiswa=enc($NamaMahasiswa);
	   $Password=enc($Password);
	   $Alamat=enc($Alamat);
	   $sql="update mahasiswa set NamaMahasiswa='".$NamaMahasiswa."', Password='".$Password."', Alamat='".$Alamat."' Where NPM='".$NPM."'"; echo $sql;
	   $q=mysqli_query($kon,$sql);
	   if ($q) {
	     echo '<div class="alert alert-success">
  <strong>Success!</strong> Rekord Mahasiswa sukses tersimpan !.
</div>';
	   } else { 
	     echo '<div class="alert alert-danger">
  <strong>Gagal!</strong> Rekord Mahasiswa gagal tersimpan !.
</div>';   
	   }
	   echo "<script>window.location.href='inputmhs.php';</script>";
  }  
  ?>
</div>

</body>
</html>
