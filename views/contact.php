<?php include('../config//check_session.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODF</title>
    <link rel="stylesheet" href="../public/style.css">
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css"
        rel="stylesheet" />

    <script>
        let isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
        const username = <?php echo json_encode($username); ?>;
        const memberID = <?php echo json_encode($memberID); ?>;
        const memberImage = <?php echo json_encode($memberImage); ?>;
    </script>
</head>

<body>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="../index.php" class="nav__logo">TODF</a>
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item" id="my-questions">
                        <a href="myQuestion.php" class="nav__link">My Questions</a>
                    </li>
                    <li class="nav__item" id="my-answers">
                        <a href="myAnswers.php" class="nav__link">Mi Answers</a>
                    </li>
                    <li class="nav__item">
                        <a href="forum.php?subcategoryID=1&subcategoryName=Windows" class="nav__link">Forum</a>
                    </li>
                    <li class="nav__item">
                        <a href="contact.php" class="nav__link">Contact Us</a>
                    </li>
                </ul>



                <div class="nav__close" id="nav-close">
                    <i class="ri-close-line"></i>
                </div>
            </div>

            <div class="nav__actions">
                <i class="ri-search-line nav__search" id="search-btn"></i>
                <i class="ri-user-line nav__login" id="login-btn"></i>
                <div class="loged-in" id="user-pic">
                    <img src="../public/images/default-user.jpg" alt="user-pic" class="user__pic" onclick="toggleSubMenu()">
                </div>
                <div class="nav__toggle" id="nav-toggle">
                    <i class="ri-menu-line"></i>
                </div>
            </div>
            <div class="sub-menu__wrap" id="sub-menu">
                <div class="sub__menu">
                    <div class="user__info">
                        <img src="../public/images/default-user.jpg" alt="user-pic">
                        <h2><?php echo $username ?></h2>
                    </div>
                    <hr>
                    <a href="editProfile.php" class="sub-menu__link">
                        <i class="ri-settings-2-line sub-menu__icon"></i>
                        <p>Edit profile</p>
                        <span>></span>
                    </a>
                    <a href="editPassword.php" class="sub-menu__link">
                        <i class="ri-lock-line sub-menu__icon"></i>
                        <p>Change password</p>
                        <span>></span>
                    </a>
                    <a href="http://localhost/Projects/TODF/index.php?action=logOut" class="sub-menu__link">
                        <i class="ri-login-box-line sub-menu__icon"></i>
                        <p>Log Out</p>
                        <span>></span>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <div class="search" id="search">
        <form action="" class="search__form">
            <i class="ri-search-line search__icon"></i>
            <input type="search" placeholder="What are you looking for?" class="search__input">
        </form>
        <i class="ri-close-line search__close" id="search-close"></i>
    </div>

    <div class="login" id="login">
        <form id="loginForm" class="login__form">
            <h2 class="login__title">Log In</h2>
            <div class="login__group">
                <div>
                    <label for="username" class="login__label">Username</label>
                    <input type="text" id="username" placeholder="Write your username" class="login__input">
                </div>
                <div>
                    <label for="password" class="login__label">Password</label>
                    <input type="password" id="password" placeholder="Write your password" id="password" class="login__input">
                </div>
                <span class="response" id="response"></span>
            </div>

            <div>
                <p class="login__signup">
                    You do not have an account? <a href="views/register.php">Sign Up</a>
                </p>
                <a href="#" class="login__forgot">
                    Forgot your password?
                </a>
                <button type="submit" class="login__button">Log In</button>
            </div>
        </form>
        <i class="ri-close-line login__close" id="login-close"></i>
    </div>
    <main>
        <div class="container">
            <div class="banner">
                <h2>Contact Us</h2>
                <p>We are here to assist you 24/7!</p>
                <img src="../public/images/contact.jpg" alt="Contact Banner">
            </div>

            <div class="contact__content">
                <h3>Enquiry form</h3>
                <form class="contact__form" action="#">
                    <div class="contact__details">
                        <div class="input-box">
                            <span class="details">Full Name</span>
                            <input type="text" placeholder="Enter your full name" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Email</span>
                            <input type="text" placeholder="Enter your email" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Message</span>
                            <textarea type="text" placeholder="Leave your message" required> </textarea>
                        </div>
                    </div>

                    <div class="button">
                        <input class="successBtn" type="submit" value="Submit">
                    </div>
                </form>
            </div>

        </div>
    </main>

    <footer>
        <p>Copyright © 2024 Digital Aus Solutions Pty Ltd. All rights reserved. | Privacy Policy</p>
    </footer>
    <script src="../public/main.js"></script>
</body>

</html>