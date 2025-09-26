	<header class="header">
    <h2 class="u-name">Task <b>Pro</b>
        <label for="checkbox">
            <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
        </label>
    </h2>

    <!-- Badge de notificação -->
    <div class="notification" id="notificationBtn">
        <i class="fa fa-bell" aria-hidden="true"></i>
        <span class="badge" id="notificationNum" style="display: none;"></span>
    </div>
</header>

<!-- Barra de notificações -->
<div class="notification-bar" id="notificationBar">
    <ul id="notifications">
      
    </ul>
</div>


	<script type="text/javascript">
	


document.addEventListener("DOMContentLoaded", function() {
    var openNotification = false;

    const notification = ()=> {
    let notificationBar = document.querySelector("#notificationBar");
    if (openNotification) {
    	notificationBar.classList.remove("open-notification");
    	openNotification = false;
    }else{
    	notificationBar.classList.add('open-notification');
    	openNotification = true;
    
        }
    }

    let notificationBtn = document.querySelector("#notificationBtn");
    notificationBtn.addEventListener("click", notification);
});
    
</script>


<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function(){
     
        $("#notificationNum").load("app/notification-count.php", function(response){
         $("#notifications").load("app/notification.php");   
      let count = parseInt(response) || 0;

      if (count > 0) {
        $(this).text(count).show();   // mostra a bolinha com o número
      } else {
        $(this).hide();               // esconde a bolinha se não tiver notificações
      }
    });
  });
</script>