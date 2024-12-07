<?php include('../config/check_session.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $subcategoryID = $_GET['subcategoryID'] ?? '';
    $name = $_GET['subcategoryName'] ?? 'asd';
}

?>

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
                        <h2><?php echo $username; ?></h2>
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
        <div class="forum__container container">
            <div class="sidebar">
                <h2>Navegation</h2>
                <div id="forum-data"></div>
            </div>
            <div class="forum__category">
                <div class="category__title" style="display: flex; align-items: center; justify-content: space-between;">
                    <h2 id="category-title"><?php echo $name ?></h2>
                    <button style="padding:0.5rem 1rem; border-radius: 0.6rem; color: var(--first-color); background-color: var(--container-forum); cursor: pointer;"><i class="ri-add-line"></i></button>
                </div>
                <div class="category__body">
                    <div class="subcategory">
                        <div class="body__subcategory">
                            <h3 id="subcategory-question">Question 1</h3>
                        </div>
                        <div class="body__description">
                            <p id="subcategory-description">Question Details (Date)</p>
                        </div>
                        <button style="padding:0.5rem 1rem; border-radius: 0.6rem; color: #fff; background-color: var(--first-color); cursor: pointer;">
                            <i class="ri-pencil-line"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </main>

    <footer>
        <p>Copyright © 2024 Digital Aus Solutions Pty Ltd. All rights reserved. | Privacy Policy</p>
    </footer>

    <script src="../public/main.js"></script>
    <script>
        getQuestionsBySubcategory();
        loadForumData();
        const forumDataContainer = document.getElementById("forum-data");

        const apiData = [{}];

        function loadForumData() {
            fetch('http://localhost/Projects/TODF/index.php?action=getForumData')
                .then(response => response.json())
                .then(data => {
                    renderCategories(data);

                })
                .catch(error => console.error('Error loading forum data:', error));
        }

        function renderCategories(data) {
            const forumDataContainer = document.getElementById("forum-data");
            for (const category in data) {
                const categoryDiv = document.createElement("div");
                categoryDiv.classList.add("category");

                const categoryTitle = document.createElement("div");
                categoryTitle.classList.add("category-title");
                categoryTitle.textContent = category;

                const toggleIcon = document.createElement("span");
                toggleIcon.textContent = "+";
                toggleIcon.classList.add("toggle-icon");
                categoryTitle.appendChild(toggleIcon);

                const subcategoriesList = document.createElement("ul");
                subcategoriesList.classList.add("subcategories");
                subcategoriesList.style.display = "none";

                data[category].forEach(subcategory => {
                    const subcategoryItem = document.createElement("li");
                    subcategoryItem.classList.add("subcategory-item");

                    const subcategoryLink = document.createElement("a");
                    subcategoryLink.href = `http://localhost/Projects/TODF/views/forum.php?subcategoryID=${subcategory.subategoryID}&subcategoryName=${subcategory.categoryName}`;
                    subcategoryLink.textContent = subcategory.categoryName;

                    subcategoryItem.appendChild(subcategoryLink);
                    subcategoriesList.appendChild(subcategoryItem);
                });

                categoryTitle.addEventListener("click", () => {
                    const isVisible = subcategoriesList.style.display === "block";
                    subcategoriesList.style.display = isVisible ? "none" : "block";
                    toggleIcon.textContent = isVisible ? "+" : "-";
                });

                categoryDiv.appendChild(categoryTitle);
                categoryDiv.appendChild(subcategoriesList);

                forumDataContainer.appendChild(categoryDiv);
            }
        }



        function getQuestionsBySubcategory() {
            const formData = new FormData();
            formData.append('SubcategoryID', <?php echo $_GET['subcategoryID'] ?>);
            fetch('http://localhost/Projects/TODF/index.php?action=getQuestionsBySubcategory', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    renderQuestions(data);

                })
                .catch(error => console.error('Error loading data:', error));
        }

        function renderQuestions(data) {
            const categoryBody = document.querySelector(".category__body");

            categoryBody.innerHTML = "";

            data.forEach((item) => {
                const subcategoryDiv = document.createElement("div");
                subcategoryDiv.classList.add("subcategory");

                const questionDiv = document.createElement("div");
                questionDiv.classList.add("body__subcategory");

                const questionTitle = document.createElement("h3");
                questionTitle.textContent = item.question;
                questionDiv.appendChild(questionTitle);

                const descriptionDiv = document.createElement("div");
                descriptionDiv.classList.add("body__description");

                const descriptionLink = document.createElement("a");
                descriptionLink.href = `/question/${item.id}`;
                descriptionLink.textContent = `${item.details} (${item.date})`;
                descriptionDiv.appendChild(descriptionLink);

                const actionButton = document.createElement("button");
                actionButton.style = "padding:0.5rem 1rem; border-radius: 0.6rem; color: #fff; background-color: var(--first-color); cursor: pointer;";
                actionButton.innerHTML = '<i class="ri-pencil-line"></i>';

                subcategoryDiv.appendChild(questionDiv);
                subcategoryDiv.appendChild(descriptionDiv);
                subcategoryDiv.appendChild(actionButton);

                categoryBody.appendChild(subcategoryDiv);

                const separator = document.createElement("hr");
                categoryBody.appendChild(separator);
            });
        }
    </script>



</body>

</html>