<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/9/17
 * Time: 7:47 AM
 */

require_once __DIR__.'/../vendor/autoload.php';
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_GET['q'])) {
        $patients = \Hudutech\Controller\PatientController::searchNotInQueue($_GET['q']);
//print_r($patients);

        if (sizeof($patients) == 0) {
            print_r(json_encode(
                array(
                    "statusCode" => 204,
                    "message" => "No results found!"
                )
            ));
        }
        if (sizeof($patients) > 0) {
            print_r(json_encode(
                array(
                    "statusCode" => 200,
                    "data" => $patients
                )
            ));
        }
    }
}
else{

    print_r(json_encode(
        array(
            "statusCode" => 204,
            "message" => "No results found!"
        )
    ));
}
