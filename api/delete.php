<?php

require 'sender.php';

$id  = $_POST["id"];

SmsSender::senderDelete($id);

echo json_encode([$id]);

?>
