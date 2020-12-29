<html>
<body>
<?php
$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])) {
echo "Cookie named '" . $cookie_name . "' does not exist!";
} else {
echo "Cookie is named: " . $cookie_name . "<br>Value is: " .
$_COOKIE[$cookie_name];
}
?>
</body>
</html>
