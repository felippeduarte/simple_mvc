<?php
namespace Framework\Validators;

/**
 * Validador de Numeric
 *
 * @author Felippe
 */
class NumericValidator implements IValidator {
    
    /**
     * Executa o validador
     * @param string $param
     * @return boolean
     */
    public function run($param)
    {        
        return is_numeric($param);
    }
}
