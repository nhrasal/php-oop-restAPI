<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, multipart/form-data");

   
    include_once '../../config/database.php';
    include_once '../../class/category.php';

    $database = new Database();
    $db = $database->getConnection();


    $item = new Category($db);


    $data = json_decode(file_get_contents("php://input"));

    echo $item->name = $data->name;

    if($item->createCategory()){
        echo 'Category created successfully.';
    } else{
        echo 'Category could not be created.';
    }
?>