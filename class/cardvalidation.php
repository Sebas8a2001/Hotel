<?php

$number= $_POST['creditcardnumber'];

function validatecard($number)
 {
    global $type;
	
	$cardtype = array(
			'visa'			=>	"/^4\d{3}-?\d{4}-?\d{4}-?\d{4}$/",
			'mastercard'	=>	"/^5[1-5]\d{2}-?\d{4}-?\d{4}-?\d{4}$/",
			'discover'		=>	"/^6011-?\d{4}-?\d{4}-?\d{4}$/",
			'amex'			=>	"/^3[4,7]\d{13}$/",
			'diners'		=>	"/^3[0,6,8]\d{12}$/",
			'bankcard'		=>	"/^5610-?\d{4}-?\d{4}-?\d{4}$/",
			'jcb'			=>	"/^[3088|3096|3112|3158|3337|3528]\d{12}$/",
			'enroute'		=>	"/^[2014|2149]\d{11}$/",
			'switch'		=>	"/^[4903|4911|4936|5641|6333|6759|6334|6767]\d{12}$/"
		);

    if (preg_match($cardtype['visa'],$number))
    {
	$type= "VISA";
        return 'visa';
	
    }
    else if (preg_match($cardtype['mastercard'],$number))
    {
	$type= "MASTERCARD";
        return 'mastercard';
    }
    else if (preg_match($cardtype['amex'],$number))
    {
	$type= "AMERICAN EXPRESS";
        return 'amex';
	
    }
    else if (preg_match($cardtype['diners'],$number))
    {
	$type= "DINERS CLUB";
        return 'diners';
    }
    else
    {
        return false;
    } 
 }

validatecard($number);

if (validatecard($number) !== false)
{
echo "$type";
}
elseif ($number == "")
{
echo "";
}
else
{
echo "ERROR! TARJETA DE CREDITO INVALIDA";
}

?>