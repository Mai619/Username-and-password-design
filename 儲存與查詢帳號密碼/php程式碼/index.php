<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="index.php">
        <input type="submit" name="增加資料" value="新增帳密">
        <input type="submit" name="刪除資料" value="刪除帳密">
        <input type="submit" name="修改資料" value="變更帳密">
        <input type="submit" name="查詢資料" value="查詢帳密">
    </form>
</body>
</html>
<?php
if(isset($_POST['增加資料'])) {
    header("Location: LoginPage.php");
    exit();
}

if(isset($_POST['刪除資料'])) {
    header("Location: Delete.php");
    exit();
}
if(isset($_POST['修改資料'])) {
    header("Location: updata.php");
    exit();
}
if(isset($_POST['查詢資料'])) {
    header("Location: look.php");
    exit();
}
?>