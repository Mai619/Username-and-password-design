<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form method="post" action="LoginPage.php">
        APP名稱
        <input type="text" name="app名字"><br>
        帳號
        <input type="text" name="帳號"><br>
        密碼
        <input type="text" name="密碼"><br>
        <input type="submit" name="載入" value="新增">
        <input type="submit" name="return" formaction="index.php" value="返回">
    </form>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['載入'])) {
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

    $app = $_POST["app名字"];
    $account = $_POST["帳號"];
    $password = $_POST["密碼"];

    $sql = "INSERT INTO 帳號密碼表V2 (app名字,帳號,密碼) VALUES (?, ?, ?)";
    $params = array($app, $account, $password);

    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the statement
    $result = sqlsrv_execute($stmt);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "儲存成功";
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