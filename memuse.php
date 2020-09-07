<?php
session_start();

  require("connect.php");
  $account = $_SESSION["userName"];
  $sql = <<< count
    select muse,money from mem where muse = '$account';
    count;
    $result = mysqli_query($link,$sql);
    $nowmon = mysqli_fetch_assoc($result);
    $mon = $nowmon["money"];
    $_SESSION["money"] = $mon;
//header("Cache-control: private");
if(isset($_GET["btnhome"]))
{
  header("Location: index.php");
}
if(isset($_POST["btnedit"]))
{
  header("Location: edit.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>網銀</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel=stylesheet href="main.css">
</head>
<body>
<script>
    $(document).ready(function(){
      $(".hide").click(function(){
        $(".test").toggle();
      })
    });
</script>
<div id = "all">
<div class="header">
  <h1><?= $_SESSION["name"]."的網銀帳戶"?></h1>
   <h2>餘額顯示:<h2><p class="test ts"><?= $mon?></p>
    <form method="post">
      <a href = "inquired.php" class = "btn btn-outline-info btn-lg">查詢明細</a>
    </form>
    <button class = "hide btn btn-outline-info btn-lg bt" type="button">餘額隱藏</button>
<div>

<div class = "form1" >
  <form method="post">
    <h3>功能</h3>
    <a href = "push.php" class = "btn btn-outline-warning btn-lg">存款</a>
    <a href = "get.php" class = "btn btn-outline-warning btn-lg">提款</a>
    <a href = "give.php" class = "btn btn-outline-warning btn-lg">轉帳</a>
  </form>
</div>

<div class="form2">
 <form method= "post">
   <h3>修改會員資料</h3>
   <input id="btnedit" name="btnedit" type="submit" class = "btn btn-outline-danger btn-lg" value="修改資料">  
 </form>
<div>
<div class ="form3">
<form method= "get">
   <h3>切換帳號</h3>
   <input id="btnhome" name="btnhome" type="submit" class = "btn btn-outline-success btn-lg" value="登出">  
</form>
</div>
<div>
</body>
</html>