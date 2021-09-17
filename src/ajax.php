<?php
require_once ("config.php");
require_once ("services/UserService.php");

$userService = new UserService();
$resp = array("message" => "unrecognised action", "code" => 400, "data" => "");

switch($_POST['action']) {
    case 'validate_name':
            $name = $_POST['name'];
            if($userService->isNameTaken($name)) {
                $resp['data'] = true;
                $resp['code'] = 400;
                $resp['message'] = 'Name is taken. Sorry!';
                http_response_code(400);
            } else {
                $resp['data'] = false;
                $resp['code'] = 200;
                $resp['message'] = 'Name is available';
            }
        break;

    case 'submit_name':
        $name = $_POST['name'];
        if($userService->saveName($name)) {
            $resp['message'] = 'Name has saves successfully';
            $resp['code'] = 200;
        } else {
            $resp['message'] = 'Unable to save name. Try again later.';
            $resp['code'] = 500;
            http_response_code(500);
        }

        break;

    default:
        http_response_code(400);
}


echo json_encode($resp);