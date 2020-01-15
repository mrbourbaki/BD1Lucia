

<html>

<body >
   <div  style=" width:100%">
       <div>
           <h1> Ficha del libro </h1>    
       </div>
    <?php
    koolreport\widgets\koolphp\Table:: create(array(
       "dataSource"=>$this->dataStore("result"),
       "columns"=>array(
           "titulo_original"=>array(
               "label"=>" Titulo "
           ),
           "titulo_espanol"=>array(
               "label"=>"Titulo Español",
           ),
           "tema"=>array(
               "label"=>"Tema",
           ), 
           "sinopsis"=>array(
               "label"=>"Sinopsis",
           ), 
           "nombre"=>array(
               "label"=>"Genero",
           ),
           "nro_pags"=>array(
               "label"=>"Numero de pag",
           ),
           "nombre"=>array(
               "label"=>"Editorial",
           ),
           "nombre"=>array(
               "label"=>"Lugar/Direccion",
           ),
           "ano"=>array(
               "label"=>"Año",
           ), 
           "titulo_original"=>array(
            "label"=>"Libro complementario",
           ),
       ),
           "cssClass"=>array(
               "table"=>"table-bordered table-striped table-hover"
           ),      
    ));

    koolreport\widgets\koolphp\Table:: create(array(
        "dataSource"=>$this->dataStore("cap"),
        "columns"=>array(
            "nombre"=>array(
                "label"=>" Capitulos "
            ),
 
        ),
            "cssClass"=>array(
                "table"=>"table-bordered table-striped table-hover"
            ),      
     ));


    ?>
  </div> 
</body>

</html>