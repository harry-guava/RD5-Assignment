<?php
session_start();
require "connect.php";
//echo $_SESSION["userName"];
$account = $_SESSION["userName"];
//echo $account;
$sql = <<< count
    select muse,money from mem where muse = '$account';
    count;
$result = mysqli_query($link, $sql);
$nowmon = mysqli_fetch_assoc($result);
$mon = $nowmon["money"];
if (isset($_POST["btnOK"])) {
    if (trim($_POST["txtget"]) != "") {
        $get = $_POST["txtget"];
        $total = $get + $mon;
        $sql2 = <<< get
        update mem set money = $total where muse = '$account'
        get;
        mysqli_query($link, $sql2);
        $sql3 = <<<push
        insert into moneylist(`memberId`,`move`,`usemoney`,`money`,`date`) values
        ((select memberId from mem where muse = '$account'),'存款','+$get 元',$total,current_timestamp());
        push;
        mysqli_query($link, $sql3);
        echo '<script>location.replace("memuse.php")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>存款</title>
    <script>
    if ( window.history.replaceState )
    {
        window.history.replaceState( null, null, window.location.href );
    }

    </script>
</head>
<body style="background-color:#faffd1">
    <form method="post">
    <h1>存款</h1>
    <table>
    <tr>
    <td width="80" align="center" valign="baseline">請輸入金額</td>
    <td valign="baseline">
    <input oninput="if(value<1)value=1"type="number" name="txtget" id="txtget">
    <input type="submit" name="btnOK" id="btnOK" value="確定"/>
    </tr>
    <h2>餘額:<?=$nowmon["money"]?></h2>
    </table>
    </form>
</body>
</html>