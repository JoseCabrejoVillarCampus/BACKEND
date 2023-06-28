<?php
namespace App\region;
use App\db\connect;
use App\getInstance;
class region extends connect
{
    private $queryPost = 'INSERT INTO region(idReg,nombreReg,idDep) VALUES(:identificacion,:region,:departamento)';
    private $queryGetAll = 'SELECT region.idReg, departamento.idDep AS idDep
    FROM region
    INNER JOIN areas ON region.idDep = departamento.idDep';
    private $queryUpdate = 'UPDATE region SET idReg = :identificacion, nombreReg = :region, idDep = :departamento WHERE idReg = :identificacion';
    private $queryDelete = 'DELETE FROM region WHERE idReg = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $idReg=1, public $nombreReg=1, private $idDep=1)
    {
        parent::__construct();
    }
    public function postRegion()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->idReg);
            $res->bindValue("region", $this->nombreReg);
            $res->bindValue("departamento", $this->idDep);
            
            $res->execute();
            $this->message = json_encode(["Code" => 200 + $res->rowCount(), "Message" => "inserted data"]);
        } catch (\PDOException $e) {
            $this->message = json_encode(["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]]);
        } finally {
            print_r($this->message);
        }
    }
    public function getAllRegion()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("region", 1);
            $res->bindValue("departamento", 1);
            $this->message = json_encode(["Code" => 200, "Message" => $res->fetchAll(\PDO::FETCH_ASSOC)]);
        } catch (\PDOException $e) {
            $this->message = json_encode(["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]]);
        } finally {
            print_r($this->message);
        }
    }
    public function putRegion()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->idReg);
            $res->bindValue("region", $this->nombreReg);
            $res->bindValue("departamento", $this->idDep);
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
    public function deleteRegion()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->idReg);
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