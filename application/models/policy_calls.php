<?php
    /**
     * Created by IntelliJ IDEA.
     * User: jl-ro
     * Date: 5/30/2017
     * Time: 11:10 AM
     */

    /**
     * eBay Policy calls
     * 1. Create Policy
     * 2. Delete Policy
     * 3. Get Policies by marketplace
     * 4. Check if opted in
     * 5. Opt-in to policies
     */


    /**
     * 1. Create Policy
     * params:
     * $details[0] = $type -> fulfillment, payment, return
     * $details[1] = $name -> policy name
     *
     * for fulfillment
     * $handlingTime = $details[2]
     */

    function checkIfOptedIn()
    {
        global $baseUrl;
        global $accountUrl;
        global $userToken;

        $url = $baseUrl . $accountUrl . "/program/get_opted_in_programs";
        $method = "GET";
        $header = "Authorization: Bearer " . $userToken;

        ebayCall($url, $method, $header);
    }

    function optIntoPolicies()
    {
        global $baseUrl;
        global $accountUrl;
        global $userToken;

        $url = $baseUrl . $accountUrl . "/program/opt_in";
        $method = "POST";
        $header = "Authorization: Bearer " . $userToken . "\r\n" .
            "Content-Type: application/json";
        $content = array("programType" => "SELLING_POLICY_MANAGEMENT");

        ebayCall($url, $method, $header, json_encode($content));
    }


    function createPolicy(...$details)
    {
        global $baseUrl;
        global $accountUrl;
        global $userToken;
        $content = "";

        $url = $baseUrl . $accountUrl . "/" . strtolower($details[0]) . "_policy";
        $method="POST";
        $header = "Authorization: Bearer " . $userToken . "\r\n" .
                    "Content-Type: application/json";

        switch($details[0])
        {
            case "fulfillment":
                $content = array
                (
                  "name" => $details[1],
                  "marketplaceId" => "EBAY_US",
                  "categoryTypes" => array
                  (
                      array
                      (
                          "name" => "ALL_EXCLUDING_MOTORS_VEHICLES"
                      )
                  ),
                  "handlingTime" => array
                  (
                      "value" => $details[2],
                      "unit" => "DAY"
                  )
                );
                break;
            case "payment":
                $content = array
                (
                    "name" => $details[1],
                    "marketplaceId" => "EBAY_US",
                    "categoryTypes" => array
                    (
                        array
                        (
                            "name" => "ALL_EXCLUDING_MOTORS_VEHICLES"
                        )
                    ),
                    "paymentMethods" => array
                    (
                        array
                        (
                            "paymentMethodType" => "PERSONAL_CHECK"
                        )
                    )
                );
                break;
            case "return":
                $content = array
                (
                  "name" => $details[1],
                    "marketplaceId" => "EBAY_US",
                    "returnsAccepted" => false
                );
        };

        ebayCall($url, $method, $header, json_encode($content));
    }

    function getPolicies($type)
    {
        global $baseUrl;
        global $accountUrl;
        global $userToken;

        $url = $baseUrl . $accountUrl . "/" . strtolower($type) . "_policy?marketplace_id=EBAY_US";
        $method = "GET";
        $header = "Authorization: Bearer " . $userToken;

        $result = ebayCall($url, $method, $header);
        $result = json_decode($result, true);
        return $result;
    }

