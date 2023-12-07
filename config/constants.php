<?php

return [
    'DOMINIO_MAIL_USERS' => env('DOMINIO_MAIL_USERS'),
    'DIAS_VENCIMIENTO' => 90, // dias de vigencia de contraseña
    "ESTADO" => [
        "CUENTA_INACTIVA" => 0,
        "CUENTA_ACTIVA" => 1,
        "CUENTA_INEXISTENTE" => 2,
        "PERSONAL_INEXISTENTE" => 3,
    ],
    "meses" => [
        "01" => 'ENERO',
        "02" => 'FEBRERO',
        "03" => 'MARZO',
        "04" => 'ABRIL',
        "05" => 'MAYO',
        "06" => 'JUNIO',
        "07" => 'JULIO',
        "08" => 'AGOSTO',
        "09" => 'SEPTIEMBRE',
        "10" => 'OCTUBRE',
        "11" => 'NOVIEMBRE',
        "12" => 'DICIEMBRE'
    ],
];
