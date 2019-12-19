<?php 
error_reporting(0);
function numberTowords($num)
{ 
$ones = array( 
1 => "one", 
2 => "two", 
3 => "three", 
4 => "four", 
5 => "five", 
6 => "six", 
7 => "seven", 
8 => "eight", 
9 => "nine", 
10 => "ten", 
11 => "eleven", 
12 => "twelve", 
13 => "thirteen", 
14 => "fourteen", 
15 => "fifteen", 
16 => "sixteen", 
17 => "seventeen", 
18 => "eighteen", 
19 => "nineteen" 
); 
$tens = array( 
1 => "ten",
2 => "twenty", 
3 => "thirty", 
4 => "forty", 
5 => "fifty", 
6 => "sixty", 
7 => "seventy", 
8 => "eighty", 
9 => "ninety" 
); 
$hundreds = array( 
"hundred", 
"thousand", 
"million", 
"billion", 
"trillion", 
"quadrillion" 
); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
if($i < 20){ 
$rettxt .= $ones[$i]; 
}elseif($i < 100){ 
$rettxt .= $tens[substr($i,0,1)]; 
$rettxt .= " ".$ones[substr($i,1,1)]; 
}else{ 
$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
$rettxt .= " ".$tens[substr($i,1,1)]; 
$rettxt .= " ".$ones[substr($i,2,1)]; 
} 
if($key > 0){ 
$rettxt .= " ".$hundreds[$key]." "; 
} 
} 
if($decnum > 0){ 
$rettxt .= " and "; 
if($decnum < 20){ 
$rettxt .= $ones[$decnum]; 
}elseif($decnum < 100){ 
$rettxt .= $tens[substr($decnum,0,1)]; 
$rettxt .= " ".$ones[substr($decnum,1,1)]; 
} 
} 
return $rettxt; 
} 

?>
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

  $temp = "SELECT * FROM orders WHERE orderno in (SELECT max(orderno) FROM orders WHERE mobile='$usermob')";
  $result = mysqli_query($db,$temp);
  $order = mysqli_fetch_array($result);
  $_SESSION['orderno'] = $order[0];
  $priceitem = mysqli_query($db,"SELECT price FROM cart WHERE mobile='$usermob'");
  $total = 0;
  while($prices = mysqli_fetch_array($priceitem))
  {
      $total += $prices[0];
  }

  $total = round(1.16*$total);

$temp = "SELECT * FROM register WHERE mobile_no='$usermob'";

$res = mysqli_query($db,$temp);

$arr = mysqli_fetch_array($res);


?>
<!DOCTYPE html>
<html>
<head>
	<title>Change profile details</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
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

        .panel{
        	font-size: 20px;
        	width: 80%;
        	margin-top: 100px; 
        }

        td a{
        	float: right;

        }


#ballu div{
  display: inline-block;
  border :1px solid black;
  padding: 20px;

}
#cum div{
display: block;
}

#com div{
  display: block;
}

#category h2
{
  margin-left: 5%;
}


</style>
</head>

<body id="homebody">


<div class="panel panel-primary" style="margin-left: 10%;">
    <div class="panel-heading">BILL</div>
      <div class="panel-body">
  

<h1 style="font-size: 30px;">Name : <?php echo $arr[0]; ?></h1>
<h2 style="font-size: 20px;">Address : <?php echo $arr[4]; ?></h2>
<div class="divi">
<h2 style="font-size: 20px;">Mobile No. : <?php echo $arr[2]; ?></h2>
<h2 style="margin-left: 400px; font-size: 20px;">Email-id : <?php echo $arr[1]; ?></h2>
</div>
<div class="divi">
<h2 style="font-size: 20px;">Date of order : <?php echo $order['dateoo'];?></h2>
</div>

<center>
  <br>
    <button class="btn btn-danger">Order Summary</button><br>
</center>
<div style="border: 1px solid black;margin-bottom: 100px;padding: 20px;border-radius: 10px;">
  <center>
    <?php echo $order['description'];?>
  </center>
</div>

<div id="ballu" style="margin-top: -20px;">
  <div style="width: 577px;height: 205px;" id="com">
    <div style="margin-left: -20px;margin-top: -20px;margin-right: -20px;">
      <p>Delivery Date & Time : By <?php echo $order['dateod']; ?> 5:00 PM</p>
    </div>
    <div style="margin-left: -20px;margin-bottom: -20px;margin-right: -20px;border-bottom: none;">
      Delivery Address :<br> 25 Rajsar Plazaa near hanuman mandir, gali no.2 , bajaj nagar, Delhi, Rajashthan. 
    </div>
  </div>
  <div style="float: right; padding-right: 360px; width: 470px; " id="cum">
    <div style="margin-left: -20px;margin-top: -22px;">
    <p>%SGST</p>
    <p>%CGST</p>
  </div>
  <div style="position: absolute;margin-top: -118px;width: 360px;margin-left:88px;height: 118px;">
    <center>
      <p>8 %</p>
      <p>8 %</p>
    </center>
  </div>
  <div style="margin-left: -20px;margin-bottom: -20px;width: 470px;">
    <p>Grand Total : <?php echo $order['amount'];?> Rs. <p style="margin-left: 100px;"><?php echo numberTowords($order['amount']); ?></p></p>
  </div>
  </div>
</div>
</div>
</div>
<center><button class="btn btn-danger" onclick="window.print();">Print Your Bill</button><a href="home.php" class="btn btn-info" style="margin-left: 50px;">Back To Home</a></center>
<br><br>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.scrollUp.min.js"></script>
  <script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>






</body>
</html>