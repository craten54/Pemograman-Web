<!--
* NAMA  : STAN FREDHERIC
* NPM   : 140810230046
* KELAS : B
-->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mhs";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete'])) {
    $npm = $_GET['delete'];

    $sql = "DELETE FROM identitas WHERE npm='$npm'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus!');</script>";
    } else {
        echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    h1 {
        text-align: center;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }

    .data-table th, .data-table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    .data-table th {
        background-color: #f2f2f2;
    }

    .action-links a {
        color: black;
        text-decoration: none;
        margin: 5px;
    }

    .action-links a:hover {
        text-decoration: underline;
    }

    .insert-btn {
        display: block;
        margin: auto;
        padding: 10px;
        background-color: black;
        color: white;
        text-align: center;
        border: none;
        font-size: 16px;
        cursor: pointer;
        width: 200px;
        border-radius: 5px;
    }

    .insert-btn:hover {
        background-color: rgb(65, 65, 65);
    }
</style>

<h1>TABEL DATABASE MAHASISWA</h1>

<table class="data-table">
    <tr>
        <th>NPM</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Tanggal Lahir</th>
        <th>JK</th>
        <th>Email</th>
        <th>Update / Delete</th>
    </tr>
    
<?php
$sql = "SELECT * FROM identitas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["npm"]. "</td>";
        echo "<td>" . $row["nama"]. "</td>";
        echo "<td>" . $row["alamat"]. "</td>";
        echo "<td>" . $row["tgl_lhr"]. "</td>";
        echo "<td>" . $row["jk"]. "</td>";
        echo "<td>" . $row["email"]. "</td>";
        echo "<td class='action-links'>";
        echo "<a href='update.php?npm=" . $row["npm"] . "'>Update</a> | ";
        echo "<a href='crud.php?delete=" . $row["npm"] . "' onclick='return confirm(\"Yakin ingin menghapus?\")'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>Tidak ada data.</td></tr>";
}

$conn->close();
?>
</table>

<a href="insert.php"><button class="insert-btn">Tambah Data Mahasiswa</button></a>
