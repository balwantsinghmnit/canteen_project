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

  $canteenitem= mysqli_query($db,"SELECT * FROM allitems");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Canteen Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">

    body{
      background: white;
    }
      .card-body p{
        height: 30px;
      }

.card{
  display: inline-block;
  margin-left: 1%;
  margin-top: 10px;
}

.panel
{
  width: 80%;
}
</style>
</head>
<body>

		  <div class="panel panel-primary">
    <div class="panel-heading">Welcome to Ashish Canteen</div>
      <div class="panel-body">
        <!-- kids brush items start  -->
<div id="home-kidsstore-div">
  <?php while($item = mysqli_fetch_array($canteenitem)){?>
  <div class="card" style="width: 20rem;">
    <img class="card-img-top" src="<?php echo($item['imagepath']) ?>" alt="Card image cap" width='200' height='180'>
    <?php $itemid = $item['itemid'];?>
    <div class="card-body">
      <h5 class="card-title"><?php echo $item['title']; ?><span class="badge" style="background:crimson;padding: 5px;margin-left:10px;"><?php echo $item['price'];?>Rs.</span></h5><br><br>
      <a class="btn btn-primary" href="additem.php?data=<?php echo $itemid?>" style="margin-top:-20px;"><?php echo $item['seebtn']; ?></a>
    </div>
  </div>
  <?php }?>
</div>

      </div>
  </div>
<a href="cart.php" class="btn btn-warning" style="position: absolute;top: 50px;right: 50px;width: 100px;">Cart</a>
<a href="yourorders.php" class="btn btn-danger" style="position: absolute;top: 200px;right: 50px;width: 100px;">My Orders</a>
<a href="home.php?logoutbtn=1" class="btn btn-danger" style="position: absolute;top: 300px;right: 50px;width: 100px;">Log Out</a>

</body>
</html>