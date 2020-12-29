<html>
  <br><a href='Clogout.php'>User logout</a><br>

<body>

<?php
echo "You can only update Note column.";
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
//Customer Cookie not Found
$customer_cookie = "user";
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


$amountsum = 0;
$i=0;

$sql = "select * from CPS3740_2020S.Money_sergeach";
$result = $conn->query($sql);
echo "<form action='updatestuff.php' method='post'>\n";
echo '<table border="1">
      <tr>
          <td> <font face="Arial">ID</font> </td>
          <td> <font face="Arial">Code</font> </td>
          <td> <font face="Arial">Type</font> </td>
          <td> <font face="Arial">Amount</font> </td>
          <td> <font face="Arial">Date Time</font> </td>
          <td> <font face="Arial">Note</font> </td>
          <td> <font face="Arial">Delete</font>
      </tr>';

if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {
      $ID = $row["mid"];
      $code = $row["code"];
      $type = $row["type"];
      $amount = $row["amount"];
      $mydatetime = $row["mydatetime"];
      $note = $row["note"];


      $amountsum = $amountsum + $amount;
      if($amount > 0)
      {
        echo "<tr>
          <td>$ID</td>
          <td>$code</td>
          <td>$type</td>
          <td><font color = 'blue'>$amount</font></td>
          <td>$mydatetime</td>
          <td bgcolor = 'yellow'><input type = 'input' name = 'note[$i]' style='background-color:#F9FF00' value = '$note'></td>
          <td><input type='checkbox' name='checkbox[$i]' value = '$ID'></td>
      </tr>";
      }
      else {
        echo "<tr>
          <td>$ID<input type='hidden' name='id[$i]' value='$ID'/></td>
          <td>$code</td>
          <td>$type</td>
          <td><font color = 'red'>$amount</font></td>
          <td>$mydatetime</td>
          <td bgcolor = 'yellow'><input type = 'input' name = 'note[$i]' style='background-color:#F9FF00' value = '$note'></td>
          <td><input type='checkbox' name='checkbox[$i]' value = '$ID'></td>
      </tr>";
      }
      ++$i;
    }
  }
  echo "</table>";
    echo "<br>Total Balance: $amountsum\r\n";
    echo "<br><input type='submit' value='Update transaction'>\n";
    echo "</form>";


$conn->close();

?>
</body>
</html>
