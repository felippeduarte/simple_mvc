<?php
namespace Framework\Validators;

/**
 * Validador de not null
 *
 * @author Felippe
 */
class NotNullValidator implements IValidator {
    
    /**
     * Executa o validador
     * @param string $param
     * @return boolean
     */
    public function run($param)
    {
        return strlen($param) > 0;
    }
}
