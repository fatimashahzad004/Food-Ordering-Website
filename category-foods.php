<?php include('partials-front/menu.php'); ?>

<?php
if(isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
} else {
    header('location:'.SITEURL);
}
?>

<!-- ===================== FOOD SEARCH / CATEGORY HEADING ===================== -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods in <span class="category-highlight">"<?php echo $category_title ?>"</span></h2>
    </div>
</section>

<!-- ===================== FOOD MENU ===================== -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);

        if($count2 > 0) {
            while($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2['id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php if($image_name == "") { ?>
                            <div class="error">Image Not Available</div>
                        <?php } else { ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                        <?php } ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='error'>Food Not Available.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>

<!-- ===================== STYLES ===================== -->
<style>
/* Container */
.container {
    max-width: 880px;
    margin: auto;
    padding: 25px;
    font-family: Arial, sans-serif;
}

/* Category Heading */
.food-search h2 {
    font-size: 30px;
    font-weight: 800;
    color: #ff9500;
    margin-bottom: 50px;
}
.food-search .category-highlight {
    color: #222;
}

/* Food Menu Heading */
.food-menu h2 {
    text-align: center;
    font-size: 36px;
    font-weight: 800;
    color: #ff9500;
    margin-bottom: 50px;
    position: relative;
}
.food-menu h2::after {
    content:'';
    position: absolute;
    width: 70px;
    height: 4px;
    background: #ff9500;
    left: 50%;
    transform: translateX(-50%);
    bottom: -12px;
    border-radius: 2px;
    box-shadow: 0 2px 6px rgba(255,149,0,0.4);
}

/* Food Cards - 1 per row */
.food-menu-box {
    display: flex;
    flex-direction: row;
    background: linear-gradient(145deg, #fff, #fdf5e6);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    margin-bottom: 25px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.food-menu-box:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 12px 30px rgba(0,0,0,0.18);
}

/* Food Image */
.food-menu-img {
    flex: 1;
    max-width: 250px;
    overflow: hidden;
}
.food-menu-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 18px 0 0 18px;
    transition: transform 0.3s ease;
}
.food-menu-box:hover img {
    transform: scale(1.04);
}

/* Food Description */
.food-menu-desc {
    flex: 2;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.food-menu-desc h4 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 10px;
}
.food-price {
    color: #ff9500;
    font-weight: 700;
    margin-bottom: 10px;
}
.food-detail {
    font-size: 14px;
    color: #555;
    margin-bottom: 15px;
}

/* Button - Full Width */
.btn-primary {
   align-self: flex-start;
    padding: 8px 20px;
    border-radius: 25px;
    text-decoration: none;
    color: #fff;
    background-color: #ff9500;
    font-weight: bold;
    transition: 0.3s ease;
}
.btn-primary:hover {
    background-color: #e68a00;
}

/* Error Message */
.error {
    width: 100%;
    padding: 40px 20px;
    text-align: center;
    background-color: #f8d7da;
    color: #721c24;
    font-weight: 700;
    border-radius: 18px;
}

/* Responsive */
@media(max-width: 768px){
    .food-menu-box {
        flex-direction: column;
    }
    .food-menu-img {
        max-width: 100%;
        height: 200px;
        border-radius: 18px 18px 0 0;
    }
}
</style>
