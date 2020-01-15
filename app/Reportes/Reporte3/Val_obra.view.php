
<?php 
    use \koolreport\widgets\koolphp\Table;
    use \koolreport\widgets\google\BarChart;
?>
<div class="text-center">
    <h1>Obras analizadas en la actualidad</h1>
</div>
<hr/>

<?php
Table::create(array(
    "dataStore"=>$this->dataStore("result"),
        "columns"=>array(
            "valoracion"=>array(
                "type"=>"number",
                "label"=>"valoracion"
            ),
            "nombre_libro"=>array(
                "label"=>"nombre"
            ),
        ),
    "cssClass"=>array(
        "table"=>"table table-hover table-bordered"
    )
));
?>