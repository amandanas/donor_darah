<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "donor_darah";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM pendonor WHERE id=$id");
    $row = $result->fetch_assoc();
}

// Update Data Pendonor
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $ttl = $_POST['ttl'];
    $gol_darah = $_POST['gol_darah'];
    $no_hp = $_POST['no_hp'];

    $query = "UPDATE pendonor SET nama='$nama', alamat='$alamat', ttl='$ttl', gol_darah='$gol_darah', no_hp='$no_hp' WHERE id=$id";
    $conn->query($query);
    header("Location: daftar_pendonor.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pendonor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Pendonor</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $row['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <input type="text" class="form-control" name="alamat" value="<?php echo $row['alamat']; ?>" required>
            </div>
            <div class="form-group">
                <label>Tempat, Tanggal Lahir:</label>
                <input type="date" class="form-control" name="ttl" value="<?php echo $row['ttl']; ?>" required>
            </div>
            <div class="form-group">
                <label>Golongan Darah:</label>
                <select class="form-control" name="gol_darah">
                    <option <?php if($row['gol_darah'] == 'A') echo 'selected'; ?>>A</option>
                    <option <?php if($row['gol_darah'] == 'B') echo 'selected'; ?>>B</option>
                    <option <?php if($row['gol_darah'] == 'AB') echo 'selected'; ?>>AB</option>
                    <option <?php if($row['gol_darah'] == 'O') echo 'selected'; ?>>O</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nomor HP:</label>
                <input type="text" class="form-control" name="no_hp" value="<?php echo $row['no_hp']; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="daftar_pendonor.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
