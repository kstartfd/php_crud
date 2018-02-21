<?php

require 'sender.php';

//If get data from ajax response add sms_response
//to $sms varible and Create New Sms to db

if ($_REQUEST['sms_response']) {
  $sms = $_REQUEST['sms_response'];
        SmsSender::createNew($sms);
} else {
    $file = './last.txt';

    if (is_file($file)) {
        $date = file_get_contents($file);

        $date = strtotime($date);

        if (time() - $date < 3600 * 24 * DAYS_COUNT) exit;
        if (date('G') < 9 || date('G') > 12) exit; // send sms from 9 to 12
        if (in_array(date('N'), array(6, 7))) exit; // send sms from monday to friday

        unlink($file);
    }

    $need = rand(0, 1);
    if ($need) {
        if (SmsSender::notify()) {
            file_put_contents($file, date('Y-m-d H:i:s'));
        }
    }
}

echo json_encode($sms);

?>
