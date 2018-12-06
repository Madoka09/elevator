<?php
print("<nav class=\"uk-navbar-container\" uk-navbar>
<div class=\"uk-navbar-left\">
    <a class=\"uk-navbar-item uk-logo\">Recorrido Actual</a>
</div>
</nav>");

include "./elevator_logic.php";

$estadoInicial = $_POST['initial_state'];
$pisoMantenimiento = $_POST['floor_maintenance'];
$usuarios = [];
$floor_target = [];
print("<div class=\"uk-container\"");
print("<ul uk-accordion><li><a class=\"uk-accordion-title\">Mostrar Informacion de Debug</a><div class=\"uk-accordion-content\">");
//Obtener datos para construir array
for($x=1; $x <= count($_POST)/2-2; $x++) {
    $floor = $_POST['actual_floor_'.$x];
    $usuario = $_POST['user_'.$x]; 
    $destiny = $_POST['floor_target_'.$x];
    $usuarios[$floor] = $usuario;
    $floor_target[$floor] =$destiny;
}

print("<p class=\"uk-text-lead\">Orden de pisos: ");
print_r($floor_target);
print("</p>");
print("<hr>");
print("<p class=\"uk-text-lead\">Relacion de piso inicial y usuario: ");
print_r($usuarios);
print("</p>");
print("</div><li></ul>");
print("</div>");

$elevator = new Elevador();
$elevator -> firstStop($estadoInicial, $usuarios, $floor_target);
$first_position = array_search($elevator -> ordenar[0], $usuarios);
$first_destino = $floor_target[$first_position];
$internalPosition = $first_position;
$max_floor = max($floor_target);
$min_floor = min($floor_target);
?>