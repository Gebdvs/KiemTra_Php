<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "qlnhansu";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_GET['ma_nv'])) {
    $ma_nv = $_GET['ma_nv'];

 
    $sql = "SELECT * FROM NHANVIEN WHERE Ma_NV='$ma_nv'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ten_nv = $row['Ten_NV'];
        $phai = $row['Phai'];
        $noi_sinh = $row['Noi_Sinh'];
        $ma_phong = $row['Ma_Phong'];
        $luong = $row['Luong'];
    } else {
        echo "Không tìm thấy nhân viên";
        exit;
    }
} else {
    echo "Mã nhân viên không được cung cấp";
    exit;
}
if(isset($_POST['edit'])) {
    $ten_nv = $_POST['ten_nv'];
    $phai = $_POST['phai'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];
    $sql_update = "UPDATE NHANVIEN SET Ten_NV='$ten_nv', Phai='$phai', Noi_Sinh='$noi_sinh', Ma_Phong='$ma_phong', Luong='$luong' WHERE Ma_NV='$ma_nv'";
    if ($conn->query($sql_update) === TRUE) {
        header("Location: main.php");
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa thông tin nhân viên</title>
</head>
<body>
    <h2>Chỉnh sửa thông tin nhân viên</h2>
    <form id="editForm" method="post" action="">
        <input type="hidden" name="ma_nv" value="<?php echo $ma_nv; ?>">
        <label for="ten_nv">Tên nhân viên:</label><br>
        <input type="text" name="ten_nv" value="<?php echo $ten_nv; ?>"><br>
        <label for="phai">Giới tính:</label><br>
        <input type="text" name="phai" value="<?php echo $phai; ?>"><br>
        <label for="noi_sinh">Nơi sinh:</label><br>
        <input type="text" name="noi_sinh" value="<?php echo $noi_sinh; ?>"><br>
        <label for="ma_phong">Mã phòng:</label><br>
        <input type="text" name="ma_phong" value="<?php echo $ma_phong; ?>"><br>
        <label for="luong">Lương:</label><br>
        <input type="text" name="luong" value="<?php echo $luong; ?>"><br>
        <input type="submit" name="edit" value="Lưu">
    </form>
</body>
</html>
