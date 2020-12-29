<html>
<a href='Clogout.php'>User Logout</a>
<br><b>Add Transaction</b><br>

<body>
  <?php
  include('login2.php');
  echo $username." current balance ".$amountsum;
  ?>
<form name="input" action="employee_insert_product.php" method="POST">

Transaction code: <input type="text" name="code" required="required">
<input type="radio" id="Deposit" name="radio" value="deposit">
<label for="Deposit">Deposit</label><br>
<input type="radio" id="Withdraw" name="radio" value="withdraw">
<label for="Withdraw">Withdraw</label><br>
<br>Amount: <input type="text" name="amount" required="required">
<br>Select a source:
<select name="vendor" required="required">
<?php
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

$sql = "select * from Sources";

   $result = mysqli_query($conn,$sql);

   while($row = mysqli_fetch_array($result)){
        echo "<option value='".$row['name'];
   }
   echo "</select>";
        ?>
<br><br>
<input type="hidden" name="employee_id" value="0">
<input type="submit" value="Submit">

</fieldset>

</form>

</body>

</html>
