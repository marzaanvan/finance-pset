<?php

    // configuration
    require("../includes/config.php"); 


/*
    //stock positions of users
    $positions = [];

    $rows = CS50::query("SELECT * FROM portfolios WHERE user_id = ?",$_SESSION["id"]);
    
    if( count($rows) > 0 )

        foreach($rows as $row){
            $stock = lookup($row["symbol"]);
            if($stock !== false){

                 $positions[] = [
                     "name" => $stock["name"];
                     "price" => $stock["price"];
                     "shares" => $row["shares"];
                     "symbol" => $row["symbol"];
                 ];
            }
        }

    $cash = cs50::query("SELECT cash FROM users WHERE id = ?",$_SESSION["id"]);

    $cash = $cash[0];

*/

/*
$positions = [];

$rows  = cs50::query("SELECT * FROM users WHERE id = ?",$_SESSION["id"]);

foreach($rows as $row){
    $stock = lookup($row["symbol"]);
    if ($stock !== false)
    {
        $postings[] = [
            "name" => $stock["name"],
            "price" => $stock["price"],
            "shares" => $row["shares"],
            "symbol" => $row["symbol"]
        ];
    }
}
*/


    //echo "Total Count of Rows Returned := ".$count;



   // echo "session := ".$_SESSION["id"]. "\n";



    // render portfolio
    render("portfolio.php", ["title" => "Portfolio"]);

    //


?>
