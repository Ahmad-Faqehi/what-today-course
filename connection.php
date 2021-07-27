<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_database = "summer";

$conn = new PDO('mysql:host='.$db_host.';dbname='.$db_database .';charset=utf8mb4', ''.$db_user .'', ''.$db_pass .'', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);

date_default_timezone_set("Asia/Riyadh");

function numToDay($num){

    $day = "";
    
    switch($num){

        case 1:
        $day = "Sunday";
        break;

        case 2:
        $day = "Monday";
        break;

        case 3:
        $day = "Tuesday";
        break;

        case 4:
        $day = "Wednesday";
        break;

        case 5:
        $day = "Thursday";
        break;

        case 6:
        $day = "Friday";
        break;

        case 7:
        $day = "Saturday";
        break;

        default :
        $day = "NULL";

    }
    return $day;
}

function dayToNum($day){
    $num = 0;
    switch($day){

    case "Sunday":
        $num = 1;
        break;

    case "Monday":
        $num = 2;
        break;

    case "Tuesday":
        $num = 3;
        break;

    case "Wednesday":
        $num = 4;
        break;


    case "Thursday":
        $num = 5;
        break;

    case "Friday":
        $num = 6;
        break;

    case "Saturday":
        $num = 7;
        break;

        default :
        $num = 0;
    }
return $num;
}

