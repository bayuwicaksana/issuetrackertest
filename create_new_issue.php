<?php
require_once 'inc/func.php';
$db = new func();
 
// json response array
$response = array("error" => FALSE);
 
if ( isset($_POST['summary']) && isset($_POST['description']) && isset($_POST['priority']) && isset($_POST['assignee']) && isset($_POST['symptoms']) ) {
 
    // save all necesary params on local variable
    $summary = $_POST['summary'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $assignee = $_POST['assignee'];
    $symptoms = $_POST['symptoms'];
 
    // create new issue 
    $data = $db->createNewIssue($summary, $description, $priority, $assignee, $symptoms);
 
    if ($data) {
        // success
        $response["error"] = FALSE;
        $response["error_msg"] = "Issue successfully created";
        echo json_encode($response);
    } else {
        // failed
        $response["error"] = TRUE;
        $response["error_msg"] = "Can not create new issue";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Missing params";
    echo json_encode($response);
}
?>