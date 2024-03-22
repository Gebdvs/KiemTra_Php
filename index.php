<!DOCTYPE html>
<html>
<head>
    <title>Danh sách nhân viên</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<form method="post" action="">
        <input type="submit" name="login" value="Đăng nhập">
</form>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "qlnhansu";

session_start();

if(isset($_POST['login'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong FROM NHANVIEN";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Mã nhân viên</th><th>Tên nhân viên</th><th>Giới tính</th><th>Nơi Sinh</th><th>Mã phòng</th><th>Lương</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Ma_NV"] . "</td>";
        echo "<td>" . $row["Ten_NV"] . "</td>";
        echo "<td>" . $row["Phai"] . "</td>";
        echo "<td>" . $row["Noi_Sinh"] . "</td>";
        echo "<td>" . $row["Ma_Phong"] . "</td>";
        echo "<td>" . $row["Luong"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Không có dữ liệu.";
}
$conn->close();
?>

</body>
</html>
