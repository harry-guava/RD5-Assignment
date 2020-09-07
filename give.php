<?php
session_start();
$userName= $_SESSION["userName"];
$mon = $_SESSION["money"];
if(isset($_POST["giveOK"]))
{
    require("connect.php");
    $giveuser = $_POST["txtguser"];
    $paswd = $_POST["txtpaswd"];
    $chkpaswd = $_POST["chkpaswd"];
    $gmoney = $_POST["givemoney"];
    //echo $giveuser;
    if(trim($giveuser&&$paswd&&$chkpaswd&&$gmoney)!="")
    {
        $sql ="select `muse` from mem where `muse` = '$giveuser'";
        $result = mysqli_query($link,$sql);
        $resnum = mysqli_num_rows($result);
        //echo $resnum;
        if($resnum!=0)
        {
            if($paswd==$chkpaswd)
            {
                $sql2r =  "insert into moneylist (memberId,move,usemoney,money,date) values
                ((SELECT memberId from mem where `muse` = '$userName'),'轉帳','-$gmoney 元',$gmoney,current_timestamp())";
                $sql3p = "insert into moneylist (memberId,move,usemoney,money,date) values
                ((SELECT memberId from mem where `muse` = '$giveuser'),'轉帳','+$gmoney 元',$gmoney,current_timestamp())";           
                mysqli_query($link,$sql2r);
                mysqli_query($link,$sql3p);
                $sqlu =  "update mem set money = money-$gmoney where `muse` = '$userName'";
                $sqlu2= "update mem set money = money+$gmoney where `muse` = '$giveuser'";
                mysqli_query($link,$sqlu);
                mysqli_query($link,$sqlu2);
                if($gmoney>$mon)
                {
                    echo '<script>alert("餘額不足，請確認金額");history.back();</script>';
                }
            }
            else
            {
                echo '<script>alert("請輸入相同的密碼");history.back();</script>';
            }
            echo '<script>alert("轉帳成功！");location.replace("memuse.php");</script>';
        }
        else
        {
             echo '<script>alert("請輸入正確的使用者帳號");history.back();</script>';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>轉帳頁面</title>
  <script>
    if ( window.history.replaceState )
    {
        window.history.replaceState( null, null, window.location.href );
    }

  </script>
</head>
<body style="background-color:#faffd1">
    <form method="post">
    <h1>轉帳</h1>
    <h2>餘額:<?=$mon?></h2>
    <p>請輸入欲轉帳之帳號:<input type="text" name="txtguser" pattern="([\W])g,''){8,12}"/></p>
    <p>輸入自己的密碼:<input type="text" name="txtpaswd" /></p>
    <p>再次確認密碼:<input type="text" name="chkpaswd"/></p>
    <p>輸入金額:<input type="number" name="givemoney"/></p>
    <input type="submit" name="giveOK" value="確認送出"/>
    </form>
</body>
</html>
