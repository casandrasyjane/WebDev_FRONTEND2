<!DOCTYPE html>
<html>

<?php
include "include/config.php";

if (isset($_POST["Simpan"])) {
    $destinasiKODE = $_POST['kodedestinasi'];
    $namadestinasi = $_POST['namadestinasi'];
    $destinasiKET = $_POST['destinasiket'];

$namafile = $_FILES['file']['name'];
$file_tmp = $_FILES['file']['tmp_name'];

$ekstensifile = pathinfo($namafile, PATHINFO_EXTENSION);

if(($ekstensifile == "jpg") or ($ekstensifile == "JPG") or ($ekstensifile == "png") or ($ekstensifile == "PNG")
        or ($ekstensifile == "JPEG") or ($ekstensifile == "jpeg")) {
    move_uploaded_file($file_tmp, 'images/' . $namafile);

    $kodekategori = $_POST['kodekategori'];

    mysqli_query($connection, "INSERT INTO destinasi (destinasiKODE, destinasiNAMA, destinasiKET, destinasiFOTO, kategoriKODE) VALUES ('$destinasiKODE', '$namadestinasi', '$destinasiKET', '$namafile', '$kodekategori')");


} else {
    echo "File must be in JPG, JPEG, or PNG format.";
}


}

$datakategori = mysqli_query($connection, "SELECT * FROM kategoriwisata");
?>



<head>
  <title>DESTINASI</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
</head>
<body>

<div class="row">
<div class="col-sm-1"></div>
<div class="col-sm-10">

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/airterjunlepo.jpg" class="d-block w-60 mx-auto" alt="Gambar Tidak Ada">
            <div class="carousel-caption d-none d-md-block">
                <h5>Wisata Alam Jogja</h5>
                <p>Air Terjun Lepo</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/goarancang.jpg" class="d-block w-60 mx-auto" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Hidden Gem Wisata Alam</h5>
                <p>Goa Rancang</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/balekambang.jpg" class="d-block w-60 mx-auto" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Pulau Malang yang Indah</h5>
                <p>Pantai Balekambang</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev" style="left: 5%">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next" style="right: 5%">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<style>
    .carousel-inner {
        margin-bottom: 30px;
    }
</style>

<form method="POST" enctype="multipart/form-data">


  <div class="mb-3 row">
    <label for="kodedestinasi" class="col-sm-2 col-form-label">Kode Destinasi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name= "kodedestinasi" id="kodedestinasi">
    </div>
  </div>

  <div class="mb-3 row">
    <label for="namadestinasi" class="col-sm-2 col-form-label">Nama Destinasi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name= "namadestinasi" id="namadestinasi">
    </div>
  </div>


  <div class="mb-3 row">
    <label for="destinasiket" class="col-sm-2 col-form-label">Keterengan Destinasi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name= "destinasiket" id="destinasiket">
    </div>
  </div>
  
  <div class="form-group row">
                    <label for="file" class="col-sm-2 col-form-label">Photo Destinasi</label>
                    <div class="col-sm-10">
                        <input type="file" id="file" name="file">
                        <p class="help-block">Field ini digunakan untuk unggah file</p>
                    </div>
                </div>



 <div class="mb-3 row">
  <label for="kodekategori" class="col-sm-2 col-form-label">Kategori Wisata</label>
      <div class="col-sm-10">
        <select class="form-control" name="kodekategori" id="kodekategori">
            <?php while($row = mysqli_fetch_array($datakategori))
{
?>
    <option value="<?php echo $row["kategoriKODE"]?>">
                                    
     <?php echo $row["kategoriKODE"]?>
         </option>
    <?php } ?>
    </select>
 </div>
  </div>


  <div class="form-group row">
      <div class="col-sm-2">
      </div>
      <div class="col-sm-10">
    <input type="submit" name="Simpan" value="Simpan" class="btn btn-secondary">
    <input type="button" class="btn btn-success" value="Batal" name="Batal">
  </div>
  </div>
</form>
<form method="post">
    <div class="form-group row mb-2 mt-3">
      <label for="search" class="col-sm-2">Nama Destinasi</label>
      <div class="col-sm-6">
        <input type="text" name="search" class="form-control" id="search" value="<?php if (isset($_POST["search"]))
        {echo $_POST["search"];}?>" placeholder="cari nama destinasi">
      </div>
      <input type="submit" name="kirim" value="cari" class="col-sm-1 btn btn-primary">
    </div>

</form>

<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Kode Destinasi</th>
      <th scope="col">Nama Destinasi</th>
	  <th scope="col">Keterangan Destinasi</th>
	  <th scope="col">Foto Destinasi</th>
      <th scope="col">Kode Kategori</th>
      <th colspan="2" style="text-align: center">Aksi</th>
    </tr>
  </thead>
  <tbody>

  <?php 

if (isset($_POST["kirim"]))
{
  $search = $_POST["search"];
  $query = mysqli_query($connection, " select destinasi.*from destinasi
      where destinasiNAMA like '%".$search."%'");}
    else{
      $query = mysqli_query($connection, "select destinasi.* from destinasi");}
      $nomor = 1;
      while($row = mysqli_fetch_array($query))
      {    
      ?>
    <tr>
      <th><?php echo $nomor;?></th>
      <td><?php echo $row['destinasiKODE'];?></td>
      <td><?php echo $row['destinasiNAMA'];?></td>
	  <td><?php echo $row['destinasiKET'];?></td>
	  <td>
                                <?php if (is_file("images/" . $row['destinasiFOTO'])) { ?>
                                    <img src="images/<?php echo $row['destinasiFOTO'] ?>" width="80">
                                <?php } else
                                    echo "<img src='images/noimage.png' width='80'>"
                                ?>
                            </td>
	  <td><?php echo $row['kategoriKODE'];?></td>
      <td width="5px">
        <a href="destinasiEDIT.php?ubah=<?php echo $row["destinasiKODE"]?>"
          class="btn btn-success btn-sm" title="EDIT">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
      </td>
      <td>        <a href="destinasiHAPUS.php?hapus=<?php echo $row["destinasiKODE"]?>"
          class="btn btn-danger btn-sm" title="HAPUS">

          <i class="bi bi-trash"></i></td>
    </tr>
    <?php $nomor = $nomor + 1; ?>
    <?php } ?>
  </tbody>
</table>
</div><!-- penutup class=col-sm-11-->
</div> <!--penutup class=row-->

</body>
</html>