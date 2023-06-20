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
                    <li class="nav__item"><a href="<?php echo SITEURL; ?>categories.php" class="nav__link">Categories</a></li>
                    <li class="nav__item"><a href="<?php echo SITEURL;?>foods.php" class="nav__link">Foods</a></li>
    
                    <li class="nav__item"><a href="<?php echo SITEURL;?>contact.php" class="nav__link active-link">Contact us</a></li>

                    <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
                </ul>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class='bx bx-menu'></i>
            </div>
            
        </nav>
    </header>


    



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