<?php include("error.php");?>
<?php session_start(); error_reporting(0);?>
<!DOCTYPE html>
<html>
<head>
	<title>Canteen Management System</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Chicle&subset=latin-ext');

    	form{
    		width: 450px;
        height: 400px;
        margin-top: 30px;
        margin-left: -2000px;
        border: 2px solid black;
        border-radius:5px ;
        padding: 5%;
        background-color:orangered;
        opacity: 0.7;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        transition: 1s;
    	}
        
        body{
        
        	background-color: powderblue;
        	background-size: cover;
        	background-repeat: no-repeat; 
        }

        form h1{
          font-family: 'Chicle', cursive;
          margin-bottom: 10px;
          color:orange;
          text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
         }

        form .form-control
        {
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
    </style>
</head>
<body onload="loginform(); ">
	<center>
	
      <form method="post" action="index.php" id="loginform">
      	<center><h1>
		LOGIN
	    </h1>
      <fieldset class="form-group">
        
      	<input type="text" name="mob_no" placeholder="Mobile No." class="form-control" style="border: 2px solid black;color: black;width: 200px">
      </fieldset>
      <fieldset class="form-group">
      	<input type="password" name="password" placeholder="Password" class="form-control" style="border: 2px solid black;width: 200px">
        <a href="forgot.php" style="color: red;margin-top:50%;margin-left: 50%">Forgot Password</a>
      </fieldset><br>
      <fieldset class="form-group">
      	<input type="submit" name="login" value="Login" class="btn" style="background:#151719;color: white;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
      </fieldset><br>
      </form>

      
    </center>
    <p style="width: 300px;border: none;border-radius: 10px;padding-top: 2px;margin-top: 10px;font-family: 'Chicle', cursive;
">Not yet register? <a href="register.php"> Register Here</a></p>

<a href="terms.php" ><center>Terms & Condition</a>
  <script type="text/javascript">
    function loginform() {
      document.getElementById('loginform').style.marginLeft = 0 + 'px';
    }
  </script>
</body>
</html>

<?php

    $db = mysqli_connect("localhost","root","","canteen");

if(isset($_POST['login']))
{
  $mob_no = $_POST['mob_no'];
  $password = $_POST['password'];

  $password = md5($password);

    $temp = "SELECT * FROM register WHERE mobile_no='$mob_no' AND password='$password'";

    $r = mysqli_query($db,$temp);

    $arr = mysqli_num_rows($r);

    if($arr>0)
    {
      $_SESSION['usermob']= $mob_no;
      echo '<script type="text/javascript">'; 
echo 'alert("You are successfully logged in!");'; 
echo 'window.location.href = "home.php";';
echo '</script>';
    }
    else{
      echo "Wrong Username/Password";
    }
}


?>