<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cari Rekord Mahasiswa</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>

<div class="container mt-3">
  <h2>Cari Rekord Mahasiswa</h2>
  <form action="" method="post">
    <div class="mb-3 mt-3">
      <label for="NPM">NPM:</label>
      <input type="text" class="form-control" id="NPM" placeholder="Enter NPM" name="NPM" required>
    </div>
    <button type="submit" class="btn btn-primary" name="bSimpan"><i class='fas fa-search'></i> Cari Rekord Mahasiswa</button>
	<a href="daftarmhsw.php" class="btn btn-success" target="_blank"><i class='fas fa-user-graduate'></i> Lihat Daftar Mahasiswa</a>
	<a href="inputmhs.php" class="btn btn-success"><i class='fas fa-file'></i> Input Rekord Mahasiswa</a>
  </form>
  <?php 
  function enc($plaintext) {
	  $iv="1234567890111213";
	  $algo="aes-128-ctr";
	  $kunci=sha1("SIAKAD UMB");
	  $chipertext=openssl_encrypt($plaintext,$algo,$kunci,$option=0,$iv);
	  return $chipertext;
  }
  if (isset($_POST['bSimpan'])) {
	   $NPM=filter_var($_POST['NPM'],FILTER_SANITIZE_STRING);
	   $kon=mysqli_connect("localhost","root","","siakumb");
	   $NPM=substr(enc($NPM),0,strlen(enc($NPM))-1);
	   $sql="select * from mahasiswa Where NPM='".$NPM."'";
	   $q=mysqli_query($kon,$sql);
	   $r=mysqli_fetch_array($q);
	   if (!empty($r)) {
	     echo '<div class="alert alert-success">
  <strong>Success!</strong> Rekord Mahasiswa ditemukan !.
</div>';?>
<div class="container mt-3">
  <h2>Daftar Mahasiswa</h2>
  <p>Berikut ini daftar mahasiswa yang telah tersimpan di basis data:</p>            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No. / Aksi</th>
        <th>NPM</th>
        <th>Nama Mahasiswa</th>
		<th>Password</th>
		<th>Alamat</th>
      </tr>
    </thead>
    <tbody>
	<?php 
	 function dec($plaintext) {
	  $iv="1234567890111213";
	  $algo="aes-128-ctr";
	  $kunci=sha1("SIAKAD UMB");
	  $chipertext=openssl_decrypt($plaintext,$algo,$kunci,$option=0,$iv);
	  return $chipertext;
  }
     $kon=mysqli_connect("localhost","root","","siakumb");
	 $sql="select * from mahasiswa where NPM='".$NPM."'";
	 $q=mysqli_query($kon,$sql);
	 $r=mysqli_fetch_array($q);
	 do {
	?>
      <tr>
        <td><?php @$nmr++;echo $nmr;?>
		<a href="koreksimhsw.php?NPM=<?php echo $r['NPM'];?>" class="btn btn-info" title="Koreksi Rekord"><i class="fas fa-edit"></i></a>
		<a href="hapusmhsw.php?NPM=<?php echo $r['NPM'];?>" class="btn btn-danger" title="Hapus Rekord" onclick="return confirm('Yakin dihapus ?');"><i class="fas fa-trash"></i></a>
		</td>
        <td><?php echo dec($r['NPM']);?></td>
        <td><?php echo dec($r['NamaMahasiswa']);?></td>
		<td><?php echo dec($r['Password']);?></td>
		<td><?php echo dec($r['Alamat']);?></td>
      </tr>
	 <?php }while($r=mysqli_fetch_array($q)); ?>
    </tbody>
  </table>
</div>

<?php
	   } else { 
	     echo '<div class="alert alert-danger">
  <strong>Gagal!</strong> Rekord Mahasiswa tidak ditemukan !.
</div>';   
	   }
  }  
  ?>
</div>

</body>
</html>
