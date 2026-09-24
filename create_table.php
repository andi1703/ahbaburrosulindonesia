<?php
$mysqli = new mysqli("127.0.0.1", "root", "root", "ahbaburrosulcom", 8889);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$sql = "CREATE TABLE IF NOT EXISTS artikel (
    id_artikel INT AUTO_INCREMENT PRIMARY KEY,
    judul_artikel VARCHAR(255) NOT NULL,
    slug_artikel VARCHAR(255) NOT NULL,
    id_kategori INT NOT NULL,
    konten TEXT,
    gambar_cover VARCHAR(255),
    status VARCHAR(50) DEFAULT 'Draft',
    tanggal_dibuat DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($mysqli->query($sql) === TRUE) {
    echo "Table 'artikel' created successfully";
} else {
    echo "Error creating table: " . $mysqli->error;
}

$mysqli->close();
?>
