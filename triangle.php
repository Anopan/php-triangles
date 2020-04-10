<?php
/*
    Author:     Anopan Kandiah
    Created:    06/04/2020
    Modified:   10/04/2020
*/

function validateInput($side1, $side2, $side3)
{
    $valid = false;

    if(!empty($side1) && !empty($side2) && !empty($side3))
    {
        $valid = true;

        if(!preg_match("/^[a-zA-Z ]*$/",$side1) && !preg_match("/^[a-zA-Z ]*$/",$side2) && !preg_match("/^[a-zA-Z ]*$/",$side3))
        {
            $valid = true;
        }
        else
        {
            $valid = false;
        }
    }

    return($valid);
}

function calculateTriangle($side1, $side2, $side3)
{
    $triangleType = 0;

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
    break;
    case 2:
        echo '<p>You have made a <b>Isosceles</b> triangle.</p>';
    break;
    case 3:
        echo '<p>You have made a <b>Scalene</b> triangle.</p>';
    break;    
    default:
        echo '<p>You have not made a triangle.</p>';
    }
}

$side1 = $_POST["side1"];
$side2 = $_POST["side2"];
$side3 = $_POST["side3"];
$triangleFile = fopen("triangle_sides.txt", "w+")

if(validateInput($side1, $side2, $side3))
{
    stateTriangle(calculateTriangle($side1, $side2, $side3));

}
else
{
    echo '<p>Invalid input.</p>';
}

?>