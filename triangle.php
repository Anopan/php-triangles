<?php
/*
    Author:     Anopan Kandiah
    Created:    06/04/2020
    Modified:   15/04/2020
*/

trait fileSave
{
    public function saveToFile($side1, $side2, $side3, $triangleTypeText)
    {
        date_default_timezone_set("Australia/Perth");
        $todayDate = date("d/m/Y H:i:s");

        $triangleFile = fopen("triangle_sides.txt", "w+");

        $saveText = "Date: " . $todayDate . "\n\nSide 1: " . $side1 . "\nSide 2: " . $side2 . "\nSide 3: " . $side3 . "\n\n" . $triangleTypeText;

        fwrite($triangleFile, $saveText);

        fclose($triangleFile);
    }
}

class Triangle
{
    private $side1;
    private $side2;
    private $side3;
    private $triangleType;
    private $triangleTypeText; 

    public function __construct()
    {
        $this->side1 = null;
        $this->side2 = null;
        $this->side3 = null;
        $this->triangleType = null;
        $this->triangleTypeText = null;
    }

    public function set_side1($side1)
    {
        $this->side1 = $side1;
    }

    public function get_side1()
    {
        return($this->side1);
    }

    public function set_side2($side2)
    {
        $this->side2 = $side2;
    }

    public function get_side2()
    {
        return($this->side2);
    }

    public function set_side3($side3)
    {
        $this->side3 = $side3;
    }

    public function get_side3()
    {
        return($this->side3);
    }

    private function calculateTriangle()
    {
        if($this->side1 == $this->side2 && $this->side2 == $this->side3)
        {
                //Equilateral
            $this->triangleType = 1;
        }
        else if ($this->side1 == $this->side2 || $this->side1 == $this->side3 || $this->side2 == $this->side3)
        {	
                //Isosceles
            $this->triangleType = 2;
        }	
        else if ($this->side1 != $this->side2 && $this->side2 != $this->side3)
        {
                //Scalene
            $this->triangleType = 3;
        }
        else
        {
                //No triangle
            $this->triangleType = 0;
        }
    }

    public function stateTriangle()
    {
        $this->calculateTriangle();

        switch($this->triangleType) 
        {
        case 1:
            echo '<p>You have made a <b>Equilateral</b> triangle.</p>';
            $this->triangleTypeText = "You have made a Equilateral triangle.";
        break;
        case 2:
            echo '<p>You have made a <b>Isosceles</b> triangle.</p>';
            $this->triangleTypeText = "You have made a Isosceles triangle.";
        break;
        case 3:
            echo '<p>You have made a <b>Scalene</b> triangle.</p>';
            $this->triangleTypeText = "You have made a Scalene triangle.";
        break;    
        default:
            echo '<p>You have not made a triangle.</p>';
            $this->triangleTypeText = "You have not made a triangle.";
        }

        return($this->triangleTypeText);
    }

    use fileSave;
}

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

$triangle = new Triangle();

$triangle->set_side1($_POST["side1"]);
$triangle->set_side2($_POST["side2"]);
$triangle->set_side3($_POST["side3"]);

if(validateInput($triangle->get_side1(),$triangle->get_side2(),$triangle->get_side3()))
{
    $triangleTypeText = $triangle->stateTriangle();
    $triangle->saveToFile($triangle->get_side1(),$triangle->get_side2(),$triangle->get_side3(), $triangleTypeText);
}
else
{
    echo '<p>Invalid input.</p>';
}

?>