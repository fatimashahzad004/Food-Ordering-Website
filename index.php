<?php include('partials-front/menu.php'); ?>

<!-- Search Section -->
<section class="food-search" style="background:#f8f8f8; padding:40px 0; text-align:center;">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST" 
              style="display:flex; justify-content:center; gap:10px; flex-wrap:wrap;">
            <input type="search" name="search" placeholder="Search for Food.." required 
                   style="padding:10px 15px; border-radius:6px; border:1px solid #ccc; width:300px;">
            <input type="submit" name="submit" value="Search" 
                   style="padding:10px 20px; background:#ff6b35; border:none; border-radius:6px; color:#fff; cursor:pointer;">
        </form>
    </div>
</section>

<?php
if(isset($_SESSION['order'])) {
    echo "<div style='text-align:center; padding:15px; margin:20px auto; background:#d4edda; color:#155724; border-radius:6px; width:fit-content;'>".$_SESSION['order']."</div>";
    unset($_SESSION['order']);
}
?>

<!-- Categories Section -->
<section class="categories" style="padding:50px 0; background:#fff;">
    <div class="container">
        <h2 style="text-align:center; color:#ff6b35; font-size:1.8rem; font-weight:bold; margin-bottom:30px;">
            Explore Foods
        </h2>

        <div style="display:flex; flex-wrap:wrap; gap:25px; justify-content:center;">
        <?php
        $sql = "SELECT * FROM tbl_category WHERE active='yes' AND featured='yes'";
        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>" 
               style="text-decoration:none; color:#333; flex:0 0 250px;">
                <div style="position:relative; border-radius:12px; overflow:hidden; box-shadow:0 6px 15px rgba(0,0,0,0.1); transition:transform 0.3s;">
                    <?php if($image_name=="") { 
                        echo "<div style='padding:50px; text-align:center; color:#e74c3c;'>Image Not Available</div>";
                    } else { ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" 
                             alt="<?php echo $title; ?>" style="width:100%; height:200px; object-fit:cover;">
                    <?php } ?>
                    <h3 style="position:absolute; bottom:0; left:0; width:100%; background:rgba(0,0,0,0.6); color:#fff; padding:10px; text-align:center; font-size:1.1rem;">
                        <?php echo $title; ?>
                    </h3>
                </div>
            </a>
        <?php } 
        } else {
            echo "<div style='text-align:center; color:#e74c3c;'>Category not Added.</div>";
        } ?>
        </div>
    </div>
</section>

<!-- Food Menu Section -->
<section class="food-menu" style="padding:50px 0; background:#f8f8f8;">
    <div class="container">
        <h2 style="text-align:center; color:#ff6b35; font-size:1.8rem; font-weight:bold; margin-bottom:30px;">
            Food Menu
        </h2>

        <div style="display:flex; flex-wrap:wrap; gap:30px; justify-content:center;">
        <?php
        $sql2 = "SELECT * FROM tbl_food WHERE active='yes' AND featured='yes'";
        $res2 = mysqli_query($conn, $sql2);

        if(mysqli_num_rows($res2) > 0) {
            while($row = mysqli_fetch_assoc($res2)) {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
        ?>
            <div style="background:#fff; border-radius:12px; overflow:hidden; width:300px; box-shadow:0 6px 15px rgba(0,0,0,0.1); transition:transform 0.3s; text-align:center;">
                <div style="height:200px; overflow:hidden;">
                    <?php if($image_name=="") {
                        echo "<div style='padding:50px; color:#e74c3c;'>Image Not Available</div>";
                    } else { ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" 
                             alt="<?php echo $title; ?>" style="width:100%; height:100%; object-fit:cover; transition:transform 0.3s;">
                    <?php } ?>
                </div>
                <div style="padding:15px;">
                    <h4 style="margin-bottom:5px;"><?php echo $title; ?></h4>
                    <p style="color:#ff6b35; font-weight:600; margin-bottom:10px;">$<?php echo $price; ?></p>
                    <p style="font-size:0.9rem; color:#555;"><?php echo $description; ?></p>
                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" 
                       style="display:inline-block; margin-top:10px; background:#ff6b35; color:#fff; padding:8px 20px; border-radius:6px; text-decoration:none;">
                        Order Now
                    </a>
                </div>
            </div>
        <?php } 
        } else {
            echo "<div style='text-align:center; color:#e74c3c;'>Food not available.</div>";
        } ?>
        </div>
    </div>
</section>



<?php include('partials-front/footer.php'); ?>

<!-- Hover Effects -->
<style>
.food-card:hover, .category-card:hover {
    transform: translateY(-5px);
}
.food-card img:hover {
    transform: scale(1.05);
}
</style>