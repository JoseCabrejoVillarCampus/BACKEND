<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    require_once "./vendor/autoload.php";

    $router = new \Bramus\Router\Router();

    
    /* 
    ? rutas pais
    */
    $router->get('/api/pais', function(){
        \App\pais\pais::getInstance(json_decode(file_get_contents("php://input"),true))->getAllPais();
    });
    $router->post('/api/pais/post', function(){
        \App\pais\pais::getInstance(json_decode(file_get_contents("php://input"),true))->postPais();
    });
    $router->put('/api/pais/put', function(){
        \App\pais\pais::getInstance(json_decode(file_get_contents("php://input"),true))->putPais();
    });
    $router->delete('/api/pais/del', function(){
        \App\pais\pais::getInstance(json_decode(file_get_contents("php://input"),true))->deletePais();
    });
    /* 
    ? rutas campers
    */
    $router->get('/api/campers', function(){
        \App\campers\campers::getInstance(json_decode(file_get_contents("php://input"),true))->getAllCamper();
    });
    $router->post('/api/campers/post', function(){
        \App\campers\campers::getInstance(json_decode(file_get_contents("php://input"),true))->postCamper();
    });
    $router->put('/api/campers/put', function(){
        \App\campers\campers::getInstance(json_decode(file_get_contents("php://input"),true))->putCamper();
    });
    $router->delete('/api/campers/del', function(){
        \App\campers\campers::getInstance(json_decode(file_get_contents("php://input"),true))->deleteCamper();
    });
    /* 
    ? rutas region
    */
    $router->get('/api/region', function(){
        \App\region\region::getInstance(json_decode(file_get_contents("php://input"),true))->getAllRegion();
    });
    $router->post('/api/region/post', function(){
        \App\region\region::getInstance(json_decode(file_get_contents("php://input"),true))->postRegion();
    });
    $router->put('/api/region/put', function(){
        \App\region\region::getInstance(json_decode(file_get_contents("php://input"),true))->putRegion();
    });
    $router->delete('/api/region/del', function(){
        \App\region\region::getInstance(json_decode(file_get_contents("php://input"),true))->deleteRegion();
    });
    /* 
    ? rutas departamento
    */
    $router->get('/api/departamento', function(){
        \App\departamento\departamento::getInstance(json_decode(file_get_contents("php://input"),true))->getAllDepartamento();
    });
    $router->post('/api/departamento/post', function(){
        \App\departamento\departamento::getInstance(json_decode(file_get_contents("php://input"),true))->postDepartamento();
    });
    $router->put('/api/departamento/put', function(){
        \App\departamento\departamento::getInstance(json_decode(file_get_contents("php://input"),true))->putDepartamento();
    });
    $router->delete('/api/departamento/del', function(){
        \App\departamento\departamento::getInstance(json_decode(file_get_contents("php://input"),true))->deleteDepartamento();
    });
    
    $router->run(); 

?>