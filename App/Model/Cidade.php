<?php
namespace App\Model;

/**
 * Model Cidade
 *
 * @author Felippe
 */
class Cidade extends BaseModel {
    
    protected $table = "cidade";
    
    protected $fields = ['id','nome','estado_id'];

    public function toDB() {}
    public function toView() {}
    
    /**
     * Instancia do Model Estado
     * @var Estado
     */
    protected $estado;
    
    /**
     * Busca todas as cidades de um Estado
     * @param int $estado_id
     * @return array
     */
    public function getCidadesPorEstado($estado_id)
    {
        $sql = "SELECT id, nome FROM ".$this->table." WHERE estado_id = ".(int)$estado_id;
        return $this->rawQuery($sql);
    }
    
    /**
     * Retorna o Estado da Cidade
     * @return Estado
     */
    public function getEstado()
    {
        if((!$this->estado instanceof Estado) || $this->estado->id != $this->estado_id)
        {
            $this->estado = (new Estado())->get($this->estado_id);
        }

        return $this->estado;
    }
}
