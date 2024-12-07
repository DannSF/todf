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
</head>

<body>
    <div class="wrap">
        <div class="container-g">

            <div class="title">
                <i class="ri-arrow-left-line arrow-back" id="arrow-back"></i>
                <h2>Register Form</h2>
            </div>
            <div class="content">
                <form id="registerForm" class="register__form">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">First Name</span>
                            <input type="text" id="firstName" placeholder="Enter your first name" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Last Name</span>
                            <input type="text" id="lastName" placeholder="Enter your last name" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Username</span>
                            <input type="text" id="username" placeholder="Enter your username" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Email</span>
                            <input type="text" id="email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Password</span>
                            <input type="password" id="password" placeholder="Enter your password" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Confirm Password</span>
                            <input type="password" id="confirmPassword" placeholder="Confirm your password" required>
                        </div>
                        <div class="input-file">
                            <span class="details">Profile photo</span>
                            <input type="file" id="profilePhoto">
                        </div>
                    </div>

                    <span class="response" id="response"></span>

                    <div class="button">
                        <input class="successBtn" type="submit" value="Sign Up">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../public/register.js"></script>
</body>

</html>