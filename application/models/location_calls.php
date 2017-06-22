<?php
    /**
     * Created by IntelliJ IDEA.
     * User: jl-ro
     * Date: 5/30/2017
     * Time: 11:10 AM
     */
    $location = array();
    $location["locationKey"] = "testLocation";
    $location["addressLine1"] = "15664 S Leland Rd.";
    $location["city"] = "Beavercreek";
    $location["stateOrProvince"] = "OR";
    $location["postalCode"] = "97004";
    $location["country"] = "US";
    $location["name"] = "Test Location";
    $location["status"] = "ENABLED";
    /**
     * params:
     * locationKey
     * addressLine1
     * city
     * stateOrProvince
     * postaleCode
     * country
     * //locationInstructions
     * name
     * status
     */

    function createLocation($location)
    {
        global $userToken;
        global $baseUrl;
        global $inventoryUrl;

        $url = $baseUrl . $inventoryUrl . "/location/" . $location["locationKey"];
        $method = "POST";
        $header =
            "Content-Type: application/json\r\n" .
            "Authorization: Bearer " . $userToken;
        $content = array
        (
            "location" => array
            (
                "address" => array
                (
                    "addressLine1" => $location["addressLine1"],
                    "city" => $location["city"],
                    "stateOrProvince" => $location["stateOrProvince"],
                    "postalCode" => $location["postalCode"],
                    "country" => $location["country"]
                )
            ),
            "locationInstructions" => "Items ship from here.",
            "name" => $location["name"],
            "merchantLocationStatus" => "ENABLED",
            "locationTypes" => array
            (
                "WAREHOUSE"
            )
        );
        $content = json_encode($content);

        ebayCall($url, $method, $header, $content);
    }

    function deleteLocation($locationKey)
    {
        global $baseUrl;
        global $inventoryUrl;
        global $userToken;

        $url = $baseUrl . $inventoryUrl . "/location/" . $locationKey;
        $method = "DELETE";
        $header = "Authorization: Bearer " . $userToken;

        ebayCall($url, $method, $header);
    }

    function getLocations()
    {
        global $baseUrl;
        global $inventoryUrl;
        global $userToken;

        $url = $baseUrl . $inventoryUrl . "/location";
        $method = "GET";
        $header = "Authorization: Bearer " . $userToken;

        ebayCall($url, $method, $header);
    }
