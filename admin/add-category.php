<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1 class="text-center">Add Category</h1>
    <br>

    <?php
    if (isset($_SESSION['add'])) {
      echo "<div class='success-msg'>".$_SESSION['add']."</div>";
      unset($_SESSION['add']);
    }

    if (isset($_SESSION['upload'])) {
      echo "<div class='error-msg'>".$_SESSION['upload']."</div>";
      unset($_SESSION['upload']);
    }
    ?>
    <br>

    <form action="" method="POST" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
          <td>Title:</td>
          <td>
            <input type="text" name="title" placeholder="Category Title" required>
          </td>
        </tr>

        <tr>
          <td>Featured:</td>
          <td>
            <div class="radio-group">
              <label><input type="radio" name="featured" value="Yes"> Yes</label>
              <label><input type="radio" name="featured" value="No"> No</label>
            </div>
          </td>
        </tr>

        <tr>
          <td>Active:</td>
          <td>
            <div class="radio-group">
              <label><input type="radio" name="active" value="Yes"> Yes</label>
              <label><input type="radio" name="active" value="No"> No</label>
            </div>
          </td>
        </tr>

        <tr>
          <td>Select Image:</td>
          <td>
            <input type="file" name="image">
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Category" class="btn-primary">
          </td>
        </tr>
      </table>
    </form>

    <?php
    if (isset($_POST['submit'])) {
      $title = $_POST['title'];
      $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
      $active = isset($_POST['active']) ? $_POST['active'] : "No";

      // Image upload handling
      if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image_name = $_FILES['image']['name'];
        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_name = "Category_" . rand(1000,9999) . ".".$ext;

        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/category/".$image_name;

        $upload = move_uploaded_file($source_path, $destination_path);

        if ($upload==false){
          $_SESSION['upload'] = "❌ Failed to Upload Image.";
          header('location:'.SITEURL.'admin/add-category.php');
          die();
        }
      } else {
        $image_name = "";
      }

      $sql = "INSERT INTO tbl_category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'";

      $res = mysqli_query($conn, $sql);

      if($res==true){
        $_SESSION['add'] = "✅ Category Added Successfully.";
        header('location:'.SITEURL.'admin/manage-category.php');
      } else {
        $_SESSION['add'] = "❌ Failed to Add Category.";
        header('location:'.SITEURL.'admin/add-category.php');
      }
    }
    ?>
  </div>
</div>

<style>
body {
  background-color: #fff8f0;
  font-family: "Poppins", sans-serif;
}
.wrapper { 
  width: 40%; 
  margin: 50px auto; 
  padding:30px; 
  background:#fff; 
  border-radius:10px; 
  box-shadow:0 6px 15px rgba(0,0,0,0.1); 
}
h1.text-center { 
  text-align:center; 
  color:#f6a828; 
  font-size:26px; 
  margin-bottom:20px; 
  font-weight:bold; 
}

.tbl-30 td { 
  padding:10px; 
  vertical-align: middle; 
}
input[type="text"], input[type="file"] { 
  width:100%; 
  padding:8px; 
  margin-bottom:12px; 
  border:1px solid #ccc; 
  border-radius:5px; 
}
input[type="text"]:focus, input[type="file"]:focus { 
  outline:none; 
  border-color:#f6a828; 
  box-shadow:0 0 5px rgba(246,168,40,0.4); 
}

/* Radio button alignment */
.radio-group {
  display: flex;
  gap: 25px;
  align-items: center;
}
.radio-group label {
  font-weight: 500;
  color: #333;
  cursor: pointer;
}
.radio-group input[type="radio"] {
  margin-right: 6px;
  transform: scale(1.1);
}

.btn-primary {
  background: linear-gradient(135deg,#f6a828,#ff6f00);
  color:white;
  padding:10px 15px;
  border-radius:6px;
  font-weight:500;
  text-decoration:none;
  cursor:pointer;
  width:100%;
  transition:0.3s ease;
}
.btn-primary:hover { 
  background: linear-gradient(135deg,#ffb84d,#ff8c1a); 
}

.success-msg { 
  background:#fff3cd; 
  color:#856404; 
  padding:10px; 
  border-radius:5px; 
  margin-bottom:15px; 
  font-weight:bold; 
}
.error-msg { 
  background:#f8d7da; 
  color:#842029; 
  padding:10px; 
  border-radius:5px; 
  margin-bottom:15px; 
  font-weight:bold; 
}
</style>

<?php include('partials/footer.php'); ?>
