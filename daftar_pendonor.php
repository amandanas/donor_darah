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

// Pencarian Data
$search = "";
$query = "SELECT * FROM pendonor"; // Default menampilkan semua data

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM pendonor WHERE nama LIKE '%$search%' OR gol_darah LIKE '%$search%'";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pendonor</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        img {
            width: 180px; /* Sesuaikan ukuran logo */
            margin-bottom: 10px;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <!-- Logo PMI -->
        <img src="images/logo_pmi.jpg" alt="Logo PMI">
        <h2>Daftar Pendonor</h2>

        <!-- Form Pencarian -->
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Cari berdasarkan nama/golongan darah" value="<?php echo $search; ?>">
            <button type="submit" class="btn btn-info">Cari</button>
            <a href="daftar_pendonor.php" class="btn btn-warning">Tampilkan Semua</a>
        </form>

        <!-- Tabel Daftar Pendonor -->
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
