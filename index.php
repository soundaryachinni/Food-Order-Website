<?php
include('partials-front/menu.php');
?>

<!--========== HEADER ==========-->
<header class="l-header" id="header">
        <nav class="nav bd-container">
            <a href="#" class="nav__logo">
            <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
            </a>

            <div class="nav__menu " id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="<?php echo SITEURL;?>" class="nav__link active-link">Home</a></li>
                    <li class="nav__item"><a href="<?php echo SITEURL; ?>categories.php" class="nav__link">Categories</a></li>
                    <li class="nav__item"><a href="<?php echo SITEURL;?>foods.php" class="nav__link">Foods</a></li>
    
                    <li class="nav__item"><a href="<?php echo SITEURL;?>contact.php" class="nav__link">Contact us</a></li>

                    <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-menu'></i>
            </div>
            
        </nav>
    </header>

    <!-- fOOD SEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container ">
            
            <form action="<?php  echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD SEARCH Section Ends Here -->

    <?php
    if (isset($_SESSION['order']))
     {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }

     ?>


    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container ">
            <h2 class="text-center">Explore Foods</h2>


                   <?php
                            //create php code to display categories from database

                            //create aql to get all active categories  from database

                            $sql =  "SELECT * FROM tbl_category WHERE active='Yes'AND featured='Yes' LIMIT 3 ";

                            //executing query


                            $res = mysqli_query($conn,$sql);

                            //count rows to check whether we have categories or not

                            $count = mysqli_num_rows($res);

                            //if count is greater than zero,we have categories else we do not have category

                            if ($count>0) 
                            {
                                // we have categories

                                while($row=mysqli_fetch_assoc($res))
                                {

                                    //get the details of categories
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $image_name= $row ['image_name'];
                                    ?>
                                    <a href="<?php echo SITEURL;?>category-food.php?category_id=<?php echo $id;?>">
                                    <div class="box-3 float-container">
                            <?php 
                            //check image available or mot
                            if ($image_name=="")
                             {
                                // display mesaage
                                echo "<div class'error'>Image not availabele. </div>";
                            }
                            else
                            
                                //image available
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                                    <?php
                                }
                            

                            ?>

                         
                  <h3 class="float-text text-white"><?php echo $title;?></h3>
            </div>
            </a>

                                    <?php                              }

                            }

                            else
                            {
                                
                                //we dont have categories
                                echo "<div class='error'>Category Not Added. </div>";

                                }

                         ?>
         

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            //getting ffod from that are active and fetured

            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //execute the quey

            $res2 = mysqli_query($conn,$sql2);

            //count rows
            $count2 = mysqli_num_rows($res2);

            //check food available or not

            if ($count2>0) 
            {
                // Food available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get all the values

                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="food-menu-box">
                       <div class="food-menu-img">
                        <?php 

                        //check image available or not
                        if ($image_name=="") 
                        {
                             // image not available
                            echo "<div class='error'>Image not available. </div>";
                         }
                         else
                         {
                            //image available
                            ?>
                            <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">


                            <?Php 
                         } 


                        ?>
                        
                </div>

                  <div class="food-menu-desc">
                    <h4><?php  echo " $title";?></h4>
                    <p class="food-price">$<?php echo$price;  ?></p>
                    <p class="food-detail">
                        <?php echo $description;?>
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
                echo "<div class='error'>Food not available </div>";
            }



             ?>

            

           
            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->



    <section class="contact" id="contact">
        <div class="title">
            <h2 class="titletext"><span>C</span>ontact Us</h2>
            <p class="contact__description">If you want to reserve a table in our restaurant, contact us with 24/7 chat service. </p>

        </div>
        <div class="contactform">
            <h3>Send Message</h3>
            <div class="inputbox">
                <input type="text" placeholder="Name">
            </div>
            <div class="inputbox">
                <input type="text" placeholder="Email">
            </div>
            <div class="inputbox">
                <textarea name="" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="inputbox">
                <input type="submit" value="Send">
            </div>
        </div>


    </section>
    

   <?php include('partials-front/footer.php'); ?>

   

   