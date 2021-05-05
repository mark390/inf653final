<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../models/Category.php';

    $database = new Database();
    $db = $database->connect();

    $categories = new Category($db);

    $res = $categories->getCategories();
    if (count($res) > 0) {
        $p_array = array();
        $p_array['data'] = array();

        foreach ($res as $r) {
            $post_item = array(
                'id' => $r['id'],
                'category' => $r['category']
            );
            array_push($p_array['data'], $post_item);
        }

        echo json_encode($p_array);

    } else {
        echo json_encode(array('message' => 'No Category Found'));
    }
