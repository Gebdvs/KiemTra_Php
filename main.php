<!DOCTYPE html>
<html>
<head>
    <title>Danh sách nhân viên</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#addBtn').click(function(){
                $('#addForm').show();
            });
            $('#closeBtn').click(function(){
                $('#addForm').hide();
            });
            $('.edit-btn').click(function(){
                var ma_nv = $(this).data('ma_nv');
                window.location.href = 'edit.php?ma_nv=' + ma_nv;
            });
            $('.delete-btn').click(function(){
                var ma_nv = $(this).data('ma_nv');
                if(confirm("Bạn có chắc chắn muốn xóa?")){
                    $.ajax({
                        type: 'POST',
                        url: '',
                        data: { delete: true, ma_nv: ma_nv },
                        success: function(response){
                            alert('Xóa thành công');
                            location.reload();
                        },
                        error: function(xhr, status, error){
                            alert('Lỗi xóa nhân viên');
                        }
                    });
                }
            });
        });
    </script>
</head>
<body>

<form method="post" action="">
    <input type="submit" name="logout" value="Đăng xuất" class="button">
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "qlnhansu";

session_start();
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['add'])) {
    $ma_nv = $_POST['ma_nv'];
    $ten_nv = $_POST['ten_nv'];
    $phai = $_POST['phai'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];

    $sql_insert = "INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES ('$ma_nv', '$ten_nv', '$phai', '$noi_sinh', '$ma_phong', '$luong')";
    
    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('Thêm nhân viên thành công');</script>";
        echo "<script>window.location.reload();</script>";
    } else {
        
    }
}
$sql = "SELECT Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong FROM NHANVIEN";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Mã nhân viên</th><th>Tên nhân viên</th><th>Giới tính</th><th>Nơi Sinh</th><th>Mã phòng</th><th>Lương</th><th>Thao tác</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Ma_NV"] . "</td>";
        echo "<td>" . $row["Ten_NV"] . "</td>";
        echo "<td>" . $row["Phai"] . "</td>";
        echo "<td>" . $row["Noi_Sinh"] . "</td>";
        echo "<td>" . $row["Ma_Phong"] . "</td>";
        echo "<td>" . $row["Luong"] . "</td>";
        echo "<td>
                <button class='edit-btn' data-ma_nv='" . $row["Ma_NV"] . "'>Sửa</button>
                <button class='delete-btn' data-ma_nv='" . $row["Ma_NV"] . "'>Xóa</button>
            </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Không có dữ liệu.";
}

$conn->close();
?>


<form method="post" action="">
    <button id="addBtn" type="button" class="button">Thêm nhân viên</button>
</form>

<div class="form-container" id="addForm" style="display: none;">
    <form method="post" action="">
        <input type="text" name="ma_nv" placeholder="Mã nhân viên" required><br>
        <input type="text" name="ten_nv" placeholder="Tên nhân viên" required><br>
        <input type="text" name="phai" placeholder="Giới tính" required><br>
        <input type="text" name="noi_sinh" placeholder="Nơi sinh" required><br>
        <input type="text" name="ma_phong" placeholder="Mã phòng" required><br>
        <input type="text" name="luong" placeholder="Lương" required><br>
        <input type="submit" name="add" value="Thêm" class="button">
        <button id="closeBtn" class="button">Đóng</button>
    </form>
</div>

</body>
</html>
