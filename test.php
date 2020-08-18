<?php




        $db = new SQLite3('mydata.db');

    $db->query("
            insert into user (email ,name , laste_name , mobile ,password  ) values
         
($email,$pass,$name,$lastname,$mobile),


              ");