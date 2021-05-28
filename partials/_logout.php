<?php
session_start();
echo 'Logging you out..';

session_destroy();
header("Location: /eforum?logout=true");
?>