<?php
namespace App\Model;

/**
 * Model Estado
 *
 * @author Felippe
 */
class Estado extends BaseModel {
    
    protected $table = "estado";
    
    protected $fields = ['id','nome'];
    
    public function toDB() {}
    public function toView() {}
}
