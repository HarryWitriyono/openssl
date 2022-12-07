<!DOCTYPE html>
<html lang="en">
<head>
  <title>Daftar Mahasiswa</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body onload="print()">

<div class="container mt-3">
  <h2>Daftar Mahasiswa</h2>
  <p>Berikut ini daftar mahasiswa yang telah tersimpan di basis data:</p>            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
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
	 $sql="select * from mahasiswa";
	 $q=mysqli_query($kon,$sql);
	 $r=mysqli_fetch_array($q);
	 do {
	?>
      <tr>
        <td><?php @$nmr++;echo $nmr;?></td>
        <td><?php echo dec($r['NPM']);?></td>
        <td><?php echo dec($r['NamaMahasiswa']);?></td>
		<td><?php echo dec($r['Password']);?></td>
		<td><?php echo dec($r['Alamat']);?></td>
      </tr>
	 <?php }while($r=mysqli_fetch_array($q)); ?>
    </tbody>
  </table>
</div>

</body>
</html>
