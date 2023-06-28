<?php
namespace App\campers;
use App\db\connect;
use App\getInstance;
class campers extends connect
{
    private $queryPost = 'INSERT INTO campers(idCamper,nombreCamper,apellidoCamper,fechaNac,idReg) VALUES(:identificacion,:nombre,:apellido,:fecha,:region)';
    private $queryGetAll = 'SELECT campers.idCamper, region.idReg AS idReg 
    FROM campers 
    INNER JOIN region ON campers.idReg = region.idReg';
    private $queryUpdate = 'UPDATE campers SET idCamper = :identificacion, nombreCamper = :nombre, apellidoCamper = :apellido, fechaNac = :fecha, idReg = :region WHERE idCamper = :identificacion';
    private $queryDelete = 'DELETE FROM campers WHERE idCamper = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $idCamper = 1, public $nombreCamper = 1, public $apellidoCamper = 1, public $fechaNac = 1, private $idReg = 1)
    {
        parent::__construct();
    }
    public function postCamper()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->idCamper);
            $res->bindValue("nombre", $this->nombreCamper);
            $res->bindValue("apellido", $this->apellidoCamper);
            $res->bindValue("fecha", $this->fechaNac);
            $res->bindValue("region", $this->idReg);
            $res->execute();
            $this->message = json_encode(["Code" => 200 + $res->rowCount(), "Message" => "inserted data"]);
        } catch (\PDOException $e) {
            $this->message = json_encode(["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]]);
        } finally {
            print_r($this->message);
        }
    }
    public function getAllCamper()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("nombre", 1);
            $res->bindValue("apellido", 1);
            $res->bindValue("fecha", 1);
            $res->bindValue("region", 1);
            $this->message = json_encode(["Code" => 200, "Message" => $res->fetchAll(\PDO::FETCH_ASSOC)]);
        } catch (\PDOException $e) {
            $this->message = json_encode(["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]]);
        } finally {
            print_r($this->message);
        }
    }
    public function putCamper()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->idCamper);
            $res->bindValue("nombre", $this->nombreCamper);
            $res->bindValue("apellido", $this->apellidoCamper);
            $res->bindValue("fecha", $this->fechaNac);
            $res->bindValue("region", $this->idReg);
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
    public function deleteCamper()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->idCamper);
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