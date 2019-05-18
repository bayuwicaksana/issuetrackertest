<?php
require_once 'inc/func.php';
$db = new func();
 
// json response array
$response = array("error" => FALSE);
 
if ( isset($_POST['issueId']) && isset($_POST['summary']) && isset($_POST['description']) && isset($_POST['priority']) && isset($_POST['status']) && isset($_POST['assignee']) && isset($_POST['symptoms']) ) {
 
    // save all necesary params on local variable
    $issueId = $_POST['issueId'];
    $summary = $_POST['summary'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];
    $assignee = $_POST['assignee'];
    $symptoms = $_POST['symptoms'];
 
    // update exisiting issue 
    $data = $db->modifyIssue($issueId, $summary, $description, $priority, $status, $assignee, $symptoms);
 
    if ($data) {
        // success
        $response["error"] = FALSE;
        $response["error_msg"] = "Issue successfully updated";
        echo json_encode($response);
    } else {
        // failed
        $response["error"] = TRUE;
        $response["error_msg"] = "Can not update the issue";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Missing params";
    echo json_encode($response);
}
?>