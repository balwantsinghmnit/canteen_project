<?php session_start() ;error_reporting(0);?>
<!DOCTYPE html>
<html>
<head>
  <title>Canteen Management System</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Chicle&subset=latin-ext');

  form
  {
    border: 2px solid black;
    
    width: 450px;
    height: 600px;
    margin-top:0px;
    background: orangered;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 14px 18px 0 rgba(0, 0, 0, 0.2), 0 16px 20px 0 rgba(0, 0, 0, 0.19);
  }

  form .form-control
  {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);    
  }

  form h1
  {
          font-family: 'Chicle', cursive;
          margin-bottom: 10px;
          padding-bottom: 20px;
          color:orange;
          text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
  }

  form .btn
  {
          font-family: 'Chicle', cursive;
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
          color: white;
          background: #151719;  
  }

        body{
        	
        	background-color:powderblue; 
        	background-size: cover;
        	background-repeat: no-repeat;
        }

        #error_bord
        {
          width:350px;
          background:#151719;
          color: #f1270b;
          border: 1px dashed #f65039;
          border-radius: 10px;
          text-align: center;
          font-size: 18px;
          z-index: 5;
          padding-top: 10px;
        }
        #error_bord h3
        {
          position: absolute;
          top: 10px;
          float: right;
          right: 10px;
          border: 2px dashed white;
          font-family: 'Chicle', cursive;
          border-radius: 25px;
          width: 40px;
          height: 40px;
        }
/*error bord close */
#closeX
{
  color: #151719;
}
#closeX:hover
{
    cursor: pointer;
    color: red;
}
	</style>
</head>
<body>
	<center>
	
      <form method="post" action="register.php">
      	<h1>
        		REGISTER
	    </h1>
<fieldset class="form-group">
        <input type="text" name="fullname" placeholder="Fullname" class="form-control" style="border: 2px solid black"><br>  
</fieldset>
<fieldset class="form-group">
        <input type="email" name="email" placeholder="Email" class="form-control" style="border: 2px solid black"><br>  
</fieldset>
<fieldset class="form-group">
        <input type="text" name="mobile_no" placeholder="Mobile no." class="form-control" style="border: 2px solid black"><br> 
</fieldset>
<fieldset class="form-group">
        <input type="password" name="password1" placeholder="Password" class="form-control" style="border: 2px solid black"><br>  
</fieldset>
<fieldset class="form-group">
        <input type="password" name="password2" placeholder="Confirm Password" class="form-control" style="border: 2px solid black"><br>  
</fieldset>
<fieldset class="form-group">
        <input type="submit" name="submit" value="Submit" class="btn"><br>  
</fieldset>      	
      </form>

      <p style="width: 300px;border: none;border-radius: 10px;padding-top: 2px;margin-top: 10px;font-family: 'Chicle', cursive;
">Already have an account? <a href="index.php"> Login Here</a></p>
 <a href="terms.php" style="margin-top:-20px;" ><center>Terms & Condition</a>
<div style="position: absolute;top: 100px;right: 30px;">
  <?php include('error.php');?>
</div>

    </center>

</body>
</html>


<?php

$db = mysqli_connect("localhost","root","","canteen");

if(isset($_POST['submit']))
{
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $mobile_no = $_POST['mobile_no'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];
  $errors = array();
  $temp = 0;

  if(empty($fullname))
  {
    array_push($errors,"Name Required!");
    $temp = 1;
  }
  if(empty($email) && $temp==0)
  {
    array_push($errors,"Email Required!");
    $temp = 1;
  }
  if(empty($mobile_no) && $temp==0)
  {
    array_push($errors,"Mobile no. Required!");
    $temp = 1;
  }

  if(preg_match('/^[0-9]{10}$/', $mobile) && $temp==0)
  {
    array_push($errors,"Invalid Mobile Number");
    $temp = 1;
  }

  $find_user = "SELECT * FROM register WHERE mobile_no='$mobile_no'";
  $user_r = mysqli_query($db,$find_user);
  if(mysqli_num_rows($user_r)==1 && $temp==0)
  {
    array_push($errors, "User exists with this mobile no.!");
    $temp = 1;    
  }

  if(empty($password1) &&  $temp==0)
  {
    array_push($errors,"Password Required!");
    $temp = 1;
  }


  if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,100}$/', $password1) && !empty($password1) &&  $temp==0) {
    array_push($errors,'Password must contain atleast 8 letters,1 digit and 1 special symbol');
    $temp = 1;
    }


  if($password1!=$password2 &&  $temp==0)
  {
    array_push($errors,"Passwords Not Matched");
  }


  $password1 = md5($password1);

  if(count($errors)==0)
  {

    $temp = "INSERT INTO register(fullname,email,mobile_no,password) VALUES('$fullname','$email','$mobile_no','$password1')";

    if(mysqli_query($db,$temp))
    {
      $_SESSION['usermob'] = $mobile_no;
      echo '<script type="text/javascript">'; 
echo 'alert("You are successfully logged in!");'; 
echo 'window.location.href = "home.php";';
echo '</script>';
    }
    else
    {
      echo "failed";
    }
  }
}

?>