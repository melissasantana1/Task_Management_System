<?php
function get_all_my_notifications($conn, $recipient){
    $sql = "SELECT * FROM notifications WHERE recipient = ? LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$recipient]); // apenas 1 valor no array

    return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
}

function count_notification($conn, $id){
    $sql = "SELECT id FROM notifications WHERE recipient=? AND is_read=0";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->rowCount();
}


function insert_notification($conn, $data) {
    $sql = "INSERT INTO notifications (message, recipient, type, date, is_read) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $data['message'],
        $data['recipient'],
        $data['type'],
        $data['date'],
        isset($data['is_read']) ? $data['is_read'] : 0
    ]);
}


function notification_make_read($conn, $recipient_id, $notification_id){
  $sql = "UPDATE notifications SET is_read=1 WHERE id=? AND recipient=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$notification_id, $recipient_id]);

   

}
?>