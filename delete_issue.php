<?php
require_once 'inc/func.php';
$db = new func();
 
// json response array
$response = array("error" => FALSE);
 
if ( isset($_POST['issueId']) ) {
 
    // save all necesary params on local variable
    $issueId = $_POST['issueId'];
 
    // delete existing issue 
    $data = $db->deleteIssue($issueId);
 
    if ($data) {
        // success
        $response["error"] = FALSE;
        $response["error_msg"] = "Issue successfully deleted";
        echo json_encode($response);
    } else {
        // failed
        $response["error"] = TRUE;
        $response["error_msg"] = "Can not delete issue";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Missing params";
    echo json_encode($response);
}
?>