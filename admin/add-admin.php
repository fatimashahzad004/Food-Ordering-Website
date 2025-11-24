<?php
include('../config/constants.php'); 

if (isset($_POST['submit'])) {
    // Get form data
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Encrypt password

    // SQL query
    $sql = "INSERT INTO tbl_admin SET 
        full_name='$full_name',
        user_name='$username',
        password='$password'";

    // Execute query
    $res = mysqli_query($conn, $sql);
  
    if ($res == TRUE) {
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
        header("location:" . SITEURL . "admin/manage-admin.php");
        exit;
    } 
    else {
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
        header("location:" . SITEURL . "admin/add-admin.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Admin</title>
  <style>
    * {margin:0; padding:0; box-sizing:border-box; font-family: Arial, Helvetica, sans-serif;}
    body { background-color:#fff8f0; }
    .wrapper {
      width: 30%;
      margin: 70px auto;
      padding: 35px;
      border-radius: 10px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      background-color: #fff;
    }
    h1 {
      text-align: center;
      color: #f6a828;
      margin-bottom: 25px;
      font-size: 26px;
      font-weight: bold;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }
    label {
      display:block;
      font-weight:bold;
      margin-bottom:8px;
      color:#444;
      font-size:14px;
    }
    input[type="text"], input[type="password"] {
      width:100%;
      padding:10px;
      margin-bottom:18px;
      border:1px solid #ccc;
      border-radius:5px;
      font-size:14px;
      transition: all 0.3s ease;
    }
    input[type="text"]:focus, input[type="password"]:focus {
      border-color:#f6a828;
      box-shadow:0 0 5px rgba(246,168,40,0.4);
      outline:none;
    }
    .btn-submit {
      background: linear-gradient(135deg, #f6a828, #ff6f00);
      color:white;
      padding:10px 20px;
      border:none;
      border-radius:5px;
      font-weight:bold;
      cursor:pointer;
      font-size:16px;
      width:100%;
      transition: all 0.3s ease;
    }
    .btn-submit:hover {
      background: linear-gradient(135deg, #ffb84d, #ff8c1a);
    }
    .form-group { margin-bottom:20px; }

    /* Success/Error message */
    .success { background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:15px; }
    .error { background:#f8d7da; color:#721c24; padding:10px; border-radius:5px; margin-bottom:15px; }
  </style>
</head>
<body>

<?php include('partials/menu.php'); ?>

<div class="wrapper">

  <h1>Add Admin</h1>

  <?php 
  if(isset($_SESSION['add'])) { 
      echo $_SESSION['add']; 
      unset($_SESSION['add']); 
  }
  ?>

  <form action="" method="POST">
    <div class="form-group">
      <label>Full Name:</label>
      <input type="text" name="full_name" placeholder="Enter your name" required>
    </div>

    <div class="form-group">
      <label>Username:</label>
      <input type="text" name="username" placeholder="Your username" required>
    </div>

    <div class="form-group">
      <label>Password:</label>
      <input type="password" name="password" placeholder="Your password" required>
    </div>

    <input type="submit" name="submit" value="Add Admin" class="btn-submit">
  </form>
</div>

<?php include('partials/footer.php'); ?>

</body>
</html>
