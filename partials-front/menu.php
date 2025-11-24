<?php
include('config/constants.php');
?>

<!-- Navbar Section Starts Here -->
<nav class="navbar">
    <div class="logo">
        <a href="<?php echo SITEURL; ?>">
            <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive" style="height:40px;">
        </a>
    </div>

    <div class="menu-toggle" onclick="toggleMenu()">☰</div>

    <ul>
        <li><a href="<?php echo SITEURL; ?>">Home</a></li>
        <li><a href="<?php echo SITEURL; ?>categories.php">Categories</a></li>
        <li><a href="<?php echo SITEURL; ?>foods.php">Foods</a></li>
        <li><a href="#">Contact</a></li>
    </ul>
</nav>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

.navbar {
    background-color: #ff6b35; /* dark-orange like backend */
    color: white;
    padding: 15px 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.navbar .logo img {
    height: 40px;
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
    color: #ffeaa7; /* light gold hover */
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
        padding: 10px 0;
    }

    .navbar.active ul {
        display: flex;
    }

    .menu-toggle {
        display: block;
        cursor: pointer;
        font-size: 1.6rem;
        color: white;
    }
}

.menu-toggle {
    display: none;
}
</style>

<script>
function toggleMenu() {
    document.querySelector(".navbar").classList.toggle("active");
}
</script>
<!-- Navbar Section Ends Here -->
