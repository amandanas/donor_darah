<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "donor_darah";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambah Data Pendonor
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $ttl = $_POST['ttl'];
    $gol_darah = $_POST['gol_darah'];
    $no_hp = $_POST['no_hp'];
    
    $query = "INSERT INTO pendonor (nama, alamat, ttl, gol_darah, no_hp) VALUES ('$nama', '$alamat', '$ttl', '$gol_darah', '$no_hp')";
    $conn->query($query);
}

// Pencarian Data
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM pendonor WHERE nama LIKE '%$search%' OR gol_darah='$search'";
} else {
    $query = "SELECT * FROM pendonor";
}
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Donor Darah</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        img {
            width: 120px; /* Sesuaikan ukuran logo */
            margin-bottom: 10px;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <!-- Logo PMI -->
    <img src="images/logo_pmi.jpg" alt="Logo PMI">
        <h2>Pendaftaran Donor Darah</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <input type="text" class="form-control" name="alamat" required>
            </div>
            <div class="form-group">
                <label>Tempat, Tanggal Lahir:</label>
                <input type="date" class="form-control" name="ttl" required>
            </div>
            <div class="form-group">
                <label>Golongan Darah:</label>
                <select class="form-control" name="gol_darah">
                    <option>A</option>
                    <option>B</option>
                    <option>AB</option>
                    <option>O</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nomor HP:</label>
                <input type="text" class="form-control" name="no_hp" required>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>

        <h2 class="mt-4">Daftar Pendonor</h2>
        
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Cari berdasarkan nama/golongan darah" value="<?php echo $search; ?>">
            <button type="submit" class="btn btn-info">Cari</button>
        </form>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>TTL</th>
                    <th>Usia</th>
                    <th>Golongan Darah</th>
                    <th>No HP</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><?php echo $row['ttl']; ?></td>
                        <td><?php echo date_diff(date_create($row['ttl']), date_create('today'))->y; ?> tahun</td>
                        <td><?php echo $row['gol_darah']; ?></td>
                        <td><?php echo $row['no_hp']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
