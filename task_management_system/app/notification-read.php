<?php
// app/notification.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se usuário não estiver logado, apenas retorna vazio (não redireciona)
if (!isset($_SESSION['role']) || !isset($_SESSION['id'])) {
    echo "";
    exit;
}
include_once __DIR__ . '/../DB_connection.php';
include_once __DIR__ . '/Model/Notification.php';

// Marca a notificação como lida se veio o ID
if (isset($_GET['notification_id'])) {
    $notification_id = (int) $_GET['notification_id'];
    notification_make_read($conn, $_SESSION['id'], $notification_id);
}

// Sempre redireciona para a página de notificações
header("Location: ../notifications.php");
exit;
