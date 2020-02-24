<?php
/*
 * Author: Srinivasan
 * Created Date: Feb 23 2020
 * Tasks
 */
namespace GluMobile;
include 'DBConnection.php';

class Tasks {
    private $db;

    function __construct ()
    {
        $this->db = new DBConnection();
    }

    private function _json_output($data) {
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($data);
    }

    /*
    * Get task information
    * int $id task id
    * return json response
    */
    public function getTask(int $id) {
        $query = "SELECT * from jobs WHERE jobId=" . $id;
        $result = $this->db->query($query);

        $output = array();
        if ($result->num_rows > 0) {
            // Output into array
            while($row = $result->fetch_assoc()) {
                $output = $row;
            }
        } else {
            $output = [];
        }
        $this->_json_output($output);
        unset($output);
        $this->db->close();
    }

    /*
    * Get next task information
    * return json response
    */
    public function getNextTask() {
        $query = "SELECT * from jobs WHERE status = 1";
        $result = $this->db->query($query);

        $output = array();
        if ($result->num_rows > 0) {
            // Output into array
            while($row = $result->fetch_assoc()) {
                $output = $row;
            }
        } else {
            $output = [];
        }
        $this->_json_output($output);
        unset($output);
        $this->db->close();
    }

    /*
    * Update task information
    * int $id task id
    * return json response
    */
    public function updateTask(int $id) {
        // Process will update the task with status as "Finished - 3 or Failed - 4"
    }

    /*
    * Add task information
    * return json response
    */
    public function addTask() {
        $postVariables = $_POST;
        // Validate the required post inputs
        
        $query = "INSERT INTO jobs (submitterId, command, status)
            VALUES ('".$postVariables['submitterId']."', '".$postVariables['command']."', 1)";
        // We can use prepare statements to prevent SQL injection
        $result = $this->db->query($query);

        if ($result > 0) {
            $output = ["status"=>"success","message"=>"Task added successfully"];
            $this->_json_output($output);
        } else {
            $output = ["status"=>"failed","message"=>"Task not added"];
            $this->_json_output($output);
        }
        unset($output);
        $this->db->close();
    }

    /*
    * Start task
    * int $id task id
    * return json response
    */
    public function startTask(int $id) {
        $postVariables = $_POST;
        // Validate the required post inputs
        
        $query = "UPDATE jobs SET processorId = ".$postVariables['processorId'].", status = 2 WHERE jobId=" . $id . " AND status = 1";
        // We can use prepare statements to prevent SQL injection
        $result = $this->db->query($query);

        if (mysqli_affected_rows($this->db) > 0) {
            $output = ["status"=>"success","message"=>"Task updated successfully"];
            $this->_json_output($output);
        } else {
            $output = ["status"=>"failed","message"=>"Task is not updated"];
            $this->_json_output($output);
        }
        unset($output);
        $this->db->close();
    }
}
?>