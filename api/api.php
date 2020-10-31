<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
require_once './BankApi.php';

$Api = new BankApi();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $postdata = file_get_contents('php://input');
    $data = json_decode($postdata, true);
} else {
    $data = $_SERVER['QUERY_STRING'];
    $data = $_REQUEST;//parse($data);
}

if (isset($data['type'])){
    $method = $data['type'];
    if (method_exists($Api, $method)){
        $drar = $Api->$method($data);
        header('Content-type: application/json');
        echo json_encode($drar, JSON_UNESCAPED_UNICODE);
    } else {
        print_r('Такого метода не существует!');
    }
} else {
    print_r('Не задан метод!');
}