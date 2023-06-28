<?php
namespace App\pais;
use App\db\connect;
use App\getInstance;
class pais extends connect
{
    private $queryPost = 'INSERT INTO pais(idPais,nombrePais) VALUES(:identificacion,:paisname)';
    private $queryGetAll = 'SELECT * FROM pais';
    private $queryUpdate = 'UPDATE pais SET idPais = :identificacion, nombrePais = :paisname  WHERE idPais = :identificacion';
    private $queryDelete = 'DELETE FROM pais WHERE idPais = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $idPais=1, public $nombrePais=1)
    {
        parent::__construct();
    }
    public function postPais()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->idPais);
            $res->bindValue("paisname",$this->nombrePais);
            $res->execute();
            $this->message = json_encode(["Code" => 200 + $res->rowCount(), "Message" => "inserted data"]);
        } catch (\PDOException $e) {
            $this->message = json_encode(["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]]);
        } finally {
            print_r($this->message);
        }
    }
    public function getAllPais()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", $this->idPais);
            $res->bindValue("paisname",$this->nombrePais);
            $this->message = json_encode(["Code" => 200, "Message" => $res->fetchAll(\PDO::FETCH_ASSOC)]);
        } catch (\PDOException $e) {
            $this->message = json_encode(["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]]);
        } finally {
            print_r($this->message);
        }
    }
    public function putPais()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->idPais);
            $res->bindValue("paisname",$this->nombrePais);
            $res->execute();

            if ($res->rowCount() > 0) {
                $this->message = json_encode(["Code" => 200, "Message" => "Data updated"]);
            } else {
                $this->message = json_encode(["Code" => 404, "Message" => "No matching record found"]);
            }
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function deletePais()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->idPais);
            $res->execute();
            $this->message = json_encode(["Code" => 200, "Message" => "Data delete"]);
        } catch (\PDOException $e) {
            $this->message = json_encode(["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]]);
        } finally {
            print_r($this->message);
        }
    }
}
?>