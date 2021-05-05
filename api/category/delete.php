<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require '../../config/Database.php';
    require '../../models/Category.php';

    $database = new Database();
    $db = $database->connect();
    $categories = new Category($db);
    
    $data = json_decode(file_get_contents('php://input'));
    $id = $data->id;
    $before = $categories->getCount();
    $result = $categories->deleteCategory($id);
    $after = $categories->getCount();

    if ($after - $before != -1) {
        echo json_encode(array('message' => 'Category Not Deleted'));
    } else {
        echo json_encode(array('message' => 'Category Deleted'));
    }