<?php 
  session_start();
  $db = mysqli_connect('localhost','root','','canteen');

 
  $usermob = $_SESSION['usermob'];

  if(isset($_GET['data']))
  {
    $arr = array($_GET['data']);
    $datas = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM allitems WHERE itemid='$arr[0]'"));
    $arr[1] = $datas['title'];
    $arr[3] = $datas['price'];
    $image = $datas[1];

  $find_user = "SELECT * FROM cart WHERE mobile='$usermob' and itemid='$arr[0]'";
  $user_r = mysqli_query($db,$find_user);
  if(mysqli_num_rows($user_r)==1)
  {
    echo "Already in the cart!";
    echo "<br><center><a href='home.php' style='border:none;background:red;color:white;padding:8px;border-radius:10px;text-decoration:none;width:100px;height:50px;'>Go Back to Home</a></center>";
  }
  else
  {
      $additem = "INSERT INTO cart(itemid,itemimage,title,mobile,price) VALUES('$arr[0]','$image','$arr[1]','$usermob','$arr[3]')";
      mysqli_query($db,$additem);
          $temp = "SELECT * FROM cart WHERE mobile='$usermob'";
        $result = mysqli_query($db,$temp);
        $_SESSION['cartno'] = mysqli_num_rows($result);
      header("Location:cart.php");
  }
}

if(isset($_GET['increase']))
{
  $itemid = $_GET['increase'];
  $findold = "SELECT * FROM cart where itemid='$itemid' and mobile='$usermob'";
  $resultt = mysqli_query($db,$findold);
  $oldquantityarray = mysqli_fetch_array($resultt);
  $oldquantity = $oldquantityarray['quantity'];
  $oldprice = $oldquantityarray['price'];
  $newprice = $oldprice + ($oldprice/$oldquantity);
  $oldquantity += 1;
  $update1 = "UPDATE cart SET quantity='$oldquantity' where itemid='$itemid' and mobile='$usermob'";
  $update2 = "UPDATE cart SET price='$newprice' where itemid='$itemid' and mobile='$usermob'";
  if(mysqli_query($db,$update1))
  { 
     if(mysqli_query($db,$update2))
    {
      header("Location:cart.php");
    }
  }
  else
  {
    echo "Sorry , Something went wrong!";
  }

}

if(isset($_GET['decrease']))
{
  $itemid = $_GET['decrease'];
  $findold = "SELECT * FROM cart where itemid='$itemid' and mobile='$usermob'";
  $resultt = mysqli_query($db,$findold);
  $oldquantityarray = mysqli_fetch_array($resultt);
  $oldquantity = $oldquantityarray['quantity'];
  $oldprice = $oldquantityarray['price'];

  $newprice = $oldprice - ($oldprice/$oldquantity);
  $oldquantity -= 1;
  if($oldquantity==0)
  {
    $deletequery = "DELETE FROM cart WHERE itemid='$itemid' and mobile='$usermob'";
    if(mysqli_query($db,$deletequery))
    {
      header("Location:cart.php");
    }    
  }
  $update1 = "UPDATE cart SET quantity='$oldquantity' where itemid='$itemid' and mobile='$usermob'";
  $update2 = "UPDATE cart SET price='$newprice' where itemid='$itemid' and mobile='$usermob'";
  if(mysqli_query($db,$update1))
  { 
     if(mysqli_query($db,$update2))
    {
      header("Location:cart.php");
    }
  }
  else
  {
    echo "Sorry , Something went wrong!";
  }
}

  if(isset($_GET['deleteit']))
  {
    $itemid = $_GET['deleteit'];

    $deletequery = "DELETE FROM cart WHERE itemid='$itemid' and mobile='$usermob'";

    if(mysqli_query($db,$deletequery))
    {
      header("Location:cart.php");
    }
    else
    {
      echo "failed";
    }
  }

if(isset($_GET['total']))
{
  if($_GET['total']>0)
  {

    header("Location:pay.php?payby=3");
  }
  else
  {
    echo "<center>Purchase 1 item atleast.<br><a href='cart.php'>Back</a></center>";
  }
}

?>
