<?php
session_start();

if(isset($_POST["btninquired"]))
{
  require("connect.php");
  $account = $_SESSION["userName"];
  $sql = <<< count
    select muse,money from mem where muse = '$account';
    count;
    $result = mysqli_query($link,$sql);
    $nowmon = mysqli_fetch_assoc($result);
    $mon = $nowmon["money"];
    echo "餘額剩餘:$mon";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <h1>會員使用介面</h1>
</head>
<body>
<form method="post">
<a href = "push.php" class = "btn btn-outline-info btn-md">存款</a>
<a href = "get.php" class = "btn btn-outline-info btn-md">提款</a>
<a href = "inquired.php" class = "btn btn-outline-info btn-md">查詢明細</a>
<input id="btninquired" name="btninquired" type="submit" class = "btn btn-outline-info btn-md" value="查詢餘額"></a>
</form>
</body>
</html>