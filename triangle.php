<?php
/*
    Author:     Anopan Kandiah
    Created:    06/04/2020
    Modified:   11/04/2020
*/

function validateInput($side1, $side2, $side3)
{
    $valid = false;

    if(!empty($side1) && !empty($side2) && !empty($side3))
    {
        if(!filter_var($side1, FILTER_VALIDATE_INT) === false && !filter_var($side2, FILTER_VALIDATE_INT) === false && !filter_var($side3, FILTER_VALIDATE_INT) === false)
        {
            if($side1 > 0 && $side2 > 0 && $side3 > 0)
            {
                $valid = true;
            }
        }
    }

    return($valid);
}

function calculateTriangle($side1, $side2, $side3)
{
    if($side1 == $side2 && $side2 == $side3)
    {
            //Equilateral
        $triangleType = 1;
    }
    else if ($side1 == $side2 || $side1 == $side3 || $side2 == $side3)
    {	
            //Isosceles
	    $triangleType = 2;
    }	
    else if ($side1 != $side2 && $side2 != $side3)
    {
            //Scalene
        $triangleType = 3;
    }
    else
    {
            //No triangle
        $triangleType = 0;
    }

    return($triangleType);
}

function stateTriangle($triangleType)
{
    switch($triangleType) 
    {
    case 1:
        echo '<p>You have made a <b>Equilateral</b> triangle.</p>';
        $triangleTypeText = "You have made a Equilateral triangle.";
    break;
    case 2:
        echo '<p>You have made a <b>Isosceles</b> triangle.</p>';
        $triangleTypeText = "You have made a Isosceles triangle.";
    break;
    case 3:
        echo '<p>You have made a <b>Scalene</b> triangle.</p>';
        $triangleTypeText = "You have made a Scalene triangle.";
    break;    
    default:
        echo '<p>You have not made a triangle.</p>';
        $triangleTypeText = "You have not made a triangle.";
    }

    return($triangleTypeText);
}

function saveToFile($side1, $side2, $side3, $triangleTypeText)
{
    date_default_timezone_set("Australia/Perth");
    $todayDate = date("d/m/Y H:i:s");

    $triangleFile = fopen("triangle_sides.txt", "w+");

    $saveText = "Date: " . $todayDate . "\n\nSide 1: " . $side1 . "\nSide 2: " . $side2 . "\nSide 3: " . $side3 . "\n\n" . $triangleTypeText;

    fwrite($triangleFile, $saveText);

    fclose($triangleFile);
}

$side1 = $_POST["side1"];
$side2 = $_POST["side2"];
$side3 = $_POST["side3"];

if(validateInput($side1, $side2, $side3))
{
    $triangleTypeText = stateTriangle(calculateTriangle($side1, $side2, $side3));
    saveToFile($side1, $side2, $side3, $triangleTypeText);
}
else
{
    echo '<p>Invalid input.</p>';
}

?>