<HTML>

<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$searchcase = $_GET["search"];
$customer_cookie="user";

if($searchcase == '')
{
  echo "no keyword entered";
  die;
}

$temp = "%",$searchcase,"%";
echo "Ehh",$temp;

//Customer Cookie not Found
if(!isset($_COOKIE[$customer_cookie])){
//echo "<a href='Clogout.php'>Customer Logout</a><br>";
echo "Please login first before accessing the database";
die;
}
$customerName = $_COOKIE[$customer_cookie];
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
if($searchcase == '*')
{
  $sql = "select * from CPS3740_2020S.Money_sergeach";
}
else {
  $temp = "%",$searchcase,"%";
  echo "Ehh",$temp;
  $sql = "select * from CPS3740_2020S.Money_sergeach where note like '$temp'";
}
echo "SQL",$sql;

if (!$conn-> query($sql)) {
  echo "<br>No results found with the search keyword ",$searchcase, "\n";
  die;
}






?>
</HTML>
