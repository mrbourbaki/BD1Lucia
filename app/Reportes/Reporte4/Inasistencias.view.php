
<?php 
    use \koolreport\widgets\koolphp\Table;
    use \koolreport\widgets\google\BarChart;
?>
<div class="text-center">
    <h1>Sales Report</h1>
    <h4>This report shows top 10 sales by customer</h4>
</div>
<hr/>

<?php
Table::create(array(
    "dataStore"=>$this->dataStore("result"),
        "columns"=>array(
            "Nombre"=>array(
                "label"=>"Customer"
            ),
            "Porcentaje_inasistencias"=>array(
                "type"=>"number",
                "label"=>"Porcentaje",
                "prefix"=>"%",
            )
        ),
    "cssClass"=>array(
        "table"=>"table table-hover table-bordered"
    )
));
?>
