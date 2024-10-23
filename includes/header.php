<?php
// Ensure the session is started at the beginning of the script
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fetch user data if logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];

    // Get the number of articles written by the user
    $stmt = $conn->prepare('SELECT COUNT(*) FROM articles WHERE user_id = ?');
    $stmt->execute([$user_id]);
    $articleCount = $stmt->fetchColumn();
}
?>

<!-- Header -->
<header>
    <nav>
        <div class="logo-container">
            <a href="../index.php" class="logo"><img id="logo" src="../assets/images/logo.png" alt="EcoFit Life Logo"></a>
            <a href="../index.php" class="site-name">EcoFit Life</a>
        </div>
        <ul>
            <li><a href="../articles/articles.php">Articles</a></li>
            <li><a href="../fitness-tips.php">Fitness Tips</a></li>
            <li><a href="../about.php">About Us</a></li>
            <li><a href="../resources.php">Resources</a></li>
            <li><a href="../contact.php">Contact</a></li>

            <!-- Check if the user is logged in -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="../articles/write_articles.php">Write Article</a></li> 

                <!-- Display the profile image instead of logout -->
                <li class="dropdown">
                    <img src="../assets/images/image1.jpg" alt="Profile" class="profile-image" onclick="toggleDropdown()">
                    <div id="dropdown-content" class="dropdown-content">
                        <!-- Show different options depending on whether the user is admin or not -->
                        <?php if ($role === 'admin'): ?>
                            <p><?= htmlspecialchars($username); ?></p>
                            <p>Admin</p>
                            <a href="../admin/admin_dashboard.php">Admin Dashboard</a>
                        <?php else: ?>
                            <p><?= htmlspecialchars($username); ?></p>
                            <p>Articles Written: <?= $articleCount; ?></p>
                            <a href="../auth/user_dashboard.php">User Dashboard</a>
                            
                        <?php endif; ?>
                        <a href="../auth/logout.php">Logout</a>
                    </div>
                </li>
            <?php else: ?>
                <!-- If not logged in, show login and register options -->
                <li><a href="../auth/login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<script>
    // Toggle dropdown visibility when profile image is clicked
    function toggleDropdown() {
        document.getElementById('dropdown-content').classList.toggle('show');
    }
</script>
