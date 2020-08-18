<?php
        include_once 'function.php';
$db = new SQLite3('mydata.db');
$id='fere';
if (userchek($id)){
   $db->query("INSERT INTO user( username , email , mobile)
                     VALUES ('$id','feri@gmail.com','0912345678')
                     
                    "); 
        echo 'اسم وارد شد';
}
 else {
    echo 'این اسم قبلا وارد شده است';  
}

