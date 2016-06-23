<?php
namespace Framework\Validators;

/**
 * Validador de Ids
 *
 * @author Felippe
 */
class IdValidator implements IValidator {
    
    /**
     * Executa o validador
     * @param string $param
     * @return boolean
     */
    public function run($param)
    {
        return ((int)$param == $param && $param > 0) || $param == "";
    }
}
