<?php
// เชื่อมต่อกับฐานข้อมูล MySQL
$host = "localhost";
$user = "root";
$password = "";
$database = "user_registration";

$conn = new mysqli($host, $user, $password, $database);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลจากฐานข้อมูล
$query = "SELECT company_name FROM db_checker";
$result = $conn->query($query);

// เก็บข้อมูลในรูปแบบ JSON
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row['company_name'];
}

// ปิดการเชื่อมต่อ MySQL
$conn->close();

// ส่งข้อมูลในรูปแบบ JSON กลับไปยัง JavaScript
echo json_encode($data);
?>
