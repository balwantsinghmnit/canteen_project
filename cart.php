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
  
?>

<?php

  $usermob = $_SESSION['usermob'];

  $temp = "SELECT * FROM cart WHERE mobile='$usermob'";
  $result = mysqli_query($db,$temp);
  $_SESSION['cartno'] = mysqli_num_rows($result);
  $priceitem = mysqli_query($db,"SELECT price FROM cart WHERE mobile='$usermob'");
  $total = 0;
  while($prices = mysqli_fetch_array($priceitem))
  {
      $total += $prices[0];
  }
  $itemid = array();
  $id = 0;
?>


<!DOCTYPE html>
<html>
<head>
	<title>Cart - Canteen Management System</title>
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

.card{
  display: inline-block;
  margin-left: 1%;
  margin-top: 10px;
}
</style>
</head>
<body>
<br><br>
<a href="home.php" class="btn btn-warning" style="margin-left: 50px;" >Menu Page</a>

  <div class="panel panel-primary" style="width: 80%;margin-left: 10%;">
    <div class="panel-heading">My Cart</div>
      <div class="panel-body">
        <table class="table">
            <thead class="thead-light">
                <th scope="col">Item</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
            </thead>
            <tbody>
              <?php $i=0; while($item=mysqli_fetch_array($result)){?>
                <tr>
                  <?php $itemid[$i++]=$item['itemid']; ?>
                <td><?php echo $item['title'];?></td>
                <td ><a href="additem.php?decrease=<?php echo $item['itemid'];?>" style="width:20px;background:crimson;color: white;padding-left:5px;padding-right: 5px;font-size:15px;margin-right: 5px;">-</a><span style="width:50px;"><?php echo $item['quantity'];?></span><a href="additem.php?increase=<?php echo $item['itemid'];?>" style="width:20px;background:crimson;color: white;padding-left:5px;padding-right: 5px;font-size:15px;margin-left: 5px;">+</a></td>
                <td><?php echo $item['price'];?> Rs.</td>
                <td><a href="additem.php?deleteit=<?php echo $item['itemid']; ?>" style="width: 20px;background: orange;color: white;padding:5px;border-radius:2px;">X</a></td>
              </tr>
              <?php }?>
            </tbody>
        </table>
        <center>
          <a href="#" class="btn btn-info" disable>Total : <?php echo $total ?> Rs.</a>
          <a href="additem.php?total=<?php echo $total;?>" class="btn btn-danger">Place Order</a>
        </center>
      </div>
  </div>



<script type="text/javascript">
   
</script>
</body>
</html>