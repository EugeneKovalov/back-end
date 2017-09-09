<?php

session_start();

$_SESSION['VIEW_COUNTER']++;

print_r($_SESSION);

session_write_close();

echo serialize($_SESSION);

?>

<form method="post">
    <input name="param3" value="4"/>
</form>
