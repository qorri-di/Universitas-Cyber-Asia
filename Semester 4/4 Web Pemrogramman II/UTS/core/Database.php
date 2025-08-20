<?php
$host = 'localhost';
$port = '5432';
$dbname = 'siakad';
$user = 'postgres';
$password = 'root';

// Membuat koneksi
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Memeriksa apakah koneksi berhasil
if (!$conn) {
    die("Koneksi gagal: " . pg_last_error());
}

// Menutup koneksi
pg_close($conn);