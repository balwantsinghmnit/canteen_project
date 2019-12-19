<?php 
  session_start();
  $db = mysqli_connect('localhost','root','','canteen');

  if(!isset($_SESSION['usermob']))
  {
    header('Location: index.php');
  }

  if(isset($_GET['logoutbtn']))
  {
    
    unset($_SESSION['usermob']);
    header("Location:index.php");
  }
  
  $usermob = $_SESSION['usermob'];

  $temp = "SELECT * FROM register WHERE mobile_no='$usermob'";
  $res = mysqli_query($db,$temp);
  $arr = mysqli_fetch_array($res);
  $result = mysqli_query($db,"SELECT * FROM orders WHERE mobile='$usermob'");
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Account Information</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
    <link rel="icon" href="abp.png">
    <link rel="stylesheet" href="css/home.css">
    <link href='http://fonts.googleapis.com/css?family=Days+One' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">

    body{
      background: white;
    }
</style>
</head>
<body>
<br><br>
<a href="home.php" class="btn btn-warning" style="margin-left: 50px;" >Menu Page</a>

  <div class="panel panel-primary" style="width: 90%;">
    <div class="panel-heading">My Orders</div>
      <div class="panel-body">
          <table class="table">
            <thead class="thead-light">
                <th scope="col">S.R. No.</th>
                <th scope="col">Order Summary</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Date Of Order</th>
                <th scope="col">Payment Method</th>
            </thead>
            <tbody>
              <?php $i=1; while($order=mysqli_fetch_array($result)){?>
                <tr>
                  <td><?php echo $i++;?></td>
                  <td><?php echo $order['description'];?></td>
                  <td ><?php echo $order['amount'];?> Rs.</td>
                  <td><?php echo $order['dateoo'];?></td>
                  <td><?php echo $order['payby'];?></td>
              </tr>
              <?php }?>
            </tbody>
        </table>
      </div>
    </div>
 </center>
</body>
</html>