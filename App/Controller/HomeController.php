<?php
namespace App\Controller;

/**
 * Controller Inicial
 * 
 * @author Felippe
 */
class HomeController extends BaseController
{
    public function index()
    {
        $this->template->show('home', 'index');
    }
}
