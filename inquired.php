<?php
 session_start();
 require("connect.php");
 $acount = $_SESSION["userName"];

 $sql = <<< detail
  select `change`,`date` from `moneylist` where memberId 
  in (select memberId from mem where `muse`='$acount');
 detail;

 $result = mysqli_query($link,$sql);

 



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
</head>
<body>

<div class="container">
    <h2>明細查詢</h2>
  <table class="table table-dark">
    <thead>
      <tr>
        <th>金額</th>
        <th>日期</th>
      </tr>
    </thead>
    <tbody>
     <?php while($row = mysqli_fetch_assoc($result)){?>
      <tr>
        <td><?= $row["change"]?></td>
        <td><?= $row["date"]?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>