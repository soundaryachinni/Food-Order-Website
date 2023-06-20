<?php include('partials-front/menu.php'); ?>


<!--========== HEADER ==========-->
<header class="l-header" id="header">
        <nav class="nav bd-container">
            <a href="#" class="nav__logo">
            <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
            </a>

            <div class="nav__menu " id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="<?php echo SITEURL;?>" class="nav__link ">Home</a></li>
                    <li class="nav__item"><a href="<?php echo SITEURL; ?>categories.php" class="nav__link">Categories</a></li>
                    <li class="nav__item"><a href="<?php echo SITEURL;?>foods.php" class="nav__link active-link">Foods</a></li>
    
                    <li class="nav__item"><a href="<?php echo SITEURL;?>contact.php" class="nav__link">Contact us</a></li>

                    <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-menu'></i>
            </div>
            
        </nav>
    </header>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php  echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD SEARCH Section Ends Here -->



    <!-- fOOD Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php
            //display food that are active
            $sql = " SELECT * FROM tbl_food WHERE active='Yes'";

            //execute the query

            $res = mysqli_query($conn,$sql);

            //count rows
            $count = mysqli_num_rows($res);

            //check food available
            if ($count>0) 
            {
                // food available
                while ($row=mysqli_fetch_assoc($res))
                 {
                    // get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row ['price'];
                    $image_name = $row ['image_name'];
                    ?>

                      <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                //check image available or not
                                if ($image_name=="") 
                                {
                                     // image not available
                                    echo "<div class='error'>Image not available </div>";
                                 } 

                                 else
                                 {
                                    //image available
                                    ?>
                                     <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                    <?php 

                                 }
                                ?>
                              
                      </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price">$<?php echo $price; ?></p>
                    <p class="food-detail">
                       <?php  echo $description;?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>


                    <?php
                }
            }
            else
            {
                //food not available
                echo "<div class='error'>Food not available.</div>";
            }



             ?>

          

            
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>