<?php

require_once("vendor/autoload.php");

use App\Chat;
use App\Message;

$chat = new Chat();
if (isset($_POST["sender"]) && isset($_POST["message"]))
{
    $chat->send(new Message($_POST["sender"], $_POST["message"]));
    header("Location: /");
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<body>
<table class="table">
    <tbody>
    <?php
    foreach ($chat->getMessages() as $message)
    {
        if (is_a($message, "App\Message"))
        {
            echo "<tr>";
            echo "<td><b>{$message->getSender()}</b>: {$message->getText()}</td>";
            echo "</tr>";
        }
    }
    ?>
    </tbody>
</table>
<form method="post">
    <div class="form-group">
        <label for="sender">Sender</label>
        <input type="text" name="sender" id="sender"><br>
        <label for="message">Message</label>
        <textarea class="form-control" name="message" id="message" rows="3"></textarea><br>
        <button type="submit" class="btn btn-primary">Send</button>
    </div>
</form>
</body>
</html>
