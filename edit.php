<?php
 session_start();
 require("connect.php");
 $name=$_SESSION["name"];
if(isset($_POST["addsub"]))
{
    $edituser = $_POST["addacc"];
    $editpaswd = $_POST["addpswd"];
    if(($edituser&&$editpaswd)!="")
    {
    $_SESSION["userName"] = $_POST["addacc"];
    $_SESSION["passWord"] = $_POST["addpswd"];
    $sql = <<< edit
    update mem set `muse`='$edituser' , `paswd` = '$editpaswd'
    where username = '$name';
    edit;
    mysqli_query($link,$sql);
    header("Location: memuse.php");
    }
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
    <label for="text2" class="col-2 col-form-label" style="color:yellow;background-color:#48D1CC">帳號</label> 
    <div class="col-4">
      <input onKeyUp="value=value.replace(/[\W]/g,'')" id="addacc" name="addacc" type="text" value="<?=$_SESSION["userName"]?>" class="form-control">
    </div>
  </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="text1" class="col-2 col-form-label" style="color:red;background-color:#98FB98">密碼</label> 
    <div class="col-4 ">
      <input onKeyUp="value=value.replace(/[\W]/g,'')" id="addpswd" name="addpswd" type="text" value="<?=$_SESSION["passWord"]?>" class="form-control">
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