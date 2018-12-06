<?php
class Elevador
{
    public $estadoInicial = 1;
    public $auxiliar = [];
    public $ordenar = [];
    public $acciones = [];
    public $primerInit = 0;
    public $internalPos = 0;
    public $destino = 0;

    public function firstStop($estadoInicial, $usuarios, $floor_target)
    {
        //Buscar usuarios iguales
        foreach($usuarios as $key => $user) {
            if($estadoInicial == $key) {
                array_push($this -> acciones, 1);
                array_push($this -> ordenar, $user);
                $this -> primerInit = 1; 
                return $this -> ordenar;
            } 
        }    
        if($this -> primerInit == 0) {
            foreach($usuarios as $key => $user) {
                $key = array_search($user, $usuarios);
                $difference = $estadoInicial - $key;
                if($difference < 0) {
                    $difference *= -1;
                    $this -> auxiliar[$key] = $difference;
                }
            }
            //Mover a posicion mas cercana
            $min = min($this -> auxiliar);
            $user_key = array_search($min, $this -> auxiliar);
    
            //Buscar usuario mas cercano
            if($user_key  > $estadoInicial) {
                while($estadoInicial < $user_key) {
                    $estadoInicial++;
                }
                array_push($this -> acciones, $estadoInicial);
                array_push($this -> ordenar, $user);
                return $estadoInicial+1;
            }
        }
    }

    public function up($first_destino, $internalPosition, $usuarios, $floor_target, $estadoInicial, $pisoMantenimiento)
    {
        //Elevador subiendo
        $this -> pos = $estadoInicial;
        for($i=$internalPosition; $i <= $first_destino; $i++) {
            foreach($floor_target as $key => $des) {
                if($i == $key && $key != $estadoInicial && $des > $i) {
                    //Seleccionar piso que no esté en mantenimiento
                    if ($des == $pisoMantenimiento) {
                        $floor_target[$key] = null;
                    } else {
                    echo ($usuarios[$key]." subió en el piso: ".$i.", irá a: ".$des."<br>");
                    array_push($this -> ordenar, $usuarios[$key]);
                    }
                }
                if($i == $des && $des != $estadoInicial && $i != $pisoMantenimiento) {
                    echo ($usuarios[$key]." bajó en el piso: ".$i."<br>");
                }
            }
            $this -> pos = $i;
        }
        $this -> destino = max($floor_target);
        return $this -> pos;
    }
    
    public function down($first_destino, $internalPosition, $usuarios, $floor_target, $estadoInicial, $pisoMantenimiento)
    {
        //Elevador Bajando
        $this -> pos = $estadoInicial;
        for($j=$internalPosition; $j >= $first_destino; $j--) {
            foreach($floor_target as $key => $des) {
                if($j == $key && $key != $estadoInicial && $des < $j) {
                    //Seleccionar un piso que no esté en mantenimiento
                    if ($des == $pisoMantenimiento) {
                        $floor_target[$key] = null;
                    } else {
                    echo ($usuarios[$key]." subió en el piso: ".$j." irá a: ".$des."<br>");
                    array_push($this -> ordenar, $usuarios[$key]);
                    }
                }
                if($j == $des && $des == $estadoInicial && $j != $pisoMantenimiento) {
                    echo ($usuarios[$key]." bajó en el piso: ".$j."<br>");
                }
            }
            $this -> pos = $j;
        }
        $this -> destino = min($floor_target);
        return $this -> pos;
    }
}