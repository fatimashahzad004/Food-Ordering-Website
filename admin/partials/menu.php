<?php
include('../config/constants.php');
include('login-check.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Navbar</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      background-color: #f8f9fa;
    }

    .navbar {
      background-color: #ff6b35;
      color: white;
      padding: 15px 5%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .navbar .logo {
      font-size: 1.4rem;
      font-weight: bold;
      letter-spacing: 1px;
    }

    .navbar ul {
      list-style: none;
      display: flex;
      gap: 25px;
    }

    .navbar ul li a {
      text-decoration: none;
      color: white;
      font-weight: 500;
      transition: 0.3s;
    }

    .navbar ul li a:hover {
      color: #ffeaa7;
      border-bottom: 2px solid white;
      padding-bottom: 3px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .navbar ul {
        display: none;
        flex-direction: column;
        background-color: #ff6b35;
        position: absolute;
        top: 60px;
        right: 0;
        width: 200px;
        border-radius: 5px;
      }

      .navbar.active ul {
        display: flex;
      }

      .menu-toggle {
        display: block;
        cursor: pointer;
      }
    }

    .menu-toggle {
      display: none;
      font-size: 1.6rem;
      color: white;
    }
  </style>
</head>
<body>

  <nav class="navbar">
    <div class="logo">🍽️ Admin Panel</div>

    <div class="menu-toggle" onclick="toggleMenu()">☰</div>

    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="manage-admin.php">Admin</a></li>
      <li><a href="manage-category.php">Category</a></li>
      <li><a href="manage-food.php">Food</a></li>
      <li><a href="manage-order.php">Order</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>

  <script>
    function toggleMenu() {
      document.querySelector(".navbar").classList.toggle("active");
    }
  </script>

</body>
</html>
