
<?php

require 'config.php';
require 'mysql.class.php';

set_time_limit(0);

$db = new mysql(DB_HOST, '', DB_USER, DB_PASSWORD, DB_NAME); // connecting to database

class SmsSender
{
    const TABLE = 'sms_list_tz';

    static function createNew($text)
    {
        $insert = array('TEXT' => self::clearText($text));
        SQLInsert(self::TABLE, $insert);
    }

    static function clearText($text)
    {
        $d = explode('©', $text);
        $text = $d[0];

        $text = str_replace(array("\r\n"), "", $text);
        $text = trim($text);
        return $text;
    }

    static function notify($text)
    {
        $sql = 'SELECT * FROM `' . self::TABLE . '` WHERE IS_SENDED = 0 ORDER BY RAND()';
        $exists = SQLSelectOne($sql);

        if (!$exists) {
            self::sendEmail('SMS NOT FOUND');
            return false;
        }

        self::sendSms($exists['TEXT']);
        self::sendEmail($exists['TEXT']);

        $exists['IS_SENDED'] = 1;

        SQLUpdate(self::TABLE, $exists);

        return true;
    }


    static function sendEmail($text)
    {
        echo 'Email sended: ' . $text . '<br>';
        return true;
    }

    public static function sendSms($text)
    {
        echo 'SMS sended: ' . $text . '<br>';
        return true;
    }

    public static function translitIt($str)
    {
        $tr = array(
            "А" => "A", "Б" => "B", "В" => "V", "Г" => "G",
            "Д" => "D", "Е" => "E", "Ж" => "J", "З" => "Z", "И" => "I",
            "Й" => "Y", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N",
            "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
            "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH",
            "Ш" => "SH", "Щ" => "SCH", "Ъ" => "", "Ы" => "YI", "Ь" => "",
            "Э" => "E", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b",
            "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
            "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
            "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
            "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya"
        );
        return strtr($str, $tr);
    }


    //Send query to SQLSelectAll() method and data result
    public static function selectAllWithParametrs($start_from, $num_rec_per_page) {
      $sql = 'SELECT * FROM ' . self::TABLE . ' Order By id desc LIMIT ' . $start_from . ' , ' . $num_rec_per_page ;
      $exists = SQLSelectAll($sql);
      return $exists;
    }

    //Send query to SQLSelectAll() method and return total number of  records
    public static function selectAllSender() {
      $sql = 'SELECT * FROM ' . self::TABLE;
      $exists = SQLNumOfRow($sql);
      return $exists;
    }


    //Delete method, get ID number of record
    public static function senderDelete($id) {
      $sql = 'DELETE FROM '. self::TABLE . ' WHERE id = ' . $id;
      SQLDelete($sql);
    }


    public static function senderUpdate($id, $data) {
        $dataFromForm = array('TEXT' => self::clearText($data), 'ID' => $id);
        SQLUpdate(self::TABLE, $dataFromForm);
    }
}

?>
