<?php
namespace Framework\Database\Adapters;
use Framework\Database\IDatabaseAdapter;
use Framework\Database\IModel;

/**
 * Adapter para o banco de dados Mysql
 *
 * @author Felippe
 */
class MysqlAdapter implements IDatabaseAdapter
{
    protected $conn;
    
    /**
     * Construtor, abre a conexão
     * @param array $dados
     */
    public function __construct($dados) {
        $this->conn = new \PDO("mysql:host=".$dados['host'].";dbname=".$dados['database'].";charset=utf8", $dados['user'], $dados['password']);
        $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    
    /**
     * Executa comando insert
     * @param type $object
     * @return type
     */
    public function insert(IModel $object)
    {
        $values = array();

        //é insert então remove id
        $fields = array_diff($object->getFields(),['id']);

        foreach($fields as $field)
        {
            $values[] = $object->$field;
        }

        $sql = "INSERT INTO ".$object->getTable()." (".implode(',',$fields).") VALUES (". str_repeat('? ,', count($values)-1) ." ? )";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($values);
    }
    
    /**
     * Executa comando select, usando como where o id da tabela
     * @param IModel $object
     * @param type $id
     * @return IModel
     */
    public function findByID(IModel $object, $id)
    {
        $sql = "SELECT ".implode(',', $object->getFields())." FROM ".$object->getTable()." WHERE id = ".(int) $id;

        foreach($this->conn->query($sql, \PDO::FETCH_ASSOC) as $row)
        {
            foreach($row as $column => $data)
            {
                $object->$column = $data;
            }
        }
        
        return $object;
    }
    
    /**
     * Executa comando update
     * @param IModel $object
     * @return boolean
     */
    public function update(IModel $object)
    {
        //armazenamos o id e removemos para não estragar update
        $id = $object->id;
        $fields = array_diff($object->getFields(),['id']);

        $sql = "UPDATE ".$object->getTable()." SET ";

        foreach($fields as $field)
        {
            $values[] = $object->$field;
            $sql .= $field .' = ? , ';
        }

        $sql = substr($sql, 0, -2);

        $sql .= " WHERE id = ".$id;
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($values);
    }

    /**
     * Deleta um registro
     * @param IModel $object
     * @return bool
     */
    public function delete(IModel $object)
    {
        $sql = "DELETE FROM ".$object->getTable()." WHERE ID = ".$object->id;
        return $this->conn->exec($sql);
    }

    /**
     * Retorna todos os registros de uma tabela
     *
     * @param IModel $object
     * @param int $pageSize
     * @param int $pageNum
     * @return array
     */
    public function getAll(IModel $object, $pageSize = null, $pageNum = null)
    {
        $sql = "SELECT * FROM ".$object->getTable();

        if(!empty($pageSize))
        {
            if(!empty($pageNum))
            {
                $page = $pageSize * ($pageNum-1);
                $sql .= " LIMIT ".(int)$page.",".(int)$pageSize;
            }
            else
            {
                $sql .= " LIMIT ".(int)$pageSize;
            }
        }

        return $this->conn->query($sql, \PDO::FETCH_ASSOC);
    }

    /**
     * Executa uma consulta SQL
     * @param string $sql
     * @return array
     */
    public function rawQuery($sql)
    {
        $query = $this->conn->query($sql, \PDO::FETCH_ASSOC);
        return $query->fetchAll();
    }
    
}
