<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="updata.php">
        想修改的APP名稱:
        <input type="text" name="app名字"><br>
        新帳號:
        <input type="text" name="新帳號"><br>
        新密碼:
        <input type="text" name="新密碼"><br>
        <input type="submit" name="更新" value="修改">
        <input type="submit" name="return" formaction="index.php" value="返回">
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['更新'])) {
    $serverName = "暗月天使\SQLEXPRESS01";
    $connectionOptions = array(
        "Database" => "期末報告",
        "Uid" => "",
        "PWD" => "",
        "CharacterSet" => "UTF-8"
    );
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if (!$conn) {
        die(print_r(sqlsrv_errors(), true));
    }

    $appName = $_POST['app名字'];
    $newUsername = $_POST['新帳號'];
    $newPassword = $_POST['新密碼'];

    $sql = "UPDATE 帳號密碼表V2 SET 帳號 = ?, 密碼 = ? WHERE app名字 = ?";

    $params = array($newUsername, $newPassword, $appName);

    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $result = sqlsrv_execute($stmt);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "帳號和密碼已成功更新";
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['return'])) {
    header("Location: index.php");
    exit();
}
?>
