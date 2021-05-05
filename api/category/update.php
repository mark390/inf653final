<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require '../../config/Database.php';
    require '../../models/Category.php';

    $database = new Database();
    $db = $database->connect();
    $categories = new Category($db);
    
    $data = json_decode(file_get_contents('php://input'));
    $category = $data->category;
    $id = $data->id;

    $result = $categories->updateCategory($category, $id);
    echo json_encode(array('message' => 'Category Updated'));