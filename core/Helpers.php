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
    
    public function fechaALetras($fecha){
      $fecha_separada=explode("/", $fecha);

      $dia = $fecha_separada[0];

      switch ($fecha_separada[1]) {

        case "01":
            $mes="Enero";
          break;
        case "02":
            $mes="Febrero";
          break;
        case "03":
            $mes="Marzo";
          break;
        case "04":
            $mes="Abril";
          break;
        case "05":
            $mes="Mayo";
          break;
        case "06":
            $mes="Junio";
          break;
        case "07":
            $mes="Julio";
          break;
        case "08":
            $mes="Agosto";
          break;
        case "09":
            $mes="Septiembre";
          break;
        case "10":
            $mes="Octubre";
          break;
        case "11":
            $mes="Noviembre";
          break;
        case "12":
            $mes="Diciembre";
          break;

        default:
          break;
      }

      $anio = $fecha_separada[2];


      return "$dia de $mes de $anio";
    }
    
}
?>
