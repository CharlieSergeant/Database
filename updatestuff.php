<html>

  <br><a href='Clogout.php'>User logout</a><br>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$servername = "imc.kean.edu";
$user = "sergeach";
$pass = "0991499";
$myDB = "CPS3740";


// Create connection
$conn = new mysqli($servername, $user, $pass,$myDB);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$size = count($_POST['note']);
$i=0;

$count = 0;

$sql = "select * from CPS3740_2020S.Money_sergeach";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{

    // output data of each row
    while($row = $result->fetch_assoc())
    {
      $temp = $_POST['note'][$i];
      if($_POST['note'][$i] != $row['note'])
      {
        $rowtemp = $row['mid'];
        $code = $row['code'];
        $sql2 = "update CPS3740_2020S.Money_sergeach SET note = '$temp' WHERE mid = '$rowtemp'";
        $result2 = $conn->query($sql2);
        ++$count;
        echo "The Note for code ".$code." has been updated in database.<br>";
      }
      ++$i;
    }
    echo $count." records got updated<br>";
}

  $count = 0;
if(!empty($_POST['checkbox'])) {


  $servername = "imc.kean.edu";
  $user = "sergeach";
  $pass = "0991499";
  $myDB = "CPS3740";


  // Create connection
  $conn = new mysqli($servername, $user, $pass,$myDB);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "select * from CPS3740_2020S.Money_sergeach";
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {

      // output data of each row
      while($row = $result->fetch_assoc())
      {
        foreach($_POST['checkbox'] as $value)
        {
          $rowtemp = $row['mid'];
          if($rowtemp == $value)
          {
            $code = $row['code'];
            $sql2 = "delete from CPS3740_2020S.Money_sergeach WHERE mid = '$rowtemp'";
            $result2 = $conn->query($sql2);
            ++$count;
            echo "The code ".$code." has been deleted from the database.<br>";
          }
      }
    }

  }
}
echo $count." records got deleted<br>";



?>
</body>
</html>
