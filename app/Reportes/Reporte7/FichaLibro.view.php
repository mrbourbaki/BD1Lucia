

<html>

 

 <body >
    <div >
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
        ),
            "cssClass"=>array(
                "table"=>"table-bordered table-striped table-hover"
            ),       
     ));
     ?>
   </div> 
 </body>
 
 </html>