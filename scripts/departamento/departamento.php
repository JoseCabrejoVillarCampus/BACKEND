<?php
namespace App\departamento;
use App\db\connect;
use App\getInstance;
class departamento extends connect
{
    private $queryPost = 'INSERT INTO departamento(idDep,nombreDep,idPais) VALUES(:identificacion,:departamento,:pais)';
    private $queryGetAll = 'SELECT departamento.idDep, pais.idPais AS idPais
    FROM departamento
    INNER JOIN pais ON departamento.idPais = pais.idPais';
    private $queryUpdate = 'UPDATE departamento SET idDep = :identificacion, nombreDep = :departamento, idPais = :pais WHERE idDep = :identificacion';
    private $queryDelete = 'DELETE FROM departamento WHERE idDep = :identificacion';
    private $message;
    use getInstance;
    function __construct(private $idDep=1, public $nombreDep=1, private $idPais=1)
    {
        parent::__construct();
    }
    public function postDepartamento()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("identificacion", $this->idDep);
            $res->bindValue("departamento", $this->nombreDep);
            $res->bindValue("pais", $this->idPais);
            
            $res->execute();
            $this->message = json_encode(["Code" => 200 + $res->rowCount(), "Message" => "inserted data"]);
        } catch (\PDOException $e) {
            $this->message = json_encode(["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]]);
        } finally {
            print_r($this->message);
        }
    }
    public function getAllDepartamento()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindValue("identificacion", 3);
            $res->bindValue("departamento", 1);
            $res->bindValue("pais", 1);
            $this->message = json_encode(["Code" => 200, "Message" => $res->fetchAll(\PDO::FETCH_ASSOC)]);
        } catch (\PDOException $e) {
            $this->message = json_encode(["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]]);
        } finally {
            print_r($this->message);
        }
    }
    public function putDepartamento()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("identificacion", $this->idDep);
            $res->bindValue("departamento", $this->nombreDep);
            $res->bindValue("pais", $this->idPais);
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
    public function deleteDepartamento()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("identificacion", $this->idDep);
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