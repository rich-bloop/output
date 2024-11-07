<?php
session_start();
// Redirect to login if user is not logged in
if (!isset($_SESSION["user"])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Expense Manager</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <!-- Sidebar navigation -->
    <div class="sidebar" id="sidebar">
        <!-- Close button for the sidebar -->
        <button class="close-btn" id="close-btn">&times;</button>
        <!-- Navigation links -->
        <a href="dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="#"><i class="fas fa-wallet"></i> Budget</a>
        <a href="#"><i class="fas fa-receipt"></i> Expenses</a>
        <a href="#"><i class="fas fa-history"></i> History</a>
    </div>

    <!-- Main content area -->
    <div class="content">
        <!-- Button to open the sidebar -->
        <button class="open-btn" id="open-btn">&#9776;</button>
        <div class="container">
            <h1>Welcome to Your Dashboard</h1>
            <!-- Dashboard content -->
            <div class="dashboard-container">
                <!-- Expenses summary card -->
                <div class="dashboard-card">
                    <h2>Your Expenses</h2>
                    <!-- Placeholder for expenses data -->
                    <p>No expenses recorded yet.</p>
                </div>
                <!-- Budget summary card -->
                <div class="dashboard-card">
                    <h2>Your Budgets</h2>
                    <!-- Placeholder for budgets data -->
                    <p>No budgets set yet.</p>
                </div>
                <!-- Account settings card -->
                <div class="dashboard-card">
                    <h2>Account Settings</h2>
                    <p><a href="logout.php">Logout</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get DOM elements
        const sidebar = document.getElementById('sidebar');
        const openBtn = document.getElementById('open-btn');
        const closeBtn = document.getElementById('close-btn');

        // Function to open the sidebar
        function openSidebar() {
            sidebar.classList.add('active');
        }

        // Function to close the sidebar
        function closeSidebar() {
            sidebar.classList.remove('active');
        }

        // Event listeners for opening and closing the sidebar
        openBtn.addEventListener('click', openSidebar);
        closeBtn.addEventListener('click', closeSidebar);
    </script>
</body>
</html>