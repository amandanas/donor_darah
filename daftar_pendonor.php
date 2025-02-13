<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "donor_darah";

// Koneksi database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Hapus Data Pendonor
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM pendonor WHERE id=$id");
    header("Location: daftar_pendonor.php");
}

// Ambil Data Pendonor
$query = "SELECT * FROM pendonor";
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
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>TTL</th>
                    <th>Usia</th>
                    <th>Golongan Darah</th>
                    <th>No HP</th>
                    <th>Aksi</th>
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
                        <td>
                            <a href="edit_pendonor.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pendonor ini?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
