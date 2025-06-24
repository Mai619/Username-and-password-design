<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="look.php">
        想查詢的APP名稱
        <input type="text" name="app名字"><br>
        <input type="submit" name="查詢資料" value="查詢帳密">
        <input type="submit" name="return" formaction="index.php" value="返回">
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['查詢資料'])) {
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

    $sql = "SELECT 帳號, 密碼 FROM 帳號密碼檢視表V2 WHERE app名字 = ?";

    $params = array($appName);

    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $result = sqlsrv_execute($stmt);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo "帳號: " . $row['帳號'] . "<br>";
            echo "密碼: " . $row['密碼'] . "<br>";
        }
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['return'])) {
    header("Location: index.php");
    exit();
}
?>
