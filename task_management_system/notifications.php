<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['role']) && isset($_SESSION['id'])){
    include "DB_connection.php";
    include "app/Model/Notification.php";
    //include "app/Model/User.php";

    


   $notifications = get_all_my_notifications($conn, $_SESSION['id']);

   
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <input type="checkbox" id="checkbox">
<?php include "inc/header.php" ?>
    <div class="body">
        <?php include "inc/nav.php" ?>
        <section class="section-1">
            <h4 class="title">All Notifications</h4>
            <?php if (isset($_GET['success'])) { ?>
        <div class="success" role="alert">
            <?php echo htmlspecialchars($_GET['success']); ?>   
        </div>
    <?php } ?>
         <?php if (!empty($notifications)) { ?>



            <table class="main-table">
                <tr>
                    <th>#</th>
                    <th>Message</th> 
                    <th>Type</th>
                    <th>Date</th>
                    
                </tr>
                <?php $i=0; foreach ($notifications as $notification) { ?>

                <tr>
                    <td><?=++$i?></td>
                    <td><?=$notification['message']?></td>
                    <td><?=$notification['type']?></td> 
                    <td><?=$notification['date']?></td>

                </tr>
            <?php } ?>

            </table>
        <?php }else { ?>
            <h3>You have zero notification</h3>
        <?php }?>

            
        </section>
    </div>


    <script type="text/javascript">
        var active = document.querySelector("#navList li:nth-child(4)");
        active.classList.add("active");
    </script>
    

    </script>
</body>
</html>

<?php
 }else{ 
 $em = "First login";
header("Location: login.php?info=" . urlencode($em));
exit();
}
?>