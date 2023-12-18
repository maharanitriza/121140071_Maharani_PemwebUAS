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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Uas Pemweb</title>
</head>
<body>
    <header>
        <h1>Peminjaman Jas Lab ITERA</h1>
    </header>
    
    <section>
        <div class="container">
            <!-- Tabel Display Peminjaman -->
            <table>
                <div class="tabel-header">
                    <h3>Data Peminjam</h3>
                </div>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Aksi</th>
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
                            <td scope="row"><?php echo $nama++ ?></td>
                            <td scope="row"><?php echo $nim++ ?></td>
                            <td scope="row"><?php echo $prodi++ ?></td>
                            <td scope="row"><?php echo $tanggal_peminjaman++ ?></td>
                            <td scope="row"><?php echo $tanggal_pengembalian++ ?></td>
                            <td class="button-aksi">
                                <a href="read.php"><button class="button-detail">Detail</button></a>
                                <a href="update.php?op=edit&id=<?php echo $id?>"><button class="button-update">Update</button></a>
                                <a href="delete.php"><button class="button-delete">Delete</button></a>
                                
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
            <div class="button-addData">
                <button><a href="create.php">Pinjam Disini</a></button>
            </div>
        </div>
    </section>
</body>
</html>