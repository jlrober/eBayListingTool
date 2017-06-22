<?php

    /**
     * Created by IntelliJ IDEA.
     * User: jl-ro
     * Date: 5/29/2017
     * Time: 6:56 PM
     */

    Class Ebay_calls extends CI_Model
    {
        Public function __construct()
        {
            parent::__construct();
        }

        function ebayCall(...$details)
        {
            $url = $details[0];
            $method = $details[1];
            $header = $details[2];
            if(isset($details[3]))
            {
                $content = $details[3];
                $options = array
                (
                    "http" => array
                    (
                        'method' => $method,
                        'header' => $header,
                        'content' => $content
                    )
                );
            }
            else
            {
                $options = array
                (
                    "http" => array
                    (
                        'method' => $method,
                        'header' => $header
                    )
                );
            }
            $context = stream_context_create($options);
            try {
                $result = file_get_contents($url, false, $context);
            } catch(Exception $e) {
                echo $e->getMessage();
                echo "exception was caught";
            }
            if ($result === FALSE)
            {
                return false;
            }
            else
            {
                return $result;
            }
        }

        function createItem($item)
        {
            global $baseUrl;
            global $inventoryUrl;
            global $userToken;

            $url = $baseUrl . $inventoryUrl . "/inventory_item/" . $item["Sku"];
            $method = "PUT";
            $header = "Content-Language: en-US" . "\r\n" .
                "Authorization: Bearer " . $userToken . "\r\n" .
                "Content-Type: application/json";
            $content = array
            (
                "availability" => array
                (
                    "shipToLocationAvailability" => array
                    (
                        "quantity" => intval($item["Quantity"])
                    )
                ),
                "condition" => strtoupper($item["Condition"]),
                "product" => array
                (
                    "title" => substr($item["Title"], 0, 79),
                    "description" => $item["Description"],
                    "brand" => $item["Brand"],
                    "type" => $item["Type"],
                    "mpn" => $item["Model"],
                    "upc" => array("Does not apply"),
                    "imageUrls" => array
                    (
                        $item["ImageUrls"]
                    )
                )
            );

            $content = json_encode($content);
            $result = $this->ebayCall($url, $method, $header, $content);
            if($result === FALSE)
            {
                return false;
            }
            else
            {
                return $result;
            }
        }

        function getItems($offset, $limit)
        {
            global $userToken;
            global $inventoryUrl;
            global $baseUrl;

            $url = $baseUrl . $inventoryUrl . "/inventory_item?offset=" . $offset . "&limit=" . $limit;
            $method = "GET";
            $header = "Authorization: Bearer " . $userToken;

            $result = $this->ebayCall($url, $method, $header);
            return $result;
        }

        function getItem($sku)
        {
            global $baseUrl;
            global $inventoryUrl;
            global $userToken;

            $url = $baseUrl . $inventoryUrl . "/inventory_item/" . $sku;
            $method = "GET";
            $header = "Authorization: Bearer " . $userToken;

            $result = $this->ebayCall($url, $method, $header);
            return $result;
        }

        function deleteItem($sku)
        {
            global $baseUrl;
            global $inventoryUrl;
            global $userToken;

            $url = $baseUrl . $inventoryUrl . "/inventory_item/" . $sku;
            $method = "DELETE";
            $header = "Authorization: Bearer " . $userToken;

            $result = $this->ebayCall($url, $method, $header);
            return $result;
        }

        function createOffer($sku, $category, $price)
        {
            global $baseUrl;
            global $inventoryUrl;
            global $userToken;

            $url = $baseUrl . $inventoryUrl . "/offer";
            $method = "POST";
            $header = "Authorization: Bearer " . $userToken . "\r\n" .
                "Content-Language: en-US" . "\r\n" .
                "Content-Type: application/json";
            $content = array
            (
                "sku" => $sku,
                "marketplaceId" => "EBAY_US",
                "format" => "FIXED_PRICE",
                "categoryId" => $category,
                "merchantLocationKey" => get_cookie("location"),
                "listingPolicies" => array
                (
                    "fulfillmentPolicyId" => $_COOKIE["fulfillment"],
                    "paymentPolicyId" => $_COOKIE["payment"],
                    "returnPolicyId" => $_COOKIE["return"]
                ),
                "pricingSummary" => array
                (
                    "price" => array
                    (
                        "currency" => "USD",
                        "value" => strval($price)
                    )
                )
            );

            $result = $this->ebayCall($url, $method, $header, json_encode($content));
            if($result != false)
            {
                return $result;
            }
            else
            {
                return false;
            }
        }

        function getOffers($sku)
        {
            global $baseUrl;
            global $inventoryUrl;
            global $userToken;

            $url = $baseUrl . $inventoryUrl ."/offer?sku=" . $sku;
            $method = "GET";
            $header = "Authorization: Bearer " . $userToken;

            $result = $this->ebayCall($url, $method, $header);
            if($result != false)
            {
                return $result;
            }
            else
            {
                return false;
            }
        }

        function checkIfOptedIn()
        {
            global $baseUrl;
            global $accountUrl;
            global $userToken;

            $url = $baseUrl . $accountUrl . "/program/get_opted_in_programs";
            $method = "GET";
            $header = "Authorization: Bearer " . $userToken;

            $result = $this->ebayCall($url, $method, $header);
            if($result === FALSE) {
                return true;
            } else {
                return false;
            }
        }

        function getPolicies($type)
        {
            global $baseUrl;
            global $accountUrl;
            global $userToken;

            $url = $baseUrl . $accountUrl . "/" . strtolower($type) . "_policy?marketplace_id=EBAY_US";
            $method = "GET";
            $header = "Authorization: Bearer " . $userToken;

            $result = $this->ebayCall($url, $method, $header);
            $result = json_decode($result, true);
            return $result;
        }

        function optIntoPolicies() {
            global $userToken;

            $url = "https://api.sandbox.ebay.com/sell/account/v1/program/opt_in";
            $method = "POST";
            $header = "Content-Language: en-US" . "\r\n" .
                "Authorization: Bearer " . $userToken . "\r\n" .
                "Content-Type: application/json";
            $content = array("programType" => "SELLING_POLICY_MANAGEMENT");
            $content = json_encode($content);
            $result = $this->ebayCall($url, $method, $header, $content);
            return $result;
        }

        function publishOffer($offerId) {
            global $baseUrl;
            global $inventoryUrl;
            global $userToken;

            $url = $baseUrl . $inventoryUrl . "/offer/" . $offerId . "/publish";
            $method = "POST";
            $header = "Authorization: Bearer " . $userToken;

            $result = $this->ebayCall($url, $method, $header);
            return $result;
        }

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

            $result = $this->ebayCall($url, $method, $header, $content);
            if($result === FALSE) {
                return false;
            } else {
                return true;
            }
        }

        function getLocations()
        {
            global $baseUrl;
            global $inventoryUrl;
            global $userToken;

            $url = $baseUrl . $inventoryUrl . "/location";
            $method = "GET";
            $header = "Authorization: Bearer " . $userToken;

            $result = $this->ebayCall($url, $method, $header);
            return $result;
        }
    }

    /*
        $item = array
        (
            "quantity" => 2,
            "condition" => "NEW",
            "title" => "This is a test title",
            "description" => "This is the coolest thing you could ever own, no joke.",
            "brand" => "Brand",
            "type" => "TV Remote",
            "mpn" => "aabbcc112233",
            "sku" => "someCoolSku29",
            "imageUrls" => array("http://i.ebayimg.com/images/i/182196556219-0-1/s-l1000.jpg"),
        );
    */



