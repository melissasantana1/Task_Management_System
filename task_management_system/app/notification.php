<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se usuário não estiver logado, retorna vazio
if (!isset($_SESSION['role']) || !isset($_SESSION['id'])) {
    echo "";
    exit;
}

include_once __DIR__ . '/../DB_connection.php';
include_once __DIR__ . '/Model/Notification.php';

$notifications = [];
try {
    $notifications = get_all_my_notifications($conn, (int) $_SESSION['id']);
    if (!is_array($notifications)) {
        $notifications = [];
    }
} catch (Throwable $e) {
    $notifications = [];
}

// Se não tiver notificações
if (empty($notifications)) {
    echo '<li>You have zero notifications</li>';
    exit;
}

// Renderiza notificações
foreach ($notifications as $notification) {
    $id      = isset($notification['id']) ? (int)$notification['id'] : 0;
    $type    = isset($notification['type']) ? htmlspecialchars($notification['type'], ENT_QUOTES, 'UTF-8') : '';
    $message = isset($notification['message']) ? htmlspecialchars($notification['message'], ENT_QUOTES, 'UTF-8') : '';
    $date    = isset($notification['date']) ? htmlspecialchars($notification['date'], ENT_QUOTES, 'UTF-8') : '';
    $is_read = isset($notification['is_read']) ? (int)$notification['is_read'] : 1;

    echo '<li>';
    echo '  <a href="app/notification-read.php?notification_id=' . $id . '">';
    
    if ($is_read === 0) {
        echo '    <mark>' . $type . '</mark>';
    } else {
        echo '    ' . $type;
    }

    echo ': ' . $message . ' &nbsp;&nbsp;<small>' . $date . '</small>';
    echo '  </a>';
    echo '</li>';
}
