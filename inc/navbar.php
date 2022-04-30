<?php require 'config/session.php'; ?>
<nav>
    <div class="nav-brand">
        <a href="index.php"><i class="fa-brands fa-rocketchat"></i> CHATTER</a>
    </div>
    <div>
        <ul class="nav-items">
            <li class="nav-link">
                <a href="index.php">Home</a>
            </li>
            <?php if ( !$user ): ?>
            <li class="nav-link">
                <a href="login.php">Log In</a>
            </li>
            <li class="nav-link">
                <a href="register.php">Register</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
    <?php if ( $user ): ?>
    <div class="user">
        <a href="#"><?= $username; ?></a>
        <div class="profile-pic"><a href="#"><img src="userImages/<?= $picture ?>" alt=""></a></div>
        <div class="user-dropdown">
            <a href="logout.php">Sign Out</a>
        </div>
    </div>
    <?php else: ?> 
    <div class="nav-signedout">
        <ul class="nav-items">
            <li class="nav-link">
                <a href="#">Log In</a>
            </li>
            <li class="nav-link">
                <a href="#">Register</a>
            </li>
        </ul>
    </div>
    <?php endif; ?>
</nav>