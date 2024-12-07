<?php
require_once "config/Database.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class TodfModel
{
    private $conn;

    public function __construct()
    {

        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getForum()
    {
        try {
            $sql = "SELECT 
            c.CategoryName AS category,
            s.SubcategoryID AS subategoryID,
            s.SubcategoryName AS categoryName
        FROM CATEGORY c
        JOIN SUBCATEGORY s ON c.CategoryID = s.CategoryID
        ORDER BY c.CategoryName, s.SubcategoryID;";

            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {

                $categories = [];
                while ($row = $result->fetch_assoc()) {
                    $category = $row['category'];
                    $subCategory = [
                        'subategoryID' => $row['subategoryID'],
                        'categoryName' => $row['categoryName']
                    ];

                    if (!isset($categories[$category])) {
                        $categories[$category] = [];
                    }

                    $categories[$category][] = $subCategory;
                }

                return json_encode($categories);
            } else {
                return json_encode([]);
            }
        } catch (PDOException $e) {
            error_log("Error en getForum: " . $e->getMessage());
            return [];
        }
    }

    public function registerMember($firstName, $lastName, $username, $email, $password, $MemberImageFilename)
    {
        try {
            $hashedPassword = md5($password);

            $stmt = $this->conn->prepare("INSERT INTO MEMBER (LastName, FirstName, EmailAddress, Username, Password, MemberImageFilename)
            VALUES (?, ?, ?, ?, ?, ?)");

            if (!$stmt->bind_param("ssssss", $lastName, $firstName, $email, $username, $hashedPassword, $MemberImageFilename)) {
                throw new Exception("Error binding parameters: " . $stmt->error);
            }

            if (!$stmt->execute()) {
                throw new Exception("Error executing the query: " . $stmt->error);
            }

            $stmt->close();

            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo "An error occurred: " . $e->getMessage();
            return false;
        }
    }

    public function validateLogin($username, $password)
    {
        try {
            $stmt = $this->conn->prepare("
            SELECT MemberID, 
            FirstName, 
            LastName, 
            EmailAddress, 
            Username, 
            MemberImageFilename, 
            Password                                           
            FROM MEMBER                                           
            WHERE Username = ?
            ");

            if (!$stmt->bind_param("s", $username)) {
                throw new Exception("Error binding parameters: " . $stmt->error);
            }

            if (!$stmt->execute()) {
                throw new Exception("Error executing the query: " . $stmt->error);
            }

            $stmt->bind_result($memberID, $firstName, $lastName, $email, $dbUsername, $memberImage, $hashedPassword);

            if ($stmt->fetch()) {
                if (md5($password) === $hashedPassword) {
                    $user = new stdClass();
                    $user->memberID = $memberID;
                    $user->firstName = $firstName;
                    $user->lastName = $lastName;
                    $user->email = $email;
                    $user->username = $dbUsername;
                    $user->memberImage = $memberImage;

                    $stmt->close();
                    return $user;
                } else {
                    $stmt->close();
                    return null;
                }
            } else {
                $stmt->close();
                return null;
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function updateMember($memberId, $firstName, $lastName, $email, $MemberImageFilename)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE MEMBER SET FirstName = ?, LastName = ?, EmailAddress = ?, MemberImageFilename = ? WHERE MemberID = ?");

            if (!$stmt->bind_param("sssss", $firstName, $lastName, $email, $MemberImageFilename, $memberId)) {
                throw new Exception("Error binding parameters: " . $stmt->error);
            }

            if (!$stmt->execute()) {
                throw new Exception("Error executing the query: " . $stmt->error);
            }

            $stmt->close();

            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo "An error occurred: " . $e->getMessage();
            return false;
        }
    }

    public function getCategories()
    {
        try {
            $sql = "SELECT * FROM CATEGORY;";

            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                $forumData = array();

                while ($row = $result->fetch_assoc()) {
                    $forumData[] = array(
                        'id' => $row['CategoryID'],
                        'category' => $row['CategoryName'],
                    );
                }

                return json_encode($forumData);
            } else {
                return json_encode([]);
            }
        } catch (PDOException $e) {
            error_log("Error en getCategories: " . $e->getMessage());
            return [];
        }
    }

    public function getSubcategoriesByCategory($categoryId)
    {
        try {
            $sql = "SELECT * FROM SUBCATEGORY WHERE CategoryID = " . $categoryId . ";";

            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                $forumData = array();

                while ($row = $result->fetch_assoc()) {
                    $forumData[] = array(
                        'id' => $row['SubcategoryID'],
                        'subcategory' => $row['SubcategoryName'],
                    );
                }

                return json_encode($forumData);
            } else {
                return json_encode([]);
            }
        } catch (PDOException $e) {
            error_log("Error en getCategories: " . $e->getMessage());
            return [];
        }
    }

    public function getQuestionsByMember($memberId)
    {
        try {
            $sql = "";

            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                $forumData = array();

                while ($row = $result->fetch_assoc()) {
                    $forumData[] = array(
                        'category' => $row['SubcategoryID'],
                        'subcategory' => $row['SubcategoryName'],
                        'question',

                    );
                }

                return json_encode($forumData);
            } else {
                return json_encode([]);
            }
        } catch (PDOException $e) {
            error_log("Error en getCategories: " . $e->getMessage());
            return [];
        }
    }

    public function getMemberById($memberId)
    {
        try {
            $sql = "SELECT * FROM MEMBER WHERE MemberId = " . $memberId . ";";

            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                $forumData = array();

                while ($row = $result->fetch_assoc()) {
                    $forumData[] = array(
                        'id' => $row['MemberID'],
                        'lastname' => $row['LastName'],
                        'firstname' => $row['FirstName'],
                        'email' => $row['EmailAddress'],
                        'username' => $row['Username'],
                        'password' => $row['Password'],
                        'photo' => $row['MemberImageFilename']
                    );
                }

                return json_encode($forumData);
            } else {
                return json_encode([]);
            }
        } catch (PDOException $e) {
            error_log("Error en getCategories: " . $e->getMessage());
            return [];
        }
    }

    public function updatePassword($memberID, $password)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE MEMBER SET Password = ? WHERE MemberID = ?");

            if (!$stmt->bind_param("ss", $password, $memberID)) {
                throw new Exception("Error binding parameters: " . $stmt->error);
            }

            if (!$stmt->execute()) {
                throw new Exception("Error executing the query: " . $stmt->error);
            }

            $stmt->close();

            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo "An error occurred: " . $e->getMessage();
            return false;
        }
    }

    public function getQuestionsBySubcategory($SubcategoryID)
    {
        try {
            $sql = "SELECT * FROM QUESTION WHERE SubcategoryID = " . $SubcategoryID . ";";

            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                $forumData = array();

                while ($row = $result->fetch_assoc()) {
                    $forumData[] = array(
                        'id' => $row['QuestionID'],
                        'question' => $row['Question'],
                        'details' => $row['QuestionDetails'],
                        'date' => $row['QuestionCreationDate']
                    );
                }

                return json_encode($forumData);
            } else {
                return json_encode([]);
            }
        } catch (PDOException $e) {
            error_log("Error en getCategories: " . $e->getMessage());
            return [];
        }
    }
}
