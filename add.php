<?php
session_start();
if (isset($_POST["addsub"])) {
    $adname = $_POST["addname"];
    $adus = $_POST["addacc"];
    $adiden = $_POST["addiden"];
    $adpswd = $_POST["addpswd"];
    $addmoney = $_POST["addmon"];
    if (trim(($adname && $adus && $adpswd && $addmoney && $adiden) != "")) {
        require "connect.php";
        $chkus = "select muse from mem where `muse` = '$adus'";
        $chkresult = mysqli_query($link, $chkus);
        $checkus = mysqli_num_rows($chkresult);
        $chkid = "select iden from mem where `iden` = '$adiden'";
        $chkidresult = mysqli_query($link, $chkid);
        $checkid = mysqli_num_rows($chkidresult);
        if ($checkid != 0) {
            echo '<script>alert("此身分證已註冊過");history.back();</script>';
        } else if ($checkus != 0) {
            echo '<script>alert("此帳號已有人使用");history.back()</script>';
        } else {
            $sql = <<<add
         insert into mem (`muse`,paswd,`username`,`money`,`iden`) values
         ('$adus','$adpswd','$adname','$addmoney','$adiden');
        add;
            mysqli_query($link, $sql);

            $sql2 = <<<list
        insert into moneylist(`memberId`,`move`,`usemoney`,`money`,`date`) values
        ((SELECT memberId from mem where `muse`='$adus'),'存款','+$addmoney 元',$addmoney,current_timestamp());
        list;
            mysqli_query($link, $sql2);
            //echo "$adname<br>$adus<br>$adpswd<br>";
            echo "<script type='text/javascript'>alert('建立成功！');</script>";
            header("refresh:0; url= index.php");
        }
    } else {
        echo '<script>alert("欄位請勿空白");history.back();</script>';
    }

}

if (isset($_POST["cancel"])) {
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊帳戶</title>
    <script>
    if ( window.history.replaceState )
    {
        window.history.replaceState( null, null, window.location.href );
    }

</script>

</head>
<body style="background-color: #a9fcab">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<form method = "post">
  <h1>註冊帳戶</h1>

      <p>真實姓名:<input id="addname" name="addname" type="text" pattern="\W{3,4}"></p>

      <p>身分證:<input name="addiden" pattern="[A-Z][12]\d{8}" /></p>

      <p>帳號:<input pattern="([\W])g,''){8,12}" id="addacc" name="addacc" type="text" >(請輸入介於8~12個字的帳號)</p>

      <p>密碼: <input pattern="([\W])g,''){8,12}" id="addpswd" name="addpswd" type="text">(請輸入介於8~12個字的密碼)</p>

      <p>存入的金額(至少1000元):<input pattern="[1-9]\d{3,}" id="addmon" name="addmon" type="text"></p>

      <button name="addsub" id= "addsub" type="submit" class="btn btn-info">確認送出</button>
      <button name="cancel" type="submit" class="btn btn-outline-dark">取消離開</button>


</form>

</body>
</html>
