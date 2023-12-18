<?php
$host       = "localhost";
$user       = "root";
$password   = "";
$db         = "peminjaman_jas_lab";

$koneksi    = mysqli_connect($host, $user, $password, $db);

//cek koneksi
if(!$koneksi){
    die("Tidak bisa terkoneksi ke database");
}
$nama                   = "";
$nim                    = "";
$prodi                  = "";
$tanggal_peminjaman     = "";
$tanggal_pengembalian   = "";

$sukses                 = "";
$error                  = "";

if(isset($_POST['submit'])){
    $nama                           = $_POST['nama'];
    $nim                            = $_POST['nim'];
    $prodi                          = $_POST['prodi'];
    $tanggal_peminjaman             = $_POST['tanggal_peminjaman'];
    $tanggal_pengembalian           = $_POST['tanggal_pengembalian'];
    

    if($nama && $nim && $prodi && $tanggal_peminjaman && $tanggal_pengembalian){
        $sql1   = "INSERT INTO mahasiswa (nama, nim, prodi, tanggal_peminjaman, tanggal_pengembalian) VALUES ('$nama', '$nim', '$prodi', '$tanggal_peminjaman', '$tanggal_pengembalian')";
        $q1     = mysqli_query($koneksi,$sql1);
        
        if ($q1) {
            $sukses = "Berhasil memasukan data baru";
        } else {
            $error = "Gagal memasukan data. Error: " . mysqli_error($koneksi);
        }
        
    } else{
        $error = "Silahkan masukan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Menginput Data</title>
</head>
<body>
    <header>
        <h1>Peminjaman Jas Lab ITERA</h1>
    </header>
    <div class="container-form">
        <?php
            if($error){
            ?>
                <div class="alert-error">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    This is an alert box.
                    <?php echo $error ?>
                </div>
            <?php    
            }
        ?>
        <?php
            if($sukses){
            ?>
                <div class="alert-sukses">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    This is an alert box.
                    <?php echo $sukses ?>
                </div>
            <?php    
            }
        ?>
        <form action="create.php" method="post">
            <div class="group">
                <label for="nama">Nama: </label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Anda" value="<?php echo $nama?>">
            </div>
            <div class="group">
                <label for="nim">NIM: </label>
                <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukan NIM Anda" value="<?php echo $nim?>">
            </div>
            <div class="group">
                <label for="prodi">Prodi: </label>
                <input type="text" class="form-control" id="prodi" name="prodi" placeholder="Masukan prodi Anda" value="<?php echo $prodi?>">
            </div>
            <div class="group">
                <label for="tanggal_peminjaman">Tanggal Peminjaman: </label>
                <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" value="<?php echo $tanggal_peminjaman?>">
            </div>
            <div class="group">
                <label for="tanggal_pengembalian">Tanggal Pengembalian: </label>
                <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" value="<?php echo $tanggal_pengembalian?>">
            </div>
            <div class="button-form">
                <input class="button-submit" type="submit" name="submit" value="Submit" >
            </input>
        </form>
    </div>
</body>
</html>