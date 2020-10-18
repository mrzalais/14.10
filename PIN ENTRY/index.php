<?php

declare(strict_types=1);

require_once './UserWithPin.php';
require_once './UserAndPinStorage.php';

$database = new UserAndPinStorage();

if (isset($_POST['pin'])) {
    $pin = $_POST['pin'];

    $personWithNumber = $database->loginWithPin((int)$pin);

    $_SESSION = $personWithNumber->getName();

    if ($personWithNumber !== null) {
        echo '
<table>
<thead>
  <tr>
    <td>You are logged in as:</td>
    <td><b>' . $_SESSION . '</b></td>
  </tr>
</thead>
<tbody>
</tbody>
</table>
<hr>
';
    } else {
        echo 'There is nobody in our database with that PIN';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
</head>
<body>
<form action="/" method="post">
    <label for="search">Your login pin</label>
    <input type="text" id="search" name="pin"/>
    <button type="Submit">
        Enter
    </button>
</form>
</body>
</html>
