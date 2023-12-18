<?php
$host       = "localhost";
$user       = "root";
$password   = "";
$db         = "peminjaman_jas_lab";

$koneksi    = mysqli_connect($host, $user, $password, $db);


//untuk create
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}
$nama                   = "";
$nim                    = "";
$prodi                  = "";
$tanggal_peminjaman     = "";
$tanggal_pengembalian   = "";

$sukses                 = "";
$error                  = "";

if(isset($_GET['op'])){
    $op = $_GET['op'];
} else{
    $op = "";
}

if($op == 'edit'){
    $id     = $_GET['id'];
    $sql1   = "SELECT * FROM mahasiswa WHERE id = '$id'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $nama                   = $r1['nama'];
    $nim                    = $r1['nim'];
    $prodi                  = $r1['prodi'];
    $tanggal_peminjaman     = $r1['tanggal_peminjaman'];
    $tanggal_pengembalian   = $r1['tanggal_pengembalian'];

    if($nim == ''){
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['submit'])) {
    $nama                           = $_POST['nama'];
    $nim                            = $_POST['nim'];
    $prodi                          = $_POST['prodi'];
    $tanggal_peminjaman             = $_POST['tanggal_peminjaman'];
    $tanggal_pengembalian           = $_POST['tanggal_pengembalian'];


    if ($nama && $nim && $prodi && $tanggal_peminjaman && $tanggal_pengembalian) {
        $sql1   = "INSERT INTO mahasiswa (nama, nim, prodi, tanggal_peminjaman, tanggal_pengembalian) VALUES ('$nama', '$nim', '$prodi', '$tanggal_peminjaman', '$tanggal_pengembalian')";
        $q1     = mysqli_query($koneksi, $sql1);

        if ($q1) {
            $sukses = "Berhasil memasukan data baru";
        } else {
            $error = "Gagal memasukan data. Error: " . mysqli_error($koneksi);
        }
    } else {
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
    <title>Document</title>
</head>

<body>
    <header>
        <h1>Peminjaman Jas Lab ITERA</h1>
    </header>
    <section>
        <div class="container-update">
            <div class="form-update">
                <form action="update.php" method="post">
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
            <table class="tabel-update">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Prodi</th>
                    <th scope="col">Tanggal Peminjaman</th>
                    <th scope="col">Tanggal Pengembalian</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql2   = "SELECT * FROM mahasiswa order by id desc";
                    $q2     = mysqli_query($koneksi,$sql2);
                    $urut   = 1;
                    while($r2 = mysqli_fetch_array($q2)){
                        $id                     = $r2['id'];
                        $nama                   = $r2['nama'];
                        $nim                    = $r2['nim'];
                        $prodi                  = $r2['prodi'];
                        $tanggal_peminjaman     = $r2['tanggal_peminjaman'];
                        $tanggal_pengembalian   = $r2['tanggal_pengembalian'];
                        
                        ?>
                        <tr>
                            <td scope="row"><?php echo $urut++ ?></td>
                            <td scope="row"><?php echo $nama ?></td>
                            <td scope="row"><?php echo $nim ?></td>
                            <td scope="row"><?php echo $prodi ?></td>
                            <td scope="row"><?php echo $tanggal_peminjaman ?></td>
                            <td scope="row"><?php echo $tanggal_pengembalian ?></td>

                            <td class="button-aksi">
                                <a href="update.php?op=edit&id=<?php echo $id?>"><button class="button-update">Update</button></a>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
        </div>
    </section>
</body>

</html>