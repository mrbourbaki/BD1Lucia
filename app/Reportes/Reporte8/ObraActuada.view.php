<html>

 <body >
    <div style="width:80%; float:left ; margin:50px 50px 0 70px;">
        <div>
            <h1> Obra </h1>    
        </div>
     <?php
     koolreport\widgets\koolphp\Table:: create(array(
        "dataSource"=>$this->dataStore("result"),
        "columns"=>array(
            "titulo"=>array(
                "label"=>" Titulo "
            ),
            "resumen"=>array(
                "label"=>"Resumen",
            ),
            "precio"=>array(
                "label"=>"Costo",
            ), 
            "nombre1"=>array(
                "label"=>"Nombre",
            ),
            "apellido1"=>array(
                "label"=>" Apellido",
            ),
          
        ),
        "headers"=>array(
            array(
                "Obra informacion "=>array("colSpan"=>3),
                "Elenco"=>array("colSpan"=>3),
            )
        ), 
            "cssClass"=>array(
                "table"=>"table-bordered table-striped table-hover"
            ), 
            "removeDuplicate"=>array("titulo","resumen","precio"),
            
            
            
            
     ));
     ?>
   </div> 
 </body>
 
 </html>