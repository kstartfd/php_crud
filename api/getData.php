<?php

require 'sender.php';


$num_rec_per_page = 5;

//if get var  selectTotal from Select
if(isset($_GET["selectTotal"])) {
    $num_rec_per_page = $_GET["selectTotal"];
}


//if get var page from ajax
if (isset($_GET["page"])) {
  $page  = $_GET["page"];
} else {
  $page=1;
 };

$start_from = ($page-1) * $num_rec_per_page;

//get 2 params $start_from, $num_rec_per_page
$sql = SmsSender::selectAllWithParametrs($start_from, $num_rec_per_page);


$data['data'] = $sql;

//number of all records
$data['total'] = SmsSender::selectAllSender();


echo json_encode($data);

?>
