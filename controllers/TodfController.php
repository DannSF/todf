<?php
require_once "models/TodfModel.php";

class TodfController
{
    private $model;

    public function __construct()
    {
        $this->model = new TodfModel();
    }

    public function showHome()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        require_once "views/home.php";
    }

    public function getForumData()
    {
        $forumData = $this->model->getForum();

        header('Content-Type: application/json');

        echo $forumData;
    }

    public function getCategories()
    {
        $forumData = $this->model->getCategories();
        echo $forumData;
    }

    public function getSubcategoriesByCategory()
    {
        $categoryId = $_POST['categoryId'];
        $forumData = $this->model->getSubcategoriesByCategory($categoryId);
        echo $forumData;
    }

    public function registerUser()
    {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($password !== $confirmPassword) {
            $response = [
                'status' => 'error',
                'message' => 'Passwords does not match.'
            ];
            echo json_encode($response);
            return;
        }

        if ($this->model->registerMember($firstName, $lastName, $username, $email, $password, "default.jpg")) {
            $response = [
                'status' => 'success',
                'message' => 'Now you are a member.'
            ];
        }

        echo json_encode($response);
    }

    public function loginUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $result = $this->model->validateLogin($username, $password);

            if ($result) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['USERNAME'] = $result->username;
                $_SESSION['MEMBER_ID'] = $result->memberID;
                $_SESSION['MEMBER_EMAIL'] = $result->email;
                $_SESSION['MEMBER_IMAGE'] = $result->memberImage;

                echo json_encode(['success' => true, 'message' => 'Login successful!', 'data' => $result]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }

    public function logOut()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $memberID = 27;
            $MemberImageFilename = "defaul.jpg";

            $result = $this->model->updateMember($memberID, $firstName, $lastName, $email, $MemberImageFilename);

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Update Succesfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Something went wrong.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }

    public function getMemberById()
    {
        $memberID = $_POST['memberID'];
        $forumData = $this->model->getMemberById($memberID);
        echo $forumData;
    }

    public function updateMemberPassword()
    {
        $memberID = $_POST['memberID'];
        $newPassword = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];


        if ($confirmPassword != $newPassword) {
            $response = [
                'status' => 'error',
                'message' => 'Passwords does not match.'
            ];
            echo json_encode($response);
            return;
        }

        $hashedPassword = md5($newPassword);
        $this->model->updatePassword($memberID, $hashedPassword);
        echo json_encode([
            'status' => 'success',
            'message' => 'Password Updated'
        ]);;
    }

    public function getQuestionsBySubcategory()
    {
        $SubcategoryID = $_POST['SubcategoryID'];
        $forumData = $this->model->getQuestionsBySubcategory($SubcategoryID);
        echo $forumData;
    }
}
