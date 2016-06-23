<?php
namespace App\Model;
use Framework\Database\Database;
use Framework\Database\IModel;
use Framework\Validators;

/**
 * Classe abstrata para funções gerais dos Models
 *
 * @author Felippe
 */
abstract class BaseModel implements IModel {
    
    /**
     * Transforma o model para persistir no Banco de Dados
     */
    abstract public function toDB();
    
    /**
     * Transforma o model para exibir na View
     */
    abstract public function toView();


    /**
     * Adaptador do banco de dados
     * @var \Framework\Database\IDatabaseAdapter
     */
    private $adapter;
    
    /**
     * Tabela alvo do banco de dados
     * @var string
     */
    protected $table;
    
    /**
     * Campos da tabela
     * @var array
     */
    protected $fields;
    
    /**
     * Campos a serem validados
     * @var array
     */
    protected $validations = [];
    
    /**
     * Construtor
     */
    public function __construct()
    {
        //inicializa campos
        foreach($this->fields as $field)
        {
            $this->$field = null;
        }
        
        //inicializa bd
        $this->adapter = Database::getInstance()->getAdapter();
    }

    /**
     * Get table
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }
    
    /**
     * Get fields
     * @return string
     */
    public function getFields()
    {
        return $this->fields;
    }
    
    /**
     * Salva o elemento
     * 
     * @return int
     */
    public function save()
    {
        $this->validateModel();
                
        if(empty($this->id))
        {
            return $this->adapter->insert($this);
        }
        else
        {
            return $this->adapter->update($this);
        }
    }
    
    /**
     * Buscar os dados do elemento
     * 
     * @param int $id
     * @return IModel
     */
    public function get($id)
    {
        $obj = $this->adapter->findByID($this, $id);
        $obj->toView();
        
        return $obj;
    }

    /**
     * Buscar todos os elementos
     *
     * @param int $pageSize
     * @param int $pageNum     
     * @return array
     */
    public function all($pageSize = null, $pageNum = null)
    {
        return $this->adapter->getAll($this, $pageNum, $pageSize);
    }


    /**
     * Remove o elemento
     * @return bool
     */
    public function delete()
    {
        return $this->adapter->delete($this);
    }
    
    /**
     * Executa uma consulta em SQL
     * @param string $sql
     * @return array
     */
    public function rawQuery($sql)
    {
        return $this->adapter->rawQuery($sql);
    }

    /**
     * Preenche o model com dados do POST
     * @param array $post dados do POST
     * @return array|boolean falso caso hajam dados incompletos
     * @throws Exception
     */
    public function fill($post)
    {        
        foreach($this->fields as $field)
        {
            if(array_key_exists($field, $post))
            {
                $this->$field = $post[$field];
            }
            else
            {
                throw new \Exception("Dados incompletos");
            }
        }

        $this->toDB();
   
        return $this;
    }
    
    /**
     * Valida o model para inserção, de acordo com os validators
     * @return boolean
     * @throws Exception
     */
    private function validateModel()
    {
        foreach($this->validations as $field => $validation)
        {
            //campo nao setado;
            //ja passou pelo post validator, entao sem problemas
            if(!isset($this->$field)) continue;
            
            switch($validation)
            {
                case 'cpf':
                    $validator = (new Validators\CPFValidator());
                    break;
                case 'id':
                    $validator = (new Validators\IdValidator());
                    break;
                case 'int':
                    $validator = (new Validators\IntValidator());
                    break;
                case 'numeric':
                    $validator = (new Validators\NumericValidator());
                    break;
                case 'uf':
                    $validator = (new Validators\UFValidator());
                    break;
                case 'telefone':
                    $validator = (new Validators\TelefoneValidator());
                    break;
                case 'date':
                    $validator = (new Validators\DateValidator());
                    break;
                case 'notnull':
                    $validator = (new Validators\NotNullValidator());
                    break;
                default:
                    throw new \Exception("Validator não encontrado");
            }
            
            if($validator instanceof Validators\IValidator)
            {
                if(!$validator->run($this->$field))
                {
                    throw new \Exception("Erro ao validar o campo: ".$field.". Valor ".$this->$field." é inválido");
                }
            }
        }

        return true;
    }

    /**
     * Retorna o número de registros da tabela
     * @return int
     */
    public function getTotalCount()
    {
        $sql = "select count(*) as total from ".$this->getTable();

        $result = $this->rawQuery($sql);

        return $result[0]['total'];

    }
}
