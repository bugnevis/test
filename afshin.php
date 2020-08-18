<?php


$db = new SQLite3('mydata.db');
$query = $db->query("select * from user");

echo '<pre>';
while ($row = $query->fetchArray()) {
    
    print_r($row);
}
echo '</pre>';