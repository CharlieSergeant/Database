
<html>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if($_POST["Note"] != null){

$Note = $_POST["Note"];
}
else {
  $Note = "";
}

if($_POST["amount"] != null)
{
  $amount = $_POST["amount"];
}
else {
  echo "amount was empty please enter an amount";
  die;
}

if($_POST["code"] != null)
{
  $code = $_POST["code"];
}
else {
  echo "amount was empty please enter an amount";
  die;
}

if($amount < 0)
{
  echo "Please enter an amount greater than 0";
  die;
}

if($_POST["radio"] == null)
{
  echo "select deposit or withraw";
    die;
}
$radio = $_POST["radio"];

if($_POST["source"] == null)
{
  echo "select a source";
    die;
}
$source = $_POST["source"];
$sid = 1;
if($source == 'ATM')
{
  $sid = 1;
}
if($source == 'Online')
{
  $sid = 2;
}
if($source == 'Branch')
{
  $sid = 3;
}
if($source == 'Wired')
{
  $sid = 4;
}
if($source == 'New')
{
  $sid = 5;
}
$type = "";
if($radio == 'withdraw')
{
  $amount = -$amount;
  $type = "W";
}
else {
  $type = "D";
}

$servername = "imc.kean.edu";
$user = "sergeach";
$pass = "0991499";
$myDB = "CPS3740";

$amountsum = 0;

// Create connection
$conn = new mysqli($servername, $user, $pass,$myDB);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$cookie_name = "user";
$loweruser = $_COOKIE[$cookie_name];

$sql = "select * from CPS3740_2020S.Money_sergeach";
if (!$conn-> query($sql)) {
  echo "<br>Login doesn’t exist in the database\n";
  die;
}
$result = $conn->query($sql);


  if ($result->num_rows > 0)
  {
      // output data of each row
      while($row = $result->fetch_assoc())
      {
          $inamount = $row["amount"];
          $incode = $row["code"];
          if($incode == $code)
          {
            echo "Same code exists";
            die;
          }
          $amountsum = $amountsum + $inamount;
      }
}

if($amountsum + $amount < 0)
{
  echo "Balance is less than the withdraw amount";
  die;
}

$servername = "imc.kean.edu";
$user = "sergeach";
$pass = "0991499";
$myDB = "CPS3740";


// Create connection
$conn = new mysqli($servername, $user, $pass,$myDB);
$cid = 1;
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM Customers where login = '$loweruser'";
if (!$conn-> query($sql)) {
  echo "<br>Login $username doesn’t exist in the database\n";
  die;
}
$result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
      // output data of each row
      while($row = $result->fetch_assoc())
      {
        $cid = $row["id"];
      }
  }

  // Create connection
  $conn = new mysqli($servername, $user, $pass,$myDB);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
date_default_timezone_set('America/New_York');
$date = date('Y-m-d H:i:s', time());

  $sql = "INSERT INTO CPS3740_2020S.Money_sergeach (code,cid,type,amount,mydatetime,note,sid) values ('".$code."','".$cid."','".$type."','".$amount."','".$date."','".$Note."','".$sid."')";
  if (!$conn-> query($sql)) {
    echo "<br>Invalid Data\n";
    die;
  }
  $result = $conn->query($sql);
echo "Inserted into table\n";



?>

</body>
<a href='Clogout.php'>User Logout</a><br>
</html>
