<?php
ob_start(); // Start output buffering
include('partials/menu.php');
?>

<div class="main-content">
  <div class="wrapper">
    <h1 class="text-center">Add Food</h1>
    <br><br>

    <?php
    // Display upload error if exists
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
          <td><input type="text" name="title" placeholder="Title of the Food" required></td>
        </tr>

        <tr>
          <td>Description:</td>
          <td><textarea name="description" cols="30" rows="5" placeholder="Description of the Food." required></textarea></td>
        </tr>

        <tr>
          <td>Price:</td>
          <td><input type="number" name="price" min="0" step="0.01" required></td>
        </tr>

        <tr>
          <td>Select Image:</td>
          <td><input type="file" name="image" accept="image/*"></td>
        </tr>

        <tr>
          <td>Category:</td>
          <td>
            <select name="category" required>
              <?php
              $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
              $res = mysqli_query($conn, $sql);
              if(mysqli_num_rows($res) > 0){
                  while($row = mysqli_fetch_assoc($res)){
                      echo "<option value='".$row['id']."'>".$row['title']."</option>";
                  }
              } else {
                  echo "<option value='0'>No Category Found</option>";
              }
              ?>
            </select>
          </td>
        </tr>

        <tr>
          <td>Featured:</td>
          <td class="radio-group">
            <label><input type="radio" name="featured" value="Yes"> Yes</label>
            <label><input type="radio" name="featured" value="No" checked> No</label>
          </td>
        </tr>

        <tr>
          <td>Active:</td>
          <td class="radio-group">
            <label><input type="radio" name="active" value="Yes" checked> Yes</label>
            <label><input type="radio" name="active" value="No"> No</label>
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Food" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>

    <?php 
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
        $active = isset($_POST['active']) ? $_POST['active'] : "No";

        // Image Upload
        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=""){
            $image_name = $_FILES['image']['name'];
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_name = "Food_".rand(1000,9999).".".$ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/".$image_name;

            $upload = move_uploaded_file($source_path, $destination_path);
            if($upload==false){
                $_SESSION['upload'] = "❌ Failed to Upload Image.";
                header("location:".SITEURL."admin/add-food.php");
                die();
            }
        } else {
            $image_name = "";
        }

        $sql2 = "INSERT INTO tbl_food (title, description, price, image_name, category_id, featured, active)
                 VALUES ('$title','$description','$price','$image_name','$category','$featured','$active')";
        $res2 = mysqli_query($conn, $sql2);

        if($res2==true){
            $_SESSION['add'] = "<div class='success-msg'>✅ Food Added Successfully.</div>";
        } else {
            $_SESSION['add'] = "<div class='error-msg'>❌ Failed to Add Food.</div>";
        }

        header("location:".SITEURL."admin/manage-food.php");
        exit();
    }
    ?>
  </div>
</div>

<style>
.wrapper { max-width:700px; margin:40px auto; background:#fff; padding:25px; border-radius:10px; box-shadow:0 6px 15px rgba(0,0,0,0.1); }
h1 { text-align:center; color:#f6a828; margin-bottom:20px; }
.tbl-30 td { padding:10px; vertical-align: middle; }
input[type="text"], input[type="number"], textarea, select, input[type="file"] {
    width:100%; padding:8px; border:1px solid #ccc; border-radius:5px; margin-bottom:10px;
}
input[type="text"]:focus, input[type="number"]:focus, textarea:focus, select:focus { border-color:#f6a828; box-shadow:0 0 5px rgba(246,168,40,0.4); outline:none; }

.radio-group label { margin-right:15px; font-weight:500; }

.btn-secondary {
    background-color:#069e5c; color:white; padding:10px 18px; border-radius:6px; font-weight:500; width:100%; cursor:pointer;
}
.btn-secondary:hover { background-color:#04854d; }

.success-msg { background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:15px; text-align:center; font-weight:bold; }
.error-msg { background:#f8d7da; color:#842029; padding:10px; border-radius:5px; margin-bottom:15px; text-align:center; font-weight:bold; }
</style>

<?php
include('partials/footer.php');
ob_end_flush(); // Send output
?>
