<?php

declare(strict_types=1);

session_start();
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
require_once './Message.php';
require_once './MessageStorage.php';


if ($_POST['logout'] === '1') {
    session_unset();
}

if (isset($_POST['result'])) {

    $database = new UserStorage();

    $pin = $_POST['result'];

    $personWithNumber = $database->loginWithPin((int)$pin);

    $_SESSION['user'] = $personWithNumber->getName();
    $_SESSION['id'] = $personWithNumber->getId();
}

if ($_SESSION['user'] === NULL) {
    //session not started
    ?>
    <form action="/" method="post">
        <label for="search">Your login pin</label>
        <input type="text" id="search" name="result"/>
        <button type="Submit">Enter</button>
    </form>
    <?php
}
//-------------------------

if ($_SESSION['user'] !== NULL) {
    //session started
    $record = $_POST['add'];
    $message = $_POST['message'];

    if (isset($_POST['message'])) {
        $test = new Message($_SESSION['id'], $message);
        $messages = new MessageStorage();
        $arrayMessage = $test->toArray();
        $messages->saveMessage($arrayMessage, $record);
        //Header('Location: ' . $_SERVER['PHP_SELF']);
    }

    ?>
    <form action="/" method="post">
        <label for="search">Enter a message</label>
        <input type="hidden" name="add" value="addmsg"/>
        <input type="text" name="message"/>
        <input type="Submit" value="Add message">
    </form>
    <form action="/" method="post">
        <input name="logout" value="1" type="hidden">
        <input type="Submit" value="Log me out">
    </form>
    <br>
    <hr>
    <br>
    <?php
    $file = file("messages.csv");
    $file = array_reverse($file);
    foreach ($file as $f) {

        echo $f . "<br />";
    }

}
