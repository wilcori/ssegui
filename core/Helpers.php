<?php

class Helpers
{
	public function __construct(){

	}

	public function generateMenu($arr, $ul = ''){
        echo '<ul'.$ul.'>';
        foreach ($arr as $val) {
            if (!empty($val['children'])) {
                echo '<li class="dropdown"><a href="index.php?controller='.$val['controller'].'&action='.$val['action'].'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.$val['etiqueta'].'<span class="caret"></span></a>';
                $this->generateMenu($val['children'],' class="dropdown-menu" role="menu"');
                echo '</li>';
            } else {
                echo '<li><a href="index.php?controller='.$val['controller'].'&action='.$val['action'].'">' . $val['etiqueta'] . '</a></li>';
            }
        }
        echo '</ul>';
	}	

    public function cambiaf_a_normal($fecha){
        ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
        $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
        return $lafecha;
    }

    public function cambiaf_a_mysql($fecha){
        ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
        $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
        return $lafecha;
    }

}
?>
