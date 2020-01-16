<?php

    /**
     * helpers.php
     *
     * Computer Science 50
     * Problem Set 7
     *
     * Helper functions.
     */

    require_once("config.php");

    /**
     * Apologizes to user with message.
     */
    function apologize($message)
    {
        render("apology.php", ["message" => $message]);
    }

    /**
     * Facilitates debugging by dumping contents of argument(s)
     * to browser.
     */
    function dump()
    {
        $arguments = func_get_args();
        require("../views/dump.php");
        exit;
    }

    /**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */
    function logout()
    {
        // unset any session variables
        $_SESSION = [];

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
    }

    /**
     * Returns a stock by symbol (case-insensitively) else false if not found.
     */

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
        curl_setopt($ch, CURLOPT_URL, ("https://www.alphavantage.co/query function=TIME_SERIES_INTRADAY&symbol=".$symbol."&interval=1min&apikey=" . $API_KEY."&datatype=csv"));
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        /*
        var_dump($server_output);
		echo $server_output["Error Message"];
        if (!empty($server_output["Error Message"]))
        	return false;
		*/
		
        //tokenising $server_output on ',' and returning price and stock as a asscoiative array


        $data = strtok($server_output,"\n");
        $data = strtok("\n");

		//var_dump($data);

        $foo = strtok($data,",");

  		//var_dump($foo);
        
        $count = 1;
        while($foo !== false){
            //echo $foo;
            if($count == 5)
                break;
            $foo = strtok(",");
            $count++;
        }

    //    var_dump($foo);

        return [
            "symbol" => strtoupper($symbol),
            "price" =>  number_format(float($foo),2)
        ];
}

    /**
     * Redirects user to location, which can be a URL or
     * a relative path on the local host.
     *
     * http://stackoverflow.com/a/25643550/5156190
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     */
    function redirect($location)
    {
        if (headers_sent($file, $line))
        {
            trigger_error("HTTP headers already sent at {$file}:{$line}", E_USER_ERROR);
        }
        header("Location: {$location}");
        exit;
    }

    /**
     * Renders view, passing in values.
     */
    function render($view, $values = [])
    {
        // if view exists, render it
        if (file_exists("../views/{$view}"))
        {
            // extract variables into local scope
            extract($values);

            // render view (between header and footer)
            require("../views/header.php");
            require("../views/{$view}");
            require("../views/footer.php");
            exit;
        }

        // else err
        else
        {
            trigger_error("Invalid view: {$view}", E_USER_ERROR);
        }
    }

?>
