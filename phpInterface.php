<?php
function connect()
{
    $db = mysqli_connect("localhost", "root", "Abimbola02", "hotel")or die("Error connecting");
    return $db;
}

function addItems($item, $price, $image)
{
    $db = connect();
    if (isset($_POST["submit"])) {
        $tmpFile  = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmpFile, "images/$image");
        $query = "INSERT INTO Food( item, price, image) VALUES('".$item."', '".$price."', '".$image."');";
        if (mysqli_query($db, $query)) {
            echo "<script>alert('Successfully added')</script>";
        } else {
            die(mysqli_error($db));
        }
    }
}

function updateItems($item, $price, $image)
{
    $db = connect();
    if (isset($_POST["submit"])) {
        $tmpFile  = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmpFile, "images/$image");
        $query = "UPDATE Food SET price='".$price."', image='".$image."' WHERE item='".$item."'";
        if (mysqli_query($db, $query)) {
            echo "<script>alert('Successfully added')</script>";
        } else {
            die(mysqli_error($db));
        }
    }
}


function getFoodNames()
{
    $db = connect();
    $names = array();
    $queryToselect = "SELECT * FROM Food";
    $itemsGot = mysqli_query($db, $queryToselect);
    if ($itemsGot) {
        if (mysqli_num_fields($itemsGot)>0) {
            while ($row = mysqli_fetch_array($itemsGot)) {
                array_push($names,$row['item']);
            }
        }
    } else {
        die(mysql_error($db));
    }
    return $names;
}

function getFoodPrices()
{
    $prices = array();
    $db = connect();
    $queryToselect = "SELECT * FROM Food";
    $itemsGot = mysqli_query($db, $queryToselect);
    if ($itemsGot) {
        if (mysqli_num_fields($itemsGot)>0) {
            while ($row = mysqli_fetch_array($itemsGot)) {
                $prices[$row['item']]=$row['price'];
            }
        }
    } else {
        die(mysql_error($db));
    }
    return $prices;
}

function getOrderId(){
  $id;
  $db = connect();
  $queryToselect = "SELECT * FROM orders ORDER BY id DESC LIMIT 1";
  $itemsGot = mysqli_query($db, $queryToselect);
  if ($itemsGot) {
      if (mysqli_num_fields($itemsGot)>0) {
          while ($row = mysqli_fetch_array($itemsGot)) {
              $id=$row['id'];
          }
      }
  } else {
      die(mysql_error($db));
  }
  return $id;
}

function getClients(){

  $db = connect();
  $queryToselect = "SELECT * FROM users WHERE usertype='CLIENT '";
  $itemsGot = mysqli_query($db, $queryToselect);
  if ($itemsGot) {
      if (mysqli_num_fields($itemsGot)>0) {
          while ($row = mysqli_fetch_assoc($itemsGot)) {
            echo "<div class='form-check align-middle'>";
            echo "<input type='radio' name='users' value='".$row['username']."' class='form-check-input'/>";
            echo "<div class='form-check-label'>";
            echo "<h4>".$row['username']."</h4>";
            echo "<h3>".$row['fname'].", ".$row['sname']."</h3>";
            echo "</div>";
            echo "</div>";
          }
      }
  } else {
      die(mysql_error($db));
  }

}

function getSuppliers(){

  $db = connect();
  $queryToselect = "SELECT * FROM users WHERE usertype='SUPPLIER '";
  $itemsGot = mysqli_query($db, $queryToselect);
  if ($itemsGot) {
      if (mysqli_num_fields($itemsGot)>0) {
          while ($row = mysqli_fetch_assoc($itemsGot)) {
            echo "<div class='row align-middle sups'>";

            echo "<div class='col-md-6'>";
            echo "<h5> Username: ".$row['username']."</h5>";
            echo "<h3> name: ".$row['fname']." ".$row['sname']."</h3>";
            echo "</div>";
            echo "<div class='col-md-6'>";
            echo "<form method='post' action='adminSupplier.php'>
            <input type='hidden' value='".$row['username']."' name='username'/>
            <input type='submit' class='btn btn-danger' value='Disable' />
            </form>";
            echo "</div>";
            echo "</div>";
          }
      }
  } else {
      die(mysql_error($db));
  }

}

function getAllClientHistory($client){

  $db = connect();
  $queryToJoin = "SELECT orders.user_id, orders.date_created, order_details.description, order_details.quantity FROM order_details INNER JOIN orders ON order_details.order_id= orders.id";
  $itemsGot = mysqli_query($db, $queryToJoin)or die(mysql_error($db));
  if ($itemsGot) {
    while ($row = mysqli_fetch_array($itemsGot)) {
      if ($row['user_id'] == $client) {
        echo $row['description'];
      }
    }
  }else{
    die(mysql_error($db));
  }
}

function getFoodDes()
{
    $db = connect();
    $queryToselect = "SELECT * FROM Food";
    $itemsGot = mysqli_query($db, $queryToselect);
    if ($itemsGot) {
        if (mysqli_num_fields($itemsGot)>0) {
            while ($row = mysqli_fetch_array($itemsGot)) {
                echo "<div class='col-md-4 food'>";
                echo "<div class='food-des'>";
                echo "<div class='food-des-item'><img src='images/".$row['image']."'/></div>";
                echo "<div class='food-des-item'><h3 class='text-center'>".$row['item']." @ KSHs ".$row['price']."</h3></div>";
                echo "<div class=''><input type='text' name='".$row['item']."_order' class='form-control' maxlength='10'/></div>";
                echo "</div>";
                echo "</div>";
            }
        }
    } else {
        die(mysql_error($db));
    }
}


function displayItems($foodItem, $quantity)
{
    $db = connect();
    $query = "SELECT * FROM Food WHERE item= '".$foodItem."' LIMIT 5";
    $items = mysqli_query($db, $query);
    if (mysqli_num_rows($items)>0) {
        while ($row = mysqli_fetch_array($items)) {
            // while ($quantity > 0) {
            //     echo "<img  src='images/".$row['image']."'/>";
            //     $quantity--;
            // }
        }
    }
}


function displayItemsInTable()
{
    $db = connect();
    $query = "SELECT * FROM Food";
    $items = mysqli_query($db, $query);
    if (mysqli_num_rows($items)>0) {
        while ($row = mysqli_fetch_array($items)) {
            echo "<tr><td class='text-center align-middle'><h3>".$row['item']."</h3></td><td class='align-middle'><img src='images/".$row['image']."' class='table-images'/></td><td class='text-center align-middle'><h3>".$row['price']."</h3></td><td class='text-center align-middle'>
            <form method='post' action='edit.php'>
            <input type='hidden' value='".$row['item']."' name='item_name'/>
            <input type='submit' class='btn btn-success btn-lg' value='EDIT' />
            </form>
            </td></tr>";

        }
    }
}


function showUserTypes(){
  $db = mysqli_connect("localhost", "root", "Abimbola02", "hotel" );
  $query = "SELECT usertype FROM usertypes";
  $usertypes = mysqli_query($db, $query);
  if ($usertypes) {
    while($row = mysqli_fetch_array($usertypes)){
      echo "<option value='";
      echo $row['usertype'];
      echo " '>".$row['usertype']."</option>";
    }
  }
}
