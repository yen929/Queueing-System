<?php
session_start();
require_once '../../config/config.php';

class ProgramController {
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

    public function addProgram() {
        $program_name = $_POST['programName'];
        $dept_id = $_POST['departmentID'];

        // Check if program already exists in the department
        $sql = "SELECT * FROM `programs` WHERE `programName` = ? AND `departmentID` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$program_name, $dept_id]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = 'Error: Program already exists in this department!';
            header("Location: http://localhost/QUEUE-SYS/admin/departments.php");
            exit();
        }

        try {
            // Generate new program_id
            $sqlMaxID = "SELECT MAX(programID) AS max_id FROM `programs`";
            $stmtMaxID = $this->db->prepare($sqlMaxID);
            $stmtMaxID->execute();
            $result = $stmtMaxID->fetch(PDO::FETCH_ASSOC);
            $newProgramID = $result['max_id'] + 1;

            $sqlInsert = "INSERT INTO `programs`(`programID`, `programName`, `departmentID`) 
                          VALUES (?, ?, ?)";
            $stmtInsert = $this->db->prepare($sqlInsert);
            $stmtInsert->execute([$newProgramID, $program_name, $dept_id]);

            $_SESSION['success'] = 'Program successfully added!';
            header("Location: http://localhost/QUEUE-SYS/admin/departments.php");
            exit();
        } catch (Exception $e) {
            echo 'Error inserting program: ' . $e->getMessage();
        }
    }

    public function updateProgram() {
        $program_id = $_POST['programID'];
        $program_name = $_POST['programName'];
        $dept_id = $_POST['departmentID'];
        $dept_name = $_POST['departmentName'];

        // Check if program name already exists for another program in the same department
        $sql = "SELECT * FROM `programs` WHERE `programName` = ? AND `departmentID` = ? AND `programID` != ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$program_name, $dept_id, $program_id]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = 'Error: Program name already in use.';
            header("Location: http://localhost/QUEUE-SYS/admin/departments.php");
            exit();
        }

        try {
            $sql = "UPDATE `programs` SET `programName`=? WHERE `programID`=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$program_name,  $program_id]);

            $_SESSION['success'] = 'Program successfully updated!';
            header("Location: http://localhost/QUEUE-SYS/admin/departments.php");
            exit();
        } catch (Exception $e) {
            echo 'Error updating program: ' . $e->getMessage();
        }
    }
    public function deleteProgram() {
        $program_id = $_POST['programID'];

        try {
            $sql = "DELETE FROM `programs` WHERE `programID`=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$program_id]);

            $_SESSION['success'] = 'Program successfully deleted!';
            header("Location: http://localhost/QUEUE-SYS/admin/departments.php");
            exit();
        } catch (Exception $e) {
            echo 'Error deleting program: ' . $e->getMessage();
        }
}}

if (isset($_POST['add'])) {
    $controller = new ProgramController();
    $controller->addProgram();
} elseif (isset($_POST['update'])) {
    $controller = new ProgramController();
    $controller->updateProgram();
}elseif (isset($_POST['delete'])) {
    $controller = new ProgramController();
    $controller->deleteProgram();
 }else {
    echo "Form submission not detected.";
}
?>