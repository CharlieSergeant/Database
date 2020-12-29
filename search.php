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

$customer = $_COOKIE[$customer_cookie];

//Customer Cookie not Found
if(!isset($_COOKIE[$customer_cookie])){
//echo "<a href='Clogout.php'>Customer Logout</a><br>";
echo "Please login first before accessing the database";
die;
}

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

$sql = "SELECT * FROM Customers where login = '$customer'";
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
      echo "Results for: ".$row['name'];
    }
}

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
  $temp = "%".$searchcase."%";
  $sql = 'select * from CPS3740_2020S.Money_sergeach where note like "'.$temp.'"';
}

if (!$conn-> query($sql)) {
  echo "<br>No results found with the search keyword ",$searchcase, "\n";
  die;
}

$result = $conn->query($sql);




    if ($result->num_rows > 0) {

      echo '<table border="1">
            <tr>
                <td> <font face="Arial">ID</font> </td>
                <td> <font face="Arial">Code</font> </td>
                <td> <font face="Arial">Type</font> </td>
                <td> <font face="Arial">Amount</font> </td>
                <td> <font face="Arial">Date Time</font> </td>
                <td> <font face="Arial">Note</font> </td>
            </tr>';
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $ID = $row["mid"];
          $code = $row["code"];
          $type = $row["type"];
          $amount = $row["amount"];
          $mydatetime = $row["mydatetime"];
          $note = $row["note"];

            echo '<tr>
              <td>'.$ID.'</td>
              <td>'.$code.'</td>
              <td>'.$type.'</td>
              <td>'.$amount.'</td>
              <td>'.$mydatetime.'</td>
              <td>'.$note.'</td>
          </tr>';
        }
      }
      else
      {
          echo "<br>No results found with the search keyword ",$searchcase, "\n";
          die;
      }

$conn->close();

?>
</HTML>
