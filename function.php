<?php

$db = new SQLite3('mydata.db');

/// بررسی کردن یکتا بودن ایمیل
function emailchek($id) {
    $db = new SQLite3('mydata.db');
    $userchek = $db->query("SELECT email
                         FROM user
                         where email='$id'
                         ");


    if ($userchek->fetchArray()) {
        return FALSE;
    } else {
        return TRUE;
    }
}



///  وارد کردن اطلاعات به دیتابیس
function insert($email, $pass, $name, $lastname, $mobile) {
        $db = new SQLite3('mydata.db');

    $db->query("
            insert into user (email ,name , laste_name , mobile ,password  ) values
         
('$email','$name','$lastname','$mobile','$pass')


              ");
}
