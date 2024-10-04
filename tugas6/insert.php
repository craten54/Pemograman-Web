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

// Operasi Insert
if (isset($_POST['insert'])) {
    $npm = $_POST['NPM'];
    $nama = $_POST['NAMA'];
    $alamat = $_POST['ALAMAT'];
    $tgl_lhr = $_POST['TANGGAL_LAHIR'];
    $jk = $_POST['GENDER'];
    $email = $_POST['EMAIL'];

    $check_sql = "SELECT * FROM identitas WHERE NPM='$npm'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "<script>alert(NPM sudah ada. Silakan masukkan NPM yang berbeda.);</script>";
    } else {
        $sql = "INSERT INTO identitas (NPM, NAMA, ALAMAT, TANGGAL_LAHIR, GENDER, EMAIL) 
                VALUES ('$npm', '$nama', '$alamat', '$tgl_lhr', '$jk', '$email')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Data berhasil ditambah!');</script>";
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
}

$conn->close();
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        position: relative;
        min-height: 100vh;
    }

    h2 {
        text-align: center;
    }

    .form-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        max-width: 600px;
        margin: 0 auto;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .form-container input, .form-container label {
        margin-bottom: 15px;
        width: 100%;
    }

    .form-container label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-container input {
        padding: 8px;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .form-container .submit-btn {
        margin-top: 20px;
        text-align: center;
    }

    .form-container input[type="submit"] {
        padding: 12px 20px;
        background-color: black;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        width: 100%;
    }

    .form-container input[type="submit"]:hover {
        background-color: rgb(35, 34, 34);
    }

    .back-btn {
        display: block;
        margin: auto;
        margin-top: 15px;
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

    .back-btn:hover {
        background-color: rgb(35, 34, 34);
    }
</style>

<h2>Insert Data Mahasiswa</h2>
<form method="POST" action="" class="form-container">
    <label for="npm">NPM:</label>
    <input type="text" id="npm" name="npm" required>

    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" required>

    <label for="alamat">Alamat:</label>
    <input type="text" id="alamat" name="alamat" required>

    <label for="tgl_lhr">Tanggal Lahir:</label>
    <input type="date" id="tgl_lhr" name="tgl_lhr" required>

    <label for="jk">Jenis Kelamin:</label>
    <input type="text" id="jk" name="jk" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <div class="submit-btn">
        <input type="submit" name="insert" value="Tambah Data">
    </div>
</form>

<a href="crud.php"><button class="back-btn">Kembali</button></a>
