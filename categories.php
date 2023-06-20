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
                    <li class="nav__item"><a href="<?php echo SITEURL;?>" class="nav__link ">Home</a></li>
                    <li class="nav__item"><a href="<?php echo SITEURL; ?>categories.php" class="nav__link active-link">Categories</a></li>
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
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container ">
            <h2 class="text-center">Explore Foods</h2>

            <?php

              //display all the categories that are active
            $sql ="SELECT * FROM tbl_category WHERE active='Yes'";

            //execute the query
            $res = mysqli_query($conn,$sql);

            //count rows
            $count = mysqli_num_rows($res);

            //check whether categories available or not

            if ($count>0) 
            {
                // category is  availble
                while ($row=mysqli_fetch_assoc($res))
                 {
                    // get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];

                    ?>
                     <a href="<?php echo SITEURL;?>category-food.php?category_id=<?php echo $id;?>">
                      <div class="box-3 float-container">


                        <?php
                        if ($image_name=="") 
                        {
                             // image not available
                            echo "<div class='error'>Image not found </div>";
                         }
                         else
                         {
                            //image available
                            
                            ?>

                            <img src="<?php  echo SITEURL;?>images/category/<?php  echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">

                            <?php 
             

                         } 


                        ?>
                          
                          <h3 class="float-text text-white"><?php echo $title;?></h3>
                    </div>
                  </a>
            


                    <?php
                }

            }

            else
            {
                    // category is not availble
                echo "<div class='error'>Categories not found </div>";
             
            }
            ?>

            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?>