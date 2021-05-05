<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    $database = new Database();
    $db = $database->connect();

    $authors = new Author($db);

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $res = $authors->getAuthorsbyID($id);

    if (count($res) > 0) {
        $p_array = array();
        $p_array['data'] = array();

        foreach ($res as $r) {
            $post_item = array(
                'id' => $r['id'],
                'author' => $r['author'],
            );
            array_push($p_array['data'], $post_item);
        }

        echo json_encode($p_array);

    } else {
        echo json_encode(array('message' => 'No Post Found'));
    }