<?php

require 'sender.php';
  //get id, text from edit modal
  $id  = $_POST["id"];
  $text = $_POST['text'];

  /**
   * send 2 @params  $id, $text  for update
   */
  SmsSender::senderUpdate($id, $text);

  echo json_encode($text);
?>
