<?php
    /**
     * Created by IntelliJ IDEA.
     * User: jl-ro
     * Date: 5/29/2017
     * Time: 6:42 PM
     */

    /**
     *  Get User Token
     */

    global $userToken;

    if(isset($_COOKIE["user"]))
    {
        $userToken = $_COOKIE["user"];
    }
    else if(isset($_GET['code']))
    {
        $authCode = $_GET["code"];
        $result = getUserToken($authCode);

        if($result)
        {
            $userToken = $result;
        }
        else
        {
            //TODO: error receiving user token
        }
    }
    else
    {
        //header('location: ' . $ebayLoginPage);
    }

    setcookie("user", $userToken, time() + 3600);

    //Exchange auth code for token, return token string
    function getUserToken()
    {
        global $baseUrl;
        global $authCode;
        global $getTokenUrl;
        require_once "/../../secure/ebayCerts.php";
        global $sandboxClientId;
        global $sandboxClientSecret;
        global $sandboxRuName;

        $url = $baseUrl . $getTokenUrl;
        $options = array
        (
            'http' => array
            (
                'method' => 'POST',
                'header' =>  "Authorization: Basic " . base64_encode($sandboxClientId . ":" . $sandboxClientSecret) . "\r\n" .
                            "Content-Type: application/x-www-form-urlencoded",
                'content' => "grant_type=authorization_code&code=" . $authCode . "&redirect_uri=$sandboxRuName"
            )
        );

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if($result != false)
        {
            $token = json_decode($result, true);
            $token = $token["access_token"];
            return $token;
        }
        else
        {
            var_dump($result);
            return false;
        }
    }