<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require '../../config/Database.php';
    require '../../models/Quote.php';

    $database = new Database();
    $db = $database->connect();
    $quotes = new Quote($db);
    
    $data = json_decode(file_get_contents('php://input'));
    $quote = $data->quote;
    $aid = $data->authorId;
    $cid = $data->categoryId;

    $before = $quotes->getCount();
    $result = $quotes->createQuote($quote, $aid, $cid);
    $after = $quotes->getCount();

    if ($after - $before != 1) {
        echo json_encode(array('message' => 'Quote Not Created'));
    } else {
        echo json_encode(array('message' => 'Quote Created'));
    }