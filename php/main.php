<?php

/** Siempre que sea necesario la utilización de la conexión se debe incluir o requerir el archivo main
 * y obtener la función de conexión
 * */

function conn(){
  $pdo = new PDO('mysql:host=localhost;dbname=inventario', 'root', 'kayascod');
  return $pdo;
}


// podriamos hacer consultas o ingresar datos en mysql me sql!
// $pdo->query('INSERT INTO tabla(nombre de los campos) VALUES(nombres de los valroes de cada campo)')*/


function verify_data_form($filter,$string){
  if(preg_match($filter, $string)){
    return true;
  } else {
    return false;
  }
}
 
// como utilizar la verificación anterior
/*$input="Pablo";

// comprobación:
if(verify_data_form("/^[a-zA-z0-9]{4,6}$/", $input)){
  echo "La verificación arroja resultado positivo";
} else{
  echo "la comprobción arroja resultado negativo. Intente nuevamente...";
}*/

/**
 * VAMOS A FORMATEAR CADENAS PARA EVITAR ATAQUES SQL
 * */

function str_clean($str){
  $str=trim($str);
  $str=stripslashes($str);
  $str=str_ireplace("<script>","",$str);//evita el ataque xss
  $str=str_ireplace("</script>","", $str);
  $str=str_ireplace("<script src>", "", $str);
  $str=str_ireplace("<script type>", "", $str);
  $str=str_ireplace("SELECT * FROM", "", $str);
  $str=str_ireplace("DELETE FROM", "", $str);
  $str=str_ireplace("INSERTO INTO", "", $str);
  $str=str_ireplace("DROP TABLE", "", $str);
  $str=str_ireplace("DROP DATABASE", "", $str);
  $str=str_ireplace("TRUNCATE TABLE", "", $str);
  $str=str_ireplace("SHOW TABLES", "", $str);
  $str=str_ireplace("SHOW DATABASES", "", $str);
  $str=str_ireplace("<?php", "", $str);
  $str=str_ireplace("?>", "", $str);
  $str=str_ireplace("--", "", $str);
  $str=str_ireplace("^","",$str);
  $str=str_ireplace("<", "", $str);
  $str=str_ireplace("[","",$str);
  $str=str_ireplace("]", "", $str);
  $str=str_ireplace("==", "", $str);
  $str=str_ireplace(";", "", $str);
  $str=str_ireplace("::", "", $str);
  $str=trim($str);
  $str=stripslashes($str);
  return $str;
}


/*$text="<script>Hola mundo</script>";
$text_filtered= str_clean($text);
echo $text_filtered;*/

/*RENONBRAR FOTOS: podemos evitar la existencia de espacios,*/

function rename_photo($name){
  $name=str_ireplace(" ", "_", $name);
  $name=str_ireplace("/", "_", $name);
  $name=str_ireplace("#", "_", $name);
  $name=str_ireplace("-", "_", $name);
  $name=str_ireplace("$","_", $name);
  $name=str_ireplace(",","_", $name);
  $name=str_ireplace(".","_", $name);
  $name=$name."_".rand(0,100);
  return $name;
}

/*$name_photo="eeef+zABDF,WER.asd123/dfdf$$$552df.jpg";

$re_name_photo=rename_photo($name_photo);

echo "Nuevo nombre: ",$re_name_photo;*/

// PAGINADOR

function paginator_tables($pagina, $Npaginas, $url, $botones){
  $table='
    <nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">
      
    </nav>
  ';
  /**boton anterior*/
  if($pagina <= 1){
    $table.='<a class="pagination-previous is-disabled" disabled href="#" >anterior</a>
    <ul class=""pagination-list>

    </ul>
    ';
  } else {
    $table.='<a class="pagination-previous" href="'.$url.($pagina-1).'" >anterior</a>
    <ul class=""pagination-list>
      <li><a href="'.$url.'1" class="pagination-link">1</a></li>
      <li><span class="pagination-ellipsis">&hellip;</span></li>
    ';
  }

  /**iconos de botones*/
  $counter=0;
  for($i=$pagina;$i<=$Npaginas;$i++){

    if($counter >=$botones){
      break;
    }

    if($pagina==$i){
      $table.='
        <li><a class="pagination-link is-current" href="'.$url.$i.'">'.$i.'</a></li>
      ';
    } else {
      $table.='
        <li><a class="pagination-link" href="'.$url.$i.'">'.$i.'</a></li>
      ';
    }

    $counter++;
  }

  /**boton siguiente*/
  if($pagina === $Npaginas){
    $table.='
      </ul>
      <a class="pagination-next is-disabled" disabled >siguiente</a>
    ';
  } else {
    $table.='
      <li><span class="pagination-ellipsis">&hellip;</span></li>
      <li><a class="pagination-link" href="'.$url.$Npaginas.'" >'.$Npaginas.'</a></li>
      </ul>
      <a class="pagination-next is-disabled"  href="'.$url.($pagina+1).'">siguiente</a>
    ';
  }

  $table='
    </nav>
  ';
  return $table;
}