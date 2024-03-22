<?php
session_start();

if(isset($_SESSION['username'])) {
    header("Location: main.php");
    exit;
}

$message = '';

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'qlnhansu');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];
        header("Location: main.php");
        exit;
    } else {
        $message = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" action="">
        <h2>Đăng nhập</h2>
        <?php if($message != '') { ?>
            <div class="message"><?php echo $message; ?></div>
        <?php } ?>
        <input type="text" name="username" placeholder="Tên đăng nhập" required><br>
        <input type="password" name="password" placeholder="Mật khẩu" required><br>
        <input type="submit" name="login" value="Đăng nhập">
    </form>
</body>
</html>