<?php
require_once 'inc/func.php';
$db = new func();
 
// json response array
$response = array("error" => FALSE);
 
    // get all issues 
    $data = $db->getAllIssues();
 
    if ($data != false) {
        // success
        $response["error"] = FALSE;
        $response["error_msg"] = "All issues successfully retrieved";
		$response["data"] = $data;
        echo json_encode($response);
    } else {
        // failed
        $response["error"] = TRUE;
        $response["error_msg"] = "Can not retrieve all issues";
        echo json_encode($response);
    }
?>