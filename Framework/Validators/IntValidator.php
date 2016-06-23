<?php
namespace Framework\Validators;

/**
 * Validador de Int
 *
 * @author Felippe
 */
class IntValidator implements IValidator {
    
    /**
     * Executa o validador
     * @param string $param
     * @return boolean
     */
    public function run($param)
    {
        return (int)$param == $param && strlen((int)$param) === strlen($param);
    }
}
