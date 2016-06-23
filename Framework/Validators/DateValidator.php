<?php
namespace Framework\Validators;

/**
 * Validador de Datas
 *
 * @author Felippe
 */
class DateValidator implements IValidator {
    
    /**
     * Executa o validador
     * @param string $param
     * @return boolean
     */
    public function run($param)
    {
        $date = explode('-', $param);
        if(count($date) != 3)
        {
            return false;
        }
        
        return checkdate((int)$date[1], (int)$date[2], (int)$date[0]);
    }
}
