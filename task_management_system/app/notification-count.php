<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['role']) && isset($_SESSION['id'])){
    include "../DB_connection.php";
    include "Model/Notification.php";

   $count_notification = count_notification($conn, $_SESSION['id']);
    echo (int)$count_notification; // sempre retorna 0 ou mais
} else {
    echo 0;
}
?>