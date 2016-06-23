<?php
namespace App\Components;

/**
 * Componente para paginação
 *
 * @author Felippe
 */
class Paginator {
    
    public static function printPaginator($controller, $action, $currentPage, $pageSize, $numElements, $numeroPaginasExibidas = 10)
    {
        $numeroPaginasExibidas = 10;
        
        $paginator = '<div class="paginator">';
        $paginator .= '<a href="/'.$controller.'/'.$action.'?page=1">Primeira</a>';
    
        $pages = array();
        
        $totalPages = ceil($numElements/$pageSize);
        
        $media = floor($numeroPaginasExibidas/2);
        
        //correcao de calculo para paginas impares e pares
        //se for par adiciona uma no final
        $correcao = $numeroPaginasExibidas % 2 == 0 ? 1:0;
        
        if($totalPages > $numeroPaginasExibidas)
        {
            //pagina no comeco
            if($currentPage < $media)
            {
                $limiteEsquerda = 1;
                $limiteDireita = $numeroPaginasExibidas;
            }
            //pagina no final
            else if($currentPage > $totalPages - $media)
            {
                $limiteEsquerda = $totalPages - $numeroPaginasExibidas + $correcao;
                $limiteDireita = $totalPages;
            }
            //pagina no meio
            else
            {
                $limiteEsquerda = $currentPage - $media + $correcao;
                $limiteDireita = $currentPage + $media;
            }
            
            //carrega paginas
            for($i = $limiteEsquerda; $i <= $currentPage; $i++)
            {
                $pages[] = '<a href="/'.$controller.'/'.$action.'?page='.$i.'">'.$i.'</a>';
            }
            
            for($i = $currentPage+1; $i <= $limiteDireita; $i++)
            {
                $pages[] = '<a href="/'.$controller.'/'.$action.'?page='.$i.'">'.$i.'</a>';
            }
        }
        else
        {
            for($i = 0, $page = 1; $i < $numElements; $i += $pageSize, $page++)
            {
                $pages[] = '<a href="/'.$controller.'/'.$action.'?page='.$page.'">'.$page.'</a>';
            }
        }
    
        $paginator .= implode('',$pages);
        
        $paginator .= '<a href="/'.$controller.'/'.$action.'?page='.$totalPages.'">Última</a>';
        $paginator .= '</div>';
        
        echo $paginator;
    }
    
}
