<?php
session_start();
require_once '../../config/config.php';

class UserController {
    private $db;

    public function __construct() {
        try {
            $conn = new Connection();
            $this->db = $conn->getConnection();
            if (!$this->db) {
                die('Database connection failed');
            }
        } catch (Exception $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function addUser() {
        $userID = $_SESSION['userID'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user_type = $_POST['user_type'];
        $status = 'Active';

        $sql = "SELECT * FROM `useraccount` WHERE `email` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = 'Error: User already exists! Use a different email.';
            header("Location: http://localhost/QUEUE-SYS/admin/userAccounts.php");
            exit();
        } else {
            try {
                // Generate new userID by incrementing the highest userID in the database
                $sqlMaxID = "SELECT MAX(userID) AS max_id FROM `useraccount`";
                $stmtMaxID = $this->db->prepare($sqlMaxID);
                $stmtMaxID->execute();
                $result = $stmtMaxID->fetch(PDO::FETCH_ASSOC);
                $newUserID = $result['max_id'] + 1;

                // Insert new user into the database
                $sqlinsert = "INSERT INTO `useraccount`(`userID`, `first_name`, `last_name`, `email`, `password`, `user_type`, `status`) 
                            VALUES (?,?,?,?,?,?,?)";
                $statementinsert = $this->db->prepare($sqlinsert);
                $statementinsert->execute([$newUserID, $first_name, $last_name, $email, $password, $user_type, $status]);

                // Set session success message
                $_SESSION['success'] = 'User successfully added!';

                // Redirect to user accounts page
                header("Location: http://localhost/QUEUE-SYS/admin/userAccounts.php");
                exit();
            } catch (Exception $e) {
                echo 'Error inserting user: ' . $e->getMessage();
            }
        }
    }
    public function updateUser() {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    $status = $_POST['status'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $sql = "SELECT * FROM `useraccount` WHERE `email` = ? AND `userID` != ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$email, $user_id]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = 'Error: Email already in use by another user.';
        header("Location: http://localhost/QUEUE-SYS/admin/userAccounts.php");
        exit();
    }

    try {
        if (!empty($password)) {
            if ($password !== $confirm_password) {
                $_SESSION['error'] = 'Error: Passwords do not match.';
                header("Location: http://localhost/QUEUE-SYS/admin/userAccounts.php");
                exit();
            }
            $sql = "UPDATE `useraccount` SET `first_name`=?, `last_name`=?, `email`=?, `user_type`=?, `status`=?, `password`=? WHERE `userID`=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$first_name, $last_name, $email, $user_type, $status, $password, $user_id]);
        } else {
            $sql = "UPDATE `useraccount` SET `first_name`=?, `last_name`=?, `email`=?, `user_type`=?, `status`=? WHERE `userID`=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$first_name, $last_name, $email, $user_type, $status, $user_id]);
        }

        $_SESSION['success'] = 'User successfully updated!';
        header("Location: http://localhost/QUEUE-SYS/admin/userAccounts.php");
        exit();
    } catch (Exception $e) {
        echo 'Error updating user: ' . $e->getMessage();
    }
}


}
if (isset($_POST['add'])) {
    $controller = new UserController();
    $controller->addUser();
} elseif (isset($_POST['update'])) {
    $controller = new UserController();
    $controller->updateUser();
} else {
    echo "Form submission not detected.";
}

// Check if form was submitted and call addUser
if (isset($_POST['add'])) {
    $controller = new UserController();
    $controller->addUser();
} else {
    echo "Form submission not detected.";
}

?>