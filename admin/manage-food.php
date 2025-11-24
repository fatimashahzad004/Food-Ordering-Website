<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1 class="text-center">Manage Food</h1>
    <br>

    <?php
    // Display session messages
    $messages = ['add','delete','upload','unauthorize','update'];
    foreach($messages as $msg){
        if(isset($_SESSION[$msg])){
            echo "<div class='success-msg'>".$_SESSION[$msg]."</div>";
            unset($_SESSION[$msg]);
        }
    }
    ?>

    <br>
    <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">➕ Add Food</a>
    <br><br>

    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
      </tr>

      <?php
      // Query to get all food
      $sql = "SELECT * FROM tbl_food";
      $res = mysqli_query($conn, $sql);

      if($res==TRUE){
          $count = mysqli_num_rows($res);
          $sn = 1;

          if($count > 0){
              while($row = mysqli_fetch_assoc($res)){
                  $id = $row['id'];
                  $title = $row['title'];
                  $price = $row['price'];
                  $image_name = $row['image_name'];
                  $featured = $row['featured'];
                  $active = $row['active'];
      ?>
      <tr>
        <td><?php echo $sn++; ?>.</td>
        <td><?php echo $title; ?></td>
        <td><?php echo $price; ?> PKR</td>
        <td>
          <?php 
          if($image_name != ""){
              ?>
              <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px" style="border-radius:16px;">
              <?php
          } else {
              echo "<div class='error'>Image Not Added.</div>";
          }
          ?>
        </td>
        <td><?php echo $featured; ?></td>
        <td><?php echo $active; ?></td>
        <td>
          <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn btn-update">Update</a>
          <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn btn-delete">Delete</a>
        </td>
      </tr>
      <?php
              }
          } else {
              echo "<tr><td colspan='7' class='error text-center'>No Food Added Yet.</td></tr>";
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
