<?php

function lookup($symbol)
    {
        //reject symbols starting with ^
        if (preg_match("/^\^/", $symbol))
        {
            return false;
        }

        // reject symbols that contain commas
        if (preg_match("/,/", $symbol))
        {
            return false;
        }


        $API_KEY="EQB9SNQKXNF32GVF";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, ("https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=".$symbol."&interval=1min&apikey=" . $API_KEY."&datatype=csv"));
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        
        //var_dump($server_output);
		//echo $server_output["Error Message"];
        //if (!empty($server_output["Error Message"]))
        	//return false;


        //tokenising $server_output on ',' and returning price and stock as a asscoiative array

        $data = strtok($server_output,"\n");
        $data = strtok("\n");

//        var_dump($data);

        $foo = strtok($data,",");

  //      var_dump($foo);
        
        $count = 1;
        while($foo !== false){
            echo $foo;
            if($count == 5)
                break;
            $foo = strtok(",");
            $count++;
        }

    //    var_dump($foo);

        return [
            "symbol" => strtoupper($symbol),
            "price" =>  number_format(floatval($foo),2)
        ];
}

$sym = readline("Stock Symbol := ");
$stock = lookup($sym);



if($stock == false){
	echo "Error Occured : Try again !";
}
	
var_dump($stock);

extract($stock);

echo "symbol := ".$symbol."\n";
echo "Price := ".$price. "\n";

  
    
  ?>
