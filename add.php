<?php
session_start();
if(isset($_POST["addsub"]))
{
    $adname = $_POST["addname"];
    $adus = $_POST["addacc"];
    $adpswd = $_POST["addpswd"];
    $addmoney = $_POST["addmon"];
    if(trim(($adname&&$adus&&$adpswd&&$addmoney)!=""))
    {
        $_SESSION["adname"]= $adname;
        $_SESSION["addacc"]= $addacc;
        $_SESSION["addpswd"]= $addpswd;
        if($addmoney>=1000)
        {
        $_SESSION["addmoney"] = $addmoney;
        require("connect.php");
        $sql = <<<add
         insert into mem (`muse`,paswd,`username`,`money`) values
         ('$adus','$adpswd','$adname','$addmoney');
        add;
        mysqli_query($link,$sql);

        $sql2= <<<list
        insert into moneylist(`change`,`date`) values
        ('+$addmoney',current_timestamp());
        list;
        mysqli_query($link,$sql2);
        //echo "$adname<br>$adus<br>$adpswd<br>";
        echo "<script type='text/javascript'>alert('建立成功！');</script>";
        header("refresh:0; url= index.php");
        }
        else 
        {
            echo "<script type='text/javascript'>alert('至少存入1000元');</script>";
        }
    }
    else
    {
        echo '<script>language:"javascript"';
        echo 'alert("欄位請勿空白")';
        echo "</script>";

    }
}
if(isset($_POST["cancel"]))
{
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
    if ( window.history.replaceState ) 
    {
        window.history.replaceState( null, null, window.location.href );
    }

</script>
 
</head>
<body>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<form method = "post">
  <div class="form-group row">
    <label for="text3" class="col-2 col-form-label" style="background-color:#FFE4C4">姓名</label> 
    <div class="col-3">
      <input id="addname" name="addname" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="text2" class="col-2 col-form-label" style="color:yellow;background-color:#48D1CC">帳號</label> 
    <div class="col-4">
      <input onKeyUp="value=value.replace(/[\W]/g,'')" id="addacc" name="addacc" type="text" class="form-control">
    </div>
  </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="text1" class="col-2 col-form-label" style="color:red;background-color:#98FB98">密碼</label> 
    <div class="col-4 ">
      <input onKeyUp="value=value.replace(/[\W]/g,'')" id="addpswd" name="addpswd" type="text" class="form-control">
    </div>
  </div> 
  <div class="form-group row">
    <label for="text4" class="col-2 col-form-label" style="background-color:#FFE4C4">存入的金額(至少1000元)</label> 
    <div class="col-3">
      <input onkeyup="this.value=this.value.replace(/\D/g,'')" id="addmon" name="addmon" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <div class="offset-2 col-10">
      <button name="addsub" id= "addsub" type="submit" class="btn btn-success">確認送出</button>
      <button name="cancel" type="submit" class="btn btn-outline-dark">取消離開</button>
    </div>
  </div>
  
</form>

</body>
</html>