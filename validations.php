<?php

//funtion for checking if input is emoty or not...
function isEmpty($input)
{
    return empty($input);
}

//function for checking if input contains digits or not...
function containsDigits($input)
{
    if(preg_match("/[^a-zA-Z-]/",$input)) 
    {
        return false;
    } 
    else
    { 
        return true;
    }
}

//function for checking if input contains special characters or not...
function containsSpecialCharacters($input)
{
    if(preg_match('/[!@#$%^&*(),.?":{}|<>]/', $input))
    {
        return false;
    } 
    else
    { 
        return true;
    }
}

//function for checking if price is valid or not i.e. according to XXX.XX$ or XXXX.XX$ format...
function validPrice($input)
{
    if(preg_match('/^\d{3,4}\.\d{2}\$$/', $input))
    {
        return false;
    } 
    else
    { 
        return true;
    }
}

//function for checking if quantity is negative or not...
function validQuantity($input)
{
    if(preg_match('/^(?!-)\d+$/', $input))
    {
        return false;
    } 
    else
    { 
        return true;
    }
}

?>