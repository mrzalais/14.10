<?php

declare(strict_types=1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
</head>
<body>
<?php

require_once './User.php';
require_once './UserStorage.php';

//echo $_SESSION['user'];

//echo $_POST['logout'];

if ($_SESSION === NULL) {
    //session not started
?>
    <form action="/" method="post">
            <label for="search">Your login pin</label>
            <input type="text" id="search" name="result"/>
            <button type="Submit">Enter</button>
           </form>
    <?php
        }
if (isset($_POST['result'])) {
        $database = new UserStorage();

        $pin = $_POST['result'];

        $personWithNumber = $database->loginWithPin((int)$pin);

        $_SESSION['user'] = $personWithNumber->getName();
}
if (!$_SESSION['user']) {
    //session started
    echo'<form action="/" method="post">
        <label for="search">Enter a message to store</label>
        <input type="text" id="search" name="msg"/>
        <button type="Submit">Enter</button>
    </form>
    <form action="/" method="post">
        <input name="logout" value="1" type="hidden">
        <input type="Submit" value="Log me out">
    </form>';
}

if (isset($_POST['result'])) {
    $pin = $_POST['result'];

    $personWithNumber = $database->loginWithPin((int)$pin);

    if ($personWithNumber !== null) {
        $_SESSION['user'] = $personWithNumber->getName();
    }

    echo 'You entered ' . $_POST['msg'];

    if ($personWithNumber !== null) {
        echo '
<table>
<thead>
  <tr>
    <td>You are logged in as:</td>
    <td><b>' . $_SESSION['user'] . '</b></td>
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

if ($_POST['logout'] === '1') {
    session_unset();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
</head>
<body>
<?php if (empty($_SESSION['user'])) { ?>
    <form action="/" method="post">
        <label for="search">Your login pin</label>
        <input type="text" id="search" name="result"/>
        <button type="Submit">
            Enter
        </button>
    </form>
<?php }
if (!empty($_SESSION['user'])) { ?>
    <form action="/" method="post">
        <label for="search">Enter a message to store</label>
        <input type="text" id="search" name="msg"/>
        <button type="Submit">
            Enter
        </button>
    </form>
    <form action="/" method="post">
        <input name="logout" value="1" type="hidden">
        <input type="Submit" value="Log me out">
    </form>
<?php } ?>
</body>
</html>
