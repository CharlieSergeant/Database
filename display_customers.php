<html>
<body>
<?php
$servername = "imc.kean.edu";
$username = "sergeach";
$password = "0991499";
$myDB = "CPS3740";


// Create connection
$conn = new mysqli($servername, $username, $password,$myDB);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Customers";
$result = $conn->query($sql);

echo "The following customers are in the bank system: \n";
echo '<table border="1">
      <tr>
          <td> <font face="Arial">ID</font> </td>
          <td> <font face="Arial">login</font> </td>
          <td> <font face="Arial">password</font> </td>
          <td> <font face="Arial">Name</font> </td>
          <td> <font face="Arial">Gender</font> </td>
          <td> <font face="Arial">DOB</font> </td>
          <td> <font face="Arial">Street</font> </td>
          <td> <font face="Arial">City</font> </td>
          <td> <font face="Arial">State</font> </td>
          <td> <font face="Arial">Zipcode</font> </td>
      </tr>';

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $ID = $row["id"];
      $login = $row["login"];
      $password = $row["password"];
      $Name = $row["name"];
      $Gender = $row["gender"];
      $DOB = $row["DOB"];
      $Street = $row["street"];
      $City = $row["city"];
      $State = $row["state"];
      $zipcode = $row["zipcode"];

      echo '<tr>
        <td>'.$ID.'</td>
        <td>'.$login.'</td>
        <td>'.$password.'</td>
        <td>'.$Name.'</td>
        <td>'.$Gender.'</td>
        <td>'.$DOB.'</td>
        <td>'.$Street.'</td>
        <td>'.$City.'</td>
        <td>'.$State.'</td>
        <td>'.$zipcode.'</td>
    </tr>';
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
</body>
</html>
