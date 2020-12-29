<html>
<body>

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


$amountsum = 0;

//post username


$username = mysqli_real_escape_string($conn, $_POST['username']);
if($username ==""){
  die("<br>Please enter username. \n");
}

//post password
$password = mysqli_real_escape_string($conn, $_POST["password"]);
if($password ==""){
  echo "<br>Username and password are not matched. \n";
  die; //Do not continue
}



if (!empty($_SERVER['HTTP_CLIENT_IP']))
{ $ip = $_SERVER['HTTP_CLIENT_IP']; }
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{ $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; }
else { $ip = $_SERVER['REMOTE_ADDR']; }
$IPv4= explode(".",$ip);
echo "<br>Your IP: $ip\n";

echo "<br>Your Browser and OS: ".$_SERVER['HTTP_USER_AGENT'] . "\n\n";

$browser = get_browser(null, true);
print_r($browser);





$loweruser = strtolower($username);

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
        if($password == $row['password'])
        {
          $cookie_name = 'user';
          $cookie_value = $loweruser;
          setcookie($cookie_name, $cookie_value, time() + (3600), "/");
          //wireless 10. // wired 131.125
          if($IPv4[0]=='10'||($IPv4[0]=='131'&&$IPv4[1]=='125'))
          {
             echo "<br>You are from Kean Unversity.\n";
          }
          else
          {
             echo "<br>You are NOT from Kean Unversity.\r\n";
          }
          //file log
          date_default_timezone_set(timezone_name_from_abbr("EST"));
          $cur_date = date('Y/m/d H:i:s');
          $logf = fopen("log.txt", "a");
          $log_msg = "$cur_date,login:$login_id,$ip--\n";
          fwrite($logf, $log_msg);
          fclose($logf);

          echo "<br>Welcome Customer: $username\r\n";

          echo "<br>Age: 38\r\n";
          echo "<br>Address: 1000 Morris Ave., Union, 07083\r\n";
          echo "<br>The transcations for customer $username are: Saving account\r\n";

          $sql = "select * from CPS3740_2020S.Money_sergeach";
          $result = $conn->query($sql);
          echo '<table border="1">
                <tr>
                    <td> <font face="Arial">ID</font> </td>
                    <td> <font face="Arial">Code</font> </td>
                    <td> <font face="Arial">Type</font> </td>
                    <td> <font face="Arial">Amount</font> </td>
                    <td> <font face="Arial">Date Time</font> </td>
                    <td> <font face="Arial">Note</font> </td>
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
                  echo '<tr>
                    <td>'.$ID.'</td>
                    <td>'.$code.'</td>
                    <td>'.$type.'</td>
                    <td><font color = "blue">'.$amount.'</font></td>
                    <td>'.$mydatetime.'</td>
                    <td>'.$note.'</td>
                </tr>';
                }
                else {
                  echo '<tr>
                    <td>'.$ID.'</td>
                    <td>'.$code.'</td>
                    <td>'.$type.'</td>
                    <td><font color = "red">'.$amount.'</font></td>
                    <td>'.$mydatetime.'</td>
                    <td>'.$note.'</td>
                </tr>';
                }


              }
            }
              echo "</table><br>Total Balance: $amountsum\r\n";





        }
        else
        {
          echo "<br>login $username exists, but password not matches.\n";
          die;
        }
      }
  }
  else
  {
      echo "<br>Login $username doesn’t exist in the database\n";
      die;
  }



$conn->close();

?>
</body>
</html>
