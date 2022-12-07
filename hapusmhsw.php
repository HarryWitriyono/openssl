<!DOCTYPE html>
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
  if (isset($_GET['NPM'])) {
	  $NPM=filter_var($_GET['NPM'],FILTER_SANITIZE_STRING);
	  $kon=mysqli_connect("localhost","root","","siakumb");
	  $sql="delete from mahasiswa where NPM='".$NPM."'";
	  $q=mysqli_query($kon,$sql);
	  if ($q) {
	     echo '<div class="alert alert-success">
  <strong>Success!</strong> Rekord Mahasiswa sukses dihapus !.
</div>';
	   } else { 
	     echo '<div class="alert alert-danger">
  <strong>Gagal!</strong> Rekord Mahasiswa gagal dihapus !.
</div>';   
	   }
  }
?>
<a href="inputmhs.php" class="btn btn-info"><i class="fas fa-input"></i> Input Rekord Mahasiswa</a>
<a href="inputmhs.php" class="btn btn-success"><i class="fas fa-search"></i>Cari Rekord Mahasiswa</a>
</div>

</body>
</html>