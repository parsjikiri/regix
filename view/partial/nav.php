<!--<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="img/profile_small.jpg" />
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">David Williams</span>
                        <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                        <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                        <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="index.php"><i class="fa fa-diamond"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li>
                <a href="ticket.php"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts</span></a>
            </li>
        </ul>

    </div>
</nav>-->
<?php include '../controller/dd.php'; ?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="../img/profile_small.jpg" />
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold"><?php echo $userEmail; ?></span>
                        <span class="text-muted text-xs block"><?php echo $userRole; ?> <b class="caret"></b></span>
                    </a>y
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">IN+</div>
            </li>

            <?php if ($userRole === 'admin'): ?>
                <li class="<?= ($current_page === '/regix/admin/dashboard.php') ? 'active' : '' ?>">
                    <a href="/regix/admin/dashboard.php"><i class="fa fa-bar-chart"></i><span class="nav-label">Dashboard</span></a>
                </li>
                <li class="<?= ($current_page === '/regix/admin/servicerequest.php') ? 'active' : '' ?>">
                    <a href="/regix/admin/servicerequest.php"><i class="fa fa-laptop"></i> <span class="nav-label">Requests</span></a>
                </li>
                <!--<li>
                    <a href="manage_users.php"><i class="fa fa-users"></i> <span class="nav-label">Manage Users</span></a>
                </li>
                <li>
                    <a href="reports.php"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">System Reports</span></a>
                </li>-->

            <?php elseif ($userRole === 'user'): ?>
                <li class="<?= ($current_page === '/regix/user/dashboard.php') ? 'active' : '' ?>">
                    <a href="/regix/user/dashboard.php"><i class="fa fa-ticket"></i>Service Request</a>
                </li>
            <?php else: ?>
                <li>
                    <a href="help.php"><i class="fa fa-question-circle"></i> <span class="nav-label">Help Desk</span></a>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</nav>