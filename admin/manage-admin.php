<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1 class="text-center">Manage Admin</h1>
    <br>

    <?php 
    // Session messages
    $messages = ['add','delete','update','user-not-found','pwd-not-match','change-pwd'];
    foreach($messages as $msg){
        if(isset($_SESSION[$msg])){
            echo "<div class='success-msg'>".$_SESSION[$msg]."</div>";
            unset($_SESSION[$msg]);
        }
    }
    ?>

    <br>
    <a href="<?php echo SITEURL; ?>admin/add-admin.php" class="btn-primary">➕ Add Admin</a>
    <br><br>

    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
      </tr>

      <?php
      $sql = "SELECT * FROM tbl_admin";
      $res = mysqli_query($conn, $sql);
      if($res == TRUE){
          $count = mysqli_num_rows($res);
          $sn = 1;
          if($count > 0){
              while($rows = mysqli_fetch_assoc($res)){
                  $id = $rows['id'];
                  $full_name = $rows['full_name'];
                  $user_name = $rows['user_name'];
      ?>
      <tr>
        <td><?php echo $sn++; ?>.</td>
        <td><?php echo $full_name; ?></td>
        <td><?php echo $user_name; ?></td>
        <td>
          <a href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $id; ?>" class="btn btn-primary">Change Password</a>
          <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn btn-update">Update</a>
          <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn btn-delete">Delete</a>
        </td>
      </tr>
      <?php
              }
          } else {
              echo "<tr><td colspan='4' class='error text-center'>No Admin Added Yet.</td></tr>";
          }
      }
      ?>
    </table>
  </div>
</div>

<?php include('partials/footer.php'); ?>

<style>
body {
    background-color: #fff8f0;
    font-family: "Poppins", sans-serif;
}

.wrapper { width: 85%; margin: 0 auto; }
.main-content { padding: 3% 0; }

h1.text-center {
    text-align:center;
    font-size:28px;
    color:#f6a828;
    font-weight:bold;
    margin-bottom:10px;
    text-shadow:1px 1px 2px rgba(0,0,0,0.1);
}

/* Buttons */
.btn-primary {
    background: linear-gradient(135deg,#f6a828,#ff6f00);
    color:white;
    padding:10px 18px;
    border-radius:6px;
    text-decoration:none;
    font-weight:500;
    box-shadow:0 2px 6px rgba(0,0,0,0.15);
    transition:0.2s ease;
}
.btn-primary:hover { background: linear-gradient(135deg,#ffb84d,#ff8c1a); }

.tbl-full {
    width:100%;
    border-collapse:collapse;
    background:#fff;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
    border-radius:8px;
    overflow:hidden;
}
th, td {
    padding:12px 15px;
    text-align:center;
    border-bottom:1px solid #ddd;
}
th { background:#fff2e6; font-weight:600; }
tr:hover { background-color:#fff5e6; }

.btn {
    padding:6px 12px;
    border-radius:5px;
    color:white;
    text-decoration:none;
    font-size:14px;
    font-weight:500;
    transition:0.2s ease;
}
.btn-update { background: linear-gradient(135deg,#28a745,#218838); }
.btn-update:hover { background: linear-gradient(135deg,#45c153,#2e8b3f); }
.btn-delete { background: linear-gradient(135deg,#e74c3c,#c0392b); }
.btn-delete:hover { background: linear-gradient(135deg,#ff5e4d,#a83227); }

.error { color:red; font-weight:500; }
.success-msg { background:#fff3cd; color:#856404; padding:10px; border-radius:5px; margin-bottom:15px; }

.text-center { text-align:center; }

.footer {
    background: linear-gradient(135deg,#f6a828,#ff6f00);
    color:white;
    text-align:center;
    padding:1%;
    margin-top:30px;
}
.footer a { color:white; text-decoration:none; }
.footer a:hover { text-decoration:underline; }
</style>
