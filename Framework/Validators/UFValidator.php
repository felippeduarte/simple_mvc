<?php
namespace Framework\Validators;

/**
 * Validador de UF
 *
 * @author Felippe
 */
class UFValidator implements IValidator {
    
    /**
     * Executa o validador
     * @param string $param
     * @return boolean
     */
    public function run($param)
    {
        $ufs = [
            "AC","AL","AM","AP","BA","CE","DF","ES","GO","MA",
            "MT","MS","MG","PA","PB","PR","PE","PI","RJ","RN",
            "RO","RS","RR","SC","SE","SP","TO",
        ];
        
        return in_array($param,$ufs);
    }
}
