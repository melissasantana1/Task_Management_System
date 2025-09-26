<nav class="side-bar">
    <div class="user-p">
        <img src="img/profilepic.png">
        <h4>@<?=$_SESSION['username']?></h4>
    </div>

    <?php 
    if (isset($_SESSION['role']) && $_SESSION['role'] == "employee") : ?>
        <!-- Employee Navigation Bar -->
        <ul id="navList">
            <li class="<?= $currentPage == 'dashboard.php' ? 'active' : '' ?>">
                <a href="index.php">
                    <i class="fa fa-tachometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="<?= $currentPage == 'my_task.php' ? 'active' : '' ?>">
                <a href="my_task.php">
                    <i class="fa fa-tasks"></i>
                    <span>My Task</span>
                </a>
            </li>
            <li class="<?= $currentPage == 'profile.php' ? 'active' : '' ?>">
                <a href="profile.php">
                    <i class="fa fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="<?= $currentPage == 'notifications.php' ? 'active' : '' ?>">
                <a href="notifications.php">
                    <i class="fa fa-bell"></i>
                    <span>Notifications</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>

    <?php else : ?>
        <!-- Admin Navigation Bar -->
        <ul id="navList">
            <li class="<?= $currentPage == 'dashboard.php' ? 'active' : '' ?>">
                <a href="index.php">
                    <i class="fa fa-tachometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="<?= $currentPage == 'user.php' ? 'active' : '' ?>">
                <a href="user.php">
                    <i class="fa fa-users"></i>
                    <span>Manage Users</span>
                </a>
            </li>
            <li class="<?= $currentPage == 'create_task.php' ? 'active' : '' ?>">
                <a href="create_task.php">
                    <i class="fa fa-plus"></i>
                    <span>Create Task</span>
                </a>
            </li>
            <li class="<?= $currentPage == 'tasks.php' ? 'active' : '' ?>">
                <a href="tasks.php">
                    <i class="fa fa-bell"></i>
                    <span>All Tasks</span>
                </a>
            </li>
            <li class="<?= $currentPage == 'notifications.php' ? 'active' : '' ?>">
                <a href="notifications.php">
                    <i class="fa fa-bell"></i>
                    <span>Notifications</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    <?php endif; ?>
</nav>
