<?php
namespace App\Model;

/**
 * Model Contrato
 *
 * @author Felippe
 */
class Contrato extends BaseModel {
    
    protected $table = "contrato";
    
    protected $fields = ['id','codigo','valor','dataCadastro','cliente_id'];

    protected $validations = [
        'id' => 'id',
        'codigo' => 'notnull',
        'valor' => 'numeric',
        'dataCadastro' => 'date',
        'cliente_id' => 'int'
    ];
    
    /**
     * Instancia do Model Cliente
     * @var Estado
     */
    protected $cliente;
    
    public function toDB() {
        //faz tratamento de dados
        $this->valor = str_replace(',','.', $this->valor);
        
        $dataCadastro = \DateTime::createFromFormat('d/m/Y', $this->dataCadastro);
        
        if($dataCadastro)
        {
            $this->dataCadastro = $dataCadastro->format('Y-m-d');
        }
        else
        {
            throw new \Exception("Data de cadastro inválida");
        }
    }
    
    public function toView() {
        $this->valor = str_replace('.',',', $this->valor);
                
        $dataCadastro = \DateTime::createFromFormat('Y-m-d', $this->dataCadastro);
        
        if($dataCadastro)
        {
            $this->dataCadastro = $dataCadastro->format('d/m/Y');
        }
    }
    
    /**
     * Retorna o objeto
     * @param int $id
     */
    public function get($id)
    {        
        $obj = parent::get($id);
        
        
        return $obj;
    }
    
    /**
     * Retorna os contratos de um cliente
     * @param int $cliente_id
     * @return array
     */
    public function getContratosPorCliente($cliente_id)
    {
        $sql = "SELECT id, codigo, valor, dataCadastro FROM ".$this->table." WHERE cliente_id = ".(int)$cliente_id;
        return $this->rawQuery($sql);
    }
    
    /**
     * Pega o cliente
     */
    public function getCliente()
    {
        if((!$this->cliente instanceof Cliente) || $this->cliente->id != $this->cliente_id)
        {
            $this->cliente = (new Cliente)->get($this->cliente_id);
        }

        return $this->cliente;
    }
}
