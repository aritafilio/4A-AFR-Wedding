<?php

require_once "controller/login.controller.php";
require_once "model/login.model.php";
require_once "controller/plantilla.controller.php";

$Inicio = new ControladorPlantilla();

$Inicio -> ctrTraerPlantilla();