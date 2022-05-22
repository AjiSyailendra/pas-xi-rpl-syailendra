<?php
// $conn = mysqli_connect("sql102.epizy.com", "epiz_31754745", "QvnLLgRtqEf", "epiz_31754745_syailendrapasxi");
$conn = mysqli_connect("localhost", "root", "", "crudsekolah");

// ambil data siswa / queri data siswa
$result = mysqli_query($conn, "SELECT * FROM siswa");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    // ambil data dari tiap elemen dalam form
    $nama = htmlspecialchars($data["nama"]);
    $jeniskelamin = htmlspecialchars($data["jeniskelamin"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $kelas  = htmlspecialchars($data["kelas"]);

    // query insert data
    $query = "INSERT INTO siswa VALUES ('', '$nama', '$jeniskelamin', '$alamat', '$kelas')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id = $data["id"];
    // ambil data dari tiap elemen dalam form
    $nama = htmlspecialchars($data["nama"]);
    $jeniskelamin = htmlspecialchars($data["jeniskelamin"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $kelas  = htmlspecialchars($data["kelas"]);

    // query insert data
    $query = "UPDATE siswa SET 
        nama = '$nama',
        jeniskelamin = '$jeniskelamin',
        alamat = '$alamat',
        kelas = '$kelas'
        
        WHERE id = $id;
        ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
