<?php
namespace App\db;
abstract class credentials{
    
    protected $dbname = "campuslands";
    protected $host = 'localhost';
    protected $user = 'root';
    protected $password = '';

    public function __get($name){
        return $this->{$name};
    }
}
?>