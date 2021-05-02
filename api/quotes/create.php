<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
    Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);


    if (Quote::createQuote($data['quote'], $data['authorId'], $data['categoryId'])) {
        echo json_encode(array('message' => 'Quote Created'));
    } else {
        echo json_encode(array('message' => 'Quote Not Created'));
    }