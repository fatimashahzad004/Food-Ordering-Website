<?php include('partials-front/menu.php'); ?>

<section class="categories">
    <div class="container">
        <h2>Explore Categories</h2>

        <div class="categories-grid">

        <?php
        $sql = "SELECT * FROM tbl_category WHERE active='yes'";
        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) > 0)
        {
            while($row = mysqli_fetch_assoc($res))
            {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>

        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>" style="text-decoration:none;">
            <div class="category-card">

                <?php if($image_name == "") { ?>
                    <div class="error">Image not Available</div>
                <?php } else { ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>">
                <?php } ?>

                <div class="category-title"><?php echo $title; ?></div>

            </div>
        </a>

        <?php
            }
        }
        else
        {
            echo "<div class='error'>No Categories Found.</div>";
        }
        ?>

        </div>
    </div>
</section>

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

/* --------------------- HEADING --------------------- */
.categories h2 {
    text-align: center;
    font-size: 36px;
    margin-bottom: 40px;
    font-weight: 800;
    color: #ff9500;
    position: relative;
    display: inline-block;
    padding-bottom: 10px;
}

.categories h2::after {
    content: '';
    position: absolute;
    width: 60px;
    height: 4px;
    background: #ff9500;
    left: 50%;
    transform: translateX(-50%);
    bottom: 0;
    border-radius: 2px;
    box-shadow: 0 2px 6px rgba(255,149,0,0.4);
}

/* --------------------- GRID --------------------- */
.categories-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

/* --------------------- CATEGORY CARD --------------------- */
.category-card {
    background: linear-gradient(145deg, #fff, #fdf5e6);
    border-radius: 16px;
    padding: 0;
    box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 280px;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.category-card:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* Image */
.category-card img {
    width: 100%;
    height: 75%;
    border-radius: 16px 16px 0 0;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.category-card:hover img {
    transform: scale(1.05);
}

/* Title */
.category-title {
    font-size: 20px;
    font-weight: 700;
    color: #222;
    text-align: center;
    padding: 12px 8px;
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Error Message */
.category-card .error {
    width: 100%;
    height: 160px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8d7da;
    color: #721c24;
    font-weight: 700;
    border-radius: 16px 16px 0 0;
    text-align: center;
}

/* --------------------- RESPONSIVE --------------------- */
@media (max-width: 600px) {
    .categories-grid {
        grid-template-columns: 1fr;
    }
}
</style>
