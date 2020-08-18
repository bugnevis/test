<?php

$db = new SQLite3('mydata.db');

$db->query("
        CREATE TABLE if not exists user(
            email text PRIMARY KEY ,
            name TEXT NOT NULL,
            laste_name TEXT NOT NULL,
            mobile  text not null,
            password text not null

                        );
            ");