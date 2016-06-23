<?php
namespace Framework\Validators;

/**
 * Validador de CPF
 *
 * @author Felippe
 */
class CPFValidator implements IValidator {
    
    /**
     * Executa o validador
     * @param string $param
     * @return boolean
     */
    public function run($param)
    {
        $param = str_pad(preg_replace('[^0-9]', '', $param), 11, '0', STR_PAD_LEFT);
	
        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($param) != 11 ||
                $param == '00000000000' ||
                $param == '11111111111' ||
                $param == '22222222222' ||
                $param == '33333333333' ||
                $param == '44444444444' ||
                $param == '55555555555' ||
                $param == '66666666666' ||
                $param == '77777777777' ||
                $param == '88888888888' ||
                $param == '99999999999'
            )
        {
            return false;
        }
        else
        {   // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $param{$c} * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;

                if ($param{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }
}
