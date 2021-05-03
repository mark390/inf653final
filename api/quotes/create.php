<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    $data = json_decode(file_get_contents('php://input'));
    $quote = $data->quote;
    $aid = $data->authorId;
    $cid = $data->categoryId;

    $result = Quote::createQuote($quote, $aid, $cid);

    if ($result) {
        echo json_encode(array('message' => 'Quote Not Created'));
    } else {
        echo json_encode(array('message' => 'Quote Created'));
    }