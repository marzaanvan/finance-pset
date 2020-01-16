<?php
//configuration

require("../includes/config.php");



if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $stock = lookup($_POST["symbol"]);

    if($stock)
    {
       render("quote_price.php",$stock);
    }
    else {

      apologize("Can't lookup for symbol");
    }

}

else if($_SERVER['REQUEST_METHOD'] == "GET")
{
    render("quote_form.php");
}

?>
