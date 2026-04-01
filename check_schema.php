<?php
$db = new PDO('sqlite:database/database.sqlite');
$r = $db->query('PRAGMA table_info(users)');
while ($c = $r->fetch(PDO::FETCH_ASSOC)) {
    echo $c['name'] . "\n";
}
