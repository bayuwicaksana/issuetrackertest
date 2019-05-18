<?php
 
class func {
 
    private $dbconn;
 
    // constructor
    function __construct() {
        require_once 'conn.php';
        // connect to db
        $db = new conn();
        $this->dbconn = $db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }

	// create new  issue
    public function createNewIssue($summary, $description, $priority, $assignee, $symptoms) {
        $stmt = $this->dbconn->prepare("INSERT INTO tblIssue(summary, description, priority, status, assignee, symptoms, creationDate, modifyDate) VALUES(?, ?, ?, 1, ?, ?, now(), now())");

        $stmt->bind_param("sssss", $summary, $description, $priority, $assignee, $symptoms);

        $result = $stmt->execute();

        $stmt->close();
 
        if ($result) {
            return true; //success
        } else {
            return false; //failed
        }
    }
 
	// get list of all issues
    public function getAllIssues() {
 
        $stmt = $this->dbconn->prepare("SELECT issueId, summary, tblPriority.description, tblStatus.description, tblUser.userName, creationDate FROM tblIssue INNER JOIN tblPriority on tblIssue.priority = tblPriority.prioId INNER JOIN tblStatus on tblIssue.status = tblStatus.statusId INNER JOIN tblUser on tblIssue.assignee = tblUser.userId");
 
        if ($stmt->execute()) {
			$issueList = array();
            while ($row = $stmt->get_result()->fetch_assoc()) {
				$issueList[] = $row;
			}
            $stmt->close();
 
            return $issueList; //all issues
        } else {
            return NULL; //no issues yet
        }
    }
 
    // get issue detail
    public function getIssueDetail($issueId) {
        $stmt = $this->dbconn->prepare("SELECT * from tblIssue WHERE issueId = ?");
 
        $stmt->bind_param("s", $issueId);
 
        if ($stmt->execute()) {
            $row = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $row; //issue detail
        } else {
            return NULL; //no issue detail found
        }
    }
 
	// modify existing issue
    public function modifyIssue($issueId, $summary, $description, $priority, $status, $assignee, $symptoms) {
        $stmt = $this->dbconn->prepare("UPDATE tblIssue SET summary = ?, description = ?, priority = ?, status = ?, assignee = ?, symptoms = ?, modifyDate = now() WHERE issueId = ?");

        $stmt->bind_param("sssssss", $summary, $description, $priority, $status, $assignee, $symptoms, $issueId);

        $result = $stmt->execute();

        $stmt->close();
 
        if ($result) {
            return true; //success
        } else {
            return false; //failed
        }
    }
 
	// delete existing issue
    public function deleteIssue($issueId) {
        $stmt = $this->dbconn->prepare("DELETE FROM tblIssue WHERE issueId = ?");

        $stmt->bind_param("s", $issueId);

        $result = $stmt->execute();

        $stmt->close();
 
        if ($result) {
            return true; //success
        } else {
            return false; //failed
        }
    }
 
}
 
?>