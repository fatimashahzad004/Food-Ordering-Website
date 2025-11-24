<?php include('partials-front/menu.php'); ?>

<!-- ===================== FOOD SEARCH Section ===================== -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- ===================== FOOD SEARCH Section Ends ===================== -->

<!-- ===================== FOOD Menu Section ===================== -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if($count > 0) {
            while($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php if($image_name == "") { ?>
                            <div class="error">Image not Available</div>
                        <?php } else { ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" 
                                 alt="<?php echo $title; ?>" class="img-responsive img-curve">
                        <?php } ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <br>
                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='error'>Food not found.</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- ===================== FOOD Menu Section Ends ===================== -->

<!-- ===================== Social Section ===================== -->

<!-- ===================== Social Section Ends ===================== -->

<?php include('partials-front/footer.php'); ?>

<!-- ===================== STYLE ===================== -->
<style>
/* --------------------- GENERAL --------------------- */
.container {
    width: 100%;
    max-width: 880px;
    margin: auto;
    padding: 20px;
    font-family: Arial, sans-serif;
}

/* --------------------- SEARCH BAR --------------------- */
.food-search input[type="search"] {
    width: 60%;
    padding: 10px 15px;
    border-radius: 25px;
    border: 1px solid #ccc;
    outline: none;
    font-size: 16px;
}

.food-search input[type="submit"] {
    padding: 10px 25px;
    border-radius: 25px;
    border: none;
    background-color: #ff9500;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s ease;
}

.food-search input[type="submit"]:hover {
    background-color: #e08600;
}

/* --------------------- FOOD MENU --------------------- */
.food-menu h2 {
    text-align: center;
    font-size: 30px;
    margin-bottom: 30px;
    color: #ff9500;
    font-weight: 700;
}

/* Food Card */
.food-menu-box {
    display: flex;
    background: #fff;
    border-radius: 14px;
    margin-bottom: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: 0.25s ease;
}

.food-menu-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 16px rgba(0,0,0,0.2);
}

/* Food Image */
.food-menu-img {
    flex: 1;
    max-width: 200px;
    overflow: hidden;
}

.food-menu-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Food Description */
.food-menu-desc {
    flex: 2;
    padding: 15px 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.food-menu-desc h4 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #222;
}

.food-price {
    color: #ff9500;
    font-weight: bold;
    margin-bottom: 10px;
}

.food-detail {
    font-size: 14px;
    color: #555;
    margin-bottom: 15px;
}

.food-menu-desc .btn {
    align-self: flex-start;
    padding: 8px 20px;
    border-radius: 25px;
    text-decoration: none;
    color: #fff;
    background-color: #ff9500;
    font-weight: bold;
    transition: 0.3s ease;
}

.food-menu-desc .btn:hover {
    background-color: #e08600;
}

/* Error Message */
.error {
    width: 100%;
    padding: 40px 20px;
    text-align: center;
    background-color: #f8d7da;
    color: #721c24;
    font-weight: 600;
    border-radius: 14px;
}

/* --------------------- SOCIAL ICONS --------------------- */
.social ul {
    display: flex;
    justify-content: center;
    gap: 20px;
    list-style: none;
    padding: 20px 0;
}

.social ul li a img {
    width: 40px;
    height: 40px;
    transition: 0.3s ease;
}

.social ul li a img:hover {
    transform: scale(1.1);
}

/* --------------------- RESPONSIVE --------------------- */
@media (max-width: 768px) {
    .food-menu-box {
        flex-direction: column;
    }

    .food-menu-img {
        max-width: 100%;
        height: 200px;
    }
}

@media (max-width: 480px) {
    .food-search input[type="search"] {
        width: 100%;
        margin-bottom: 10px;
    }

    .food-search input[type="submit"] {
        width: 100%;
    }
}
</style>
