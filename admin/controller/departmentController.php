<?php
session_start();
require_once '../../config/config.php';

class DepartmentController {
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

    public function addDepartment() {
        $dept_name = $_POST['departmentName'];
        $sql = "SELECT * FROM `departments` WHERE `departmentName` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$dept_name]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = 'Error: Department already exists!';
            header("Location: http://localhost/QUEUE-SYS/admin/departments.php");
            exit();
        }

        try {
            // Generate new dept_id
            $sqlMaxID = "SELECT MAX(departmentID) AS max_id FROM `departments`";
            $stmtMaxID = $this->db->prepare($sqlMaxID);
            $stmtMaxID->execute();
            $result = $stmtMaxID->fetch(PDO::FETCH_ASSOC);
            $newDeptID = $result['max_id'] + 1;

            $sqlInsert = "INSERT INTO `departments`(`departmentID`, `departmentName`) 
                          VALUES (?,?)";
            $stmtInsert = $this->db->prepare($sqlInsert);
            $stmtInsert->execute([$newDeptID, $dept_name]);

            $_SESSION['success'] = 'Department successfully added!';
            header("Location: http://localhost/QUEUE-SYS/admin/departments.php");
            exit();
        } catch (Exception $e) {
            echo 'Error inserting department: ' . $e->getMessage();
        }
    }

    public function updateDepartment() {
        $dept_id = $_POST['departmentID'];
        $dept_name = $_POST['departmentName'];

        // Check if department name already exists for another department
        $sql = "SELECT * FROM `departments` WHERE `departmentName` = ? AND `departmentID` != ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$dept_name, $dept_id]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = 'Error: Department name already in use.';
            header("Location: http://localhost/QUEUE-SYS/admin/departments.php");
            exit();
        }

        try {
            $sql = "UPDATE `departments` SET `departmentName`=? WHERE `departmentID`=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$dept_name,  $dept_id]);

            $_SESSION['success'] = 'Department successfully updated!';
            header("Location: http://localhost/QUEUE-SYS/admin/departments.php");
            exit();
        } catch (Exception $e) {
            echo 'Error updating department: ' . $e->getMessage();
        }
    }

    public function deleteDepartment() {
        $dept_id = $_POST['departmentID'];

        try {
            // First, delete all programs under this department
            $sqlDeletePrograms = "DELETE FROM `programs` WHERE `departmentID` = ?";
            $stmtDeletePrograms = $this->db->prepare($sqlDeletePrograms);
            $stmtDeletePrograms->execute([$dept_id]);

            // Then, delete the department itself
            $sqlDeleteDept = "DELETE FROM `departments` WHERE `departmentID` = ?";
            $stmtDeleteDept = $this->db->prepare($sqlDeleteDept);
            $stmtDeleteDept->execute([$dept_id]);

            $_SESSION['success'] = 'Department and its programs successfully deleted!';
            header("Location: http://localhost/QUEUE-SYS/admin/departments.php");
            exit();
        } catch (Exception $e) {
            echo 'Error deleting department: ' . $e->getMessage();
        }
}
}
if (isset($_POST['add'])) {
    $controller = new DepartmentController();
    $controller->addDepartment();
} elseif (isset($_POST['update'])) {
    $controller = new DepartmentController();
    $controller->updateDepartment();
}else if (isset($_POST['delete'])) {
    $controller = new DepartmentController();
    $controller->deleteDepartment();
} else {
    echo "Form submission not detected.";
}
?>