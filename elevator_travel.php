<?php
include_once 'display_logic.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Elevador Magico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.24/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.24/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.24/js/uikit-icons.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body id="body-background">
    <div class="uk-container">
        <div class="uk-card uk-card-default uk-card-body uk-card-hover uk-align-center">
        <h1 class="uk-heading-divider">Realizando recorrido...</h1>
        <div class="elevator">
            <div class="uk-container">
                <?php for ($x = 0; $x < $max_floor; $x++) {
                    echo '<div class="uk-animation-toggle"><div class="uk-card uk-card-default uk-card-body uk-animation-slide-left-small" id="floor-' . ($max_floor - $x) . '">Piso ' . ($max_floor - $x) . ' </div></div>';
                } ?>
            </div>
            <br>
            <div class="elevator__results">
                <h3 class="uk-heading-bullet">Relación de Acciones</h3>
                <?php
                    //Cambiar color del piso inicial 
                echo ('<style>
                    #floor-' . $estadoInicial . ' {
                        background-color: rgba(109, 160, 211, 0.3);
                    }
                    </style>');
        
                    //Elevador comienza recorrido con la primer persona 
                foreach ($elevator->ordenar as $key => $user) {
                    if ($elevator->acciones[$key] == $estadoInicial) {
                        echo ("Primer persona en abordar: " . $user ."<br>");
                    } else if ($elevator->acciones[$key] != 1) {
                        echo ($user.", subió al elevador.<br>");
                    } else {
                        echo ($user . " bajó. <br>");
                    }
                }
                print_r($user. " en posición: " . $first_position . " con destino a piso " . $first_destino . "<br>");
                while ($first_destino > $internalPosition) {
                    for ($i = $internalPosition; $i <= $max_floor; $i++) {
                        flush();
                        ob_flush();
                        sleep(2);
                            //Color de fondo de piso recorrido
                        echo ('<style>
                            #floor-' . $i . ' {
                                background-color: #6DA0D3;
                            }
                            </style>');
                            //Color de piso en mantenimiento
                        if ($i == $pisoMantenimiento) {
                            echo ('<style>
                            #floor-' . $i . ' {
                                background-color: #AF7D96;
                            }
                            </style>');
                        }
                    }
                    $elevator->up($first_destino, $internalPosition, $usuarios, $floor_target, $estadoInicial, $internalPos, $pisoMantenimiento);
                    $first_destino = $elevator->destino;
                    $internalPosition = $elevator->pos;
                }
                while ($first_destino < $internalPosition) {
                    for ($j = $internalPosition; $j >= $first_destino; $j--) {
                        flush();
                        ob_flush();
                        sleep(2);
                        echo ('<style>
                            #floor-' . $j . ' {
                                background-color: #6DA0D3;
                            }
                            </style>');
                        if ($j == $pisoMantenimiento) {
                            echo ('<style>
                                #floor-' . $i . ' {
                                    background-color: #AF7D96;
                                }
                                </style>');
                        }
                    }
                    $elevator->down($first_destino, $internalPosition, $usuarios, $floor_target, $estadoInicial, $pisoMantenimiento);
                    $first_destino = $elevator->destino;
                    $internalPosition = $elevator->pos;
                } ?>
                <h3 class="uk-heading-bullet">Orden de Personas que bajaron:
                    <?php  
                        $orden = 0;
                        foreach ($elevator->ordenar as $route => $user) {
                            $orden++;
                            print_r("<br>".$orden.".-"." ".$elevator->ordenar[$route]);
                    } ?>
                </h3>
            </div>
        </div>
        </div>
    </div>
</body>

</html>