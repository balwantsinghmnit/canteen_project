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
$items = "SELECT * FROM cart WHERE mobile='$usermob'";

if(isset($_GET['payby']))
{

  $payby = $_GET['payby'];
  if($payby==1)
  {
    $payby = 'Debit Card';
  }
  if($payby==2)
  {
    $payby = 'Net Banking';
  }
  if($payby==3)
  {
    $payby = 'cod';
  }

$result = mysqli_query($db,$items);
$des = "";
$item=mysqli_fetch_array($result);
	$des = $des."".$item['quantity'];
	$des = $des." ";
	$des = $des."".$item[2];
  $itemid = $item['itemid'];
$quantity = $item['quantity'];
$sellermob = $item['sellermob'];

while($item=mysqli_fetch_array($result))
{
	$des = $des.",";
	$des = $des."".$item['quantity'];
	$des = $des." ";
	$des = $des."".$item[2];
  $itemid = $item['itemid'];
$quantity = $item['quantity'];
$sellermob = $item['sellermob'];
}

  $priceitem = mysqli_query($db,"SELECT price FROM cart WHERE mobile='$usermob'");
  $total = 0;
  while($prices = mysqli_fetch_array($priceitem))
  {
      $total += $prices[0];
  }
  $total = round(1.16*$total);

  $date = date("d/m/Y");
  $dod = date("d/m/Y",strtotime("+7 days"));
  $timeoforder = time();
   $temp = "INSERT INTO orders(description,amount,dateoo,mobile,payby,dateod) VALUES('$des','$total','$date','$usermob','$payby','$dod')";
   if(mysqli_query($db,$temp))
   {
   	   	 mysqli_query($db,"DELETE FROM cart WHERE mobile='$usermob'");
           $temp = "SELECT * FROM cart WHERE mobile='$usermob'";
  $result = mysqli_query($db,$temp);
  $_SESSION['cartno'] = mysqli_num_rows($result);

   	header("Location:bill.php");
   }

}

?>