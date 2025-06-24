<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="Delete.php">
        欲刪除的APP名稱
        <input type="text" name="app名字"><br>
        <input type="submit" name="刪除資料" value="刪除帳密">
        <input type="submit" name="return" formaction="index.php" value="返回">
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['刪除資料'])) {
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
$idToDelete = $_POST['app名字']; 

$sql = "DELETE FROM 帳號密碼表V2 WHERE app名字= ?";

$params = array($idToDelete);

$stmt = sqlsrv_prepare($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$result = sqlsrv_execute($stmt);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "帳密已成功删除";
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['return'])) 
{
    header("Location: index.php");
    exit();
}
}
?>