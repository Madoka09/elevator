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

<body id="index-background">
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-left">
            <a class="uk-navbar-item uk-logo">Elevadores Misticos</a>
        </div>
    </nav>
    <div class="uk-container">
        <div class="uk-card uk-card-default uk-card-body uk-card-hover uk-align-center">
            <!-- Form for all values needed in the elevator-->
            <form method="post" action="./elevator_travel.php">
                <legend class="uk-legend">Valores de Inicio</legend>
                <br>
                <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" name="initial_state" placeholder="Planta Inicial" required>
                    </div>

                    <div class="uk-width-1-2@s">
                        <input class="uk-input" type="text" name="floor_maintenance" placeholder="Piso Deshabilitado ó en Mantenimiento"
                            pattern="((?=.*\d){1}" required />
                    </div>
                </div>
                <br>
                <legend class="uk-legend">Agregar Usuarios y Peticiones</legend>
                <br>
                <div class="addUser">
                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-witdh-1-3@s">
                            <input class="uk-input" type="text" value="<?php $_GET['user_1'] ?>" name="actual_floor_1"
                                placeholder="Piso Inicial del Usuario">
                        </div>

                        <div class="uk-width-1-3@s">
                            <input class="uk-input" type="text" name="user_1" placeholder="Nombre para la Persona">
                        </div>

                        <div class="uk-width-1-3@s">
                            <input class="uk-input" type="text" value="<?php $_GET['actual_floor_1'] ?>" name="floor_target_1"
                                placeholder="Piso Destino">
                        </div>

                        <div>
                            <a href="javascript:void(0);" uk-icon="icon: plus-circle; ratio: 2" class="plusButton"
                                title="Add field"></a>

                        </div>
                    </div>
                </div>

                <br>
                <button class="form-button uk-button uk-button-primary uk-align-center" type="submit">Enviar!</button>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var maxField = 30; //Input fields increment limitation
            var addButton = $('.plusButton'); //Add button selector
            var wrapper = $('.addUser'); //Input field wrapper
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function () {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(
                        '<div class="uk-grid-small" uk-grid><div class="uk-width-1-4@s"><input class="uk-input" type="text" value="<? $_GET['
                        user_ ' + x + '
                        '] ?>" name="actual_floor_' + x +
                        '" placeholder="Piso Actual"></div><div class="uk-width-1-4@s"><input class="uk-input" type="text" name="user_' +
                        x +
                        '" placeholder="Nombre Usuario"></div><div class="uk-width-1-3@s"><input class="uk-input" type="text" value="<? $_GET['
                        actual_floor_ ' + x + '
                        '] ?>" name="floor_target_' + x +
                        '" placeholder="Destino"></div><a href="javascript:void(0);" class="delButton" uk-icon="icon: minus-circle; ratio: 2"></a></div>'
                    );
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.delButton', function (e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>
</body>

</html>