<?php
namespace Framework\Validators;

/**
 * Interface para validadores
 *
 * @author Felippe
 */
interface IValidator {
    
    public function run($data);
}
