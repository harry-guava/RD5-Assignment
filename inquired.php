<?php
session_start();
require "connect.php";
$acount = $_SESSION["userName"];

$sql = <<< detail
  select `move`,`usemoney`,`date`,`money` from `moneylist` where `memberId`
  in (select memberId from mem where `muse`='$acount') order by date DESC;
 detail;

$result = mysqli_query($link, $sql);

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
  <style>
    .back
    {
      background-color:#c1eff7 ;

    }
  </style>
</head>
<body class="back">

<div class="container">
    <h2>明細查詢</h2>
    <p>查詢時間:<?php date_default_timezone_set("Asia/Taipei");
    echo date("Y-m-d h:i:sa");?> 
    </p>
    <a href = "memuse.php" class = "btn btn-warning">返回首頁</a>
  <table class="table table-dark">
    <thead>
      <tr>
        <th>操作</th>
        <th>金額</th>
        <th>餘額</th>
        <th>日期</th>
      </tr>
    </thead>
    <tbody>
     <?php while ($row = mysqli_fetch_assoc($result)) {?>
      <tr>
        <td color=><?=$row["move"]?></td>
        <td><font color="<?php if ($row["move"] == '存款') {?>
          <?="green"?><?php } else {?>
          <?="red"?><?php }?>">
          <?=$row["usemoney"]?></font></td>
        <td><?="$".$row["money"]."元"?></td>
        <td><?=$row["date"]?></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
</div>

</body>
</html>