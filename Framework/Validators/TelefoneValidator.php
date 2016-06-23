<?php
namespace Framework\Validators;

/**
 * Validador de Telefone
 *
 * @author Felippe
 */
class TelefoneValidator implements IValidator {
    
    /**
     * Executa o validador
     * @param string $param
     * @return boolean
     */
    public function run($param)
    {
        $regex = '/[1-9]{2}[2-9][0-9]{3,9}/';
        return preg_match($regex, $param);
    }
}
