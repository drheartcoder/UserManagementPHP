<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'db.php';
include_once 'UserController.php';

$database = new Database();
$db = $database->getConnection();
$userController = new UserController($db);

$request_method = $_SERVER["REQUEST_METHOD"];
switch($request_method){
    case 'GET':
        if(!empty($_GET["id"])){
            $id = intval($_GET["id"]);
            $response = $userController->getUser($id);
            echo json_encode($response);
        }
        else{
            $response = $userController->getUsers();
            $users_arr = array();
            while ($row = $response->fetch(PDO::FETCH_ASSOC)){
                $users_arr[] = $row;
            }
            echo json_encode($users_arr);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if($userController->createUser($data)){
            echo json_encode(array("message" => "User was created."));
        }
        else{
            echo json_encode(array("message" => "Unable to create user."));
        }
        break;

    case 'PUT':
        $id = intval($_GET["id"]);
        $data = json_decode(file_get_contents("php://input"), true);
        if($userController->updateUser($id, $data)){
            echo json_encode(array("message" => "User was updated."));
        }
        else{
            echo json_encode(array("message" => "Unable to update user."));
        }
        break;

    case 'DELETE':
        $id = intval($_GET["id"]);
        if($userController->deleteUser($id)){
            echo json_encode(array("message" => "User was deleted."));
        }
        else{
            echo json_encode(array("message" => "Unable to delete user."));
        }
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
?>
