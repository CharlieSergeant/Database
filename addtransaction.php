<html>
<a href='Clogout.php'>User Logout</a><br>
<br><b>Add Transaction</b><br>
<body>

<?php
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

$amountsum = 0;

// Create connection
$conn = new mysqli($servername, $user, $pass,$myDB);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
          $amountsum = $amountsum + $inamount;
      }
}

echo $_COOKIE[$customer_cookie]." current balance is ".$amountsum;
 ?>

<form name="input" action="employee_insert_product.php" method="POST">

Transaction code: <input type="input" name="code" required="required">
<br><input type="radio" id="Deposit" name="radio" value="deposit">
<label for="Deposit">Deposit</label>
<input type="radio" id="Withdraw" name="radio" value="withdraw">
<label for="Withdraw">Withdraw</label>
<br>Amount: <input type="input" name="amount" required ="required">
<br>Select a source:
<?php
$servername = "imc.kean.edu";
$user = "sergeach";
$pass = "0991499";
$myDB = "CPS3740";

$id = 0;

// Create connection
$conn = new mysqli($servername, $user, $pass,$myDB);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select * from Sources";
$result = $conn->query($sql);
$select= '<select name="source" required="required">';
while($rs = $result->fetch_assoc()){
      $select.='<option value="'.$rs['id'].'">'.$rs['name'].'</option>';
  }
$select.='</select>';
 echo $select;
?>
<br>Note: <input type="input" name="Note">
<br><input type="submit" value="Submit">
</form>

</body>

</html>
