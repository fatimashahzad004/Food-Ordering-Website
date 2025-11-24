
<?php
ob_start();
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* ===== Global Reset ===== */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    html, body {
      height: 100%;
      display: flex;
      flex-direction: column;
      background-color: #faf9f6;
      color: #333;
    }

    .wrapper {
      width: 90%;
      margin: 0 auto;
    }

    .text-center {
      text-align: center;
    }

    .clearfix {
      clear: both;
    }

    /* ===== Navbar ===== */
    .menu {
      background: linear-gradient(90deg, #1f1f1f, #3a3a3a);
      padding: 14px 0;
      text-align: center;
      box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    }

    .menu ul {
      list-style: none;
    }

    .menu ul li {
      display: inline-block;
      margin: 0 18px;
    }

    .menu ul li a {
      color: #f2f2f2;
      text-decoration: none;
      font-weight: 500;
      letter-spacing: 0.4px;
      transition: all 0.3s;
      padding: 6px 0;
      position: relative;
    }

    .menu ul li a::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -4px;
      width: 0%;
      height: 2px;
      background: #d4af37;
      transition: 0.3s;
    }

    .menu ul li a:hover::after {
      width: 100%;
    }

    /* ===== Main Section ===== */
    .main-content {
      flex: 1;
      padding: 3% 0;
    }

    /* ===== Dashboard Heading ===== */
    h1.text-center {
      position: relative;
      display: inline-block;
      font-size: 2.4rem;
      color: #2f2f2f;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      font-weight: 600;
      background: linear-gradient(90deg, #d4af37, #b8860b);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 20px;
    }

    h1.text-center::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -8px;
      width: 100%;
      height: 3px;
      background: linear-gradient(90deg, #d4af37, #f0e68c);
      border-radius: 2px;
      box-shadow: 0 0 8px rgba(212,175,55,0.6);
    }

    /* ===== Dashboard Boxes ===== */
    .col-4 {
      width: 22%;
      background: #fff;
      border-radius: 14px;
      padding: 25px;
      margin: 1.5%;
      float: left;
      text-align: center;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      border-top: 4px solid #d4af37;
    }

    .col-4:hover {
      transform: translateY(-6px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .col-4 h1 {
      color: #3a3a3a;
      font-size: 2rem;
      margin-bottom: 10px;
    }

    .col-4 p {
      color: #777;
      font-size: 1rem;
      font-weight: 500;
    }

    /* ===== Icons Styling ===== */
    .icon {
      font-size: 2.5rem;
      margin-bottom: 12px;
      display: inline-block;
      color: #d4af37;
      background: rgba(212,175,55,0.1);
      padding: 14px;
      border-radius: 50%;
      transition: all 0.3s ease;
    }

    .col-4:hover .icon {
      background: #d4af37;
      color: #fff;
      box-shadow: 0 0 10px rgba(212,175,55,0.6);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
      .col-4 {
        width: 45%;
        margin: 2.5%;
      }
    }

    @media (max-width: 600px) {
      .col-4 {
        width: 90%;
        margin: 5% auto;
      }

      .menu ul li {
        display: block;
        margin: 10px 0;
      }
    }

    /* ===== Footer ===== */
    .footer {
      background: #1f1f1f;
      color: #f2f2f2;
      text-align: center;
      padding: 18px 0;
      font-size: 14px;
      letter-spacing: 0.4px;
      box-shadow: 0 -3px 8px rgba(0,0,0,0.1);
    }

    .footer a {
      color: #d4af37;
      text-decoration: none;
      transition: 0.3s;
    }

    .footer a:hover {
      color: #f5e6b8;
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <?php include('partials/menu.php'); ?>

  <div class="main-content">
    <div class="wrapper text-center">
      <h1 class="text-center">Dashboard</h1>
      <br><br>

      <?php
        if(isset($_SESSION['login']))
        {
          echo $_SESSION['login'];
          unset($_SESSION['login']);
        }
      ?>
      <br><br>

      <div class="col-4">
        <div class="icon"><i class="fas fa-utensils"></i></div>
        <?php
          $sql = "SELECT * FROM tbl_category";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
        ?>
        <h1><?php echo $count; ?></h1>
        <p>Categories</p>
      </div>

      <div class="col-4">
        <div class="icon"><i class="fas fa-pizza-slice"></i></div>
        <?php
          $sql2 = "SELECT * FROM tbl_food";
          $res2 = mysqli_query($conn, $sql2);
          $count2 = mysqli_num_rows($res2);
        ?>
        <h1><?php echo $count2; ?></h1>
        <p>Foods</p>
      </div>

      <div class="col-4">
        <div class="icon"><i class="fas fa-box"></i></div>
        <?php
          $sql3 = "SELECT * FROM tbl_order";
          $res3 = mysqli_query($conn, $sql3);
          $count3 = mysqli_num_rows($res3);
        ?>
        <h1><?php echo $count3; ?></h1>
        <p>Total Orders</p>
      </div>

      <div class="col-4">
        <div class="icon"><i class="fas fa-dollar-sign"></i></div>
        <?php
          $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
          $res4 = mysqli_query($conn, $sql4);
          $row4 = mysqli_fetch_assoc($res4);
          $total_revenue = $row4['Total'];
        ?>
        <h1>$<?php echo $total_revenue; ?></h1>
        <p>Revenue Generated</p>
      </div>

      <div class="clearfix"></div>
    </div>
  </div>

  <?php include('partials/footer.php'); ?>

</body>
</html>
