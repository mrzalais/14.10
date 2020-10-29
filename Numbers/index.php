<?php

declare(strict_types=1);

require_once './NumberData.php';
require_once './NumberStorage.php';

$numbers = new NumberStorage();

if (isset($_POST['number'])) {
    $number = $_POST['number'];

    $personWithNumber = $numbers->getByNumber((int)$number);

    if ($personWithNumber !== null) {
        echo '
<table>
<thead>
  <tr>
    <td>Name:</td>
    <td><b>' . $personWithNumber->getName() . '</b></td>
  </tr>
</thead>
<tbody>
  <tr>
    <td>Surname</td>
    <td><b>' . $personWithNumber->getSurname() . '</b></td>
  </tr>
  <tr>
    <td>Phone Number</td>
    <td><b>' . $personWithNumber->getNumber() . '</b></td>
  </tr>
</tbody>
</table>
<hr>
';
    } else {
        echo 'A person with that number has not been found';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Number database</title>
</head>
<body>
<form action="/" method="post">
    <label for="search">Person number</label>
    <input type="text" id="search" name="number"/>
    <button type="Submit">
        Search
    </button>
</form>
</body>
</html>
