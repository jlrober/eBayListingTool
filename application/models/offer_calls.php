<?php
    /**
     * Created by IntelliJ IDEA.
     * User: jl-ro
     * Date: 5/30/2017
     * Time: 12:09 PM
     */

    /**
     * eBay calls to create listings.
     * You first need to make an offer, then publish an offer
     *
     * calls
     * 1. Create Offer
     * 2. Delete Offer
     * 3. Get Offers (for specific sku)
     * 4. Publish offer
     * 5. Update offer
     */

    function createOffer($sku, $quantity, $category, $description, $price)
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
            "availableQuantity" => $quantity,
            "categoryId" => $category,
            "listingDescription" => $description,
            "listingPolicies" => array
            (
                "fulfillmentPolicyId" => $_COOKIE["fulfillment"],
                "paymentPolicyId" => $_COOKIE["payment"],
                "returnPolicyId" => $_COOKIE["return"]
            ),
            "pricingSummary" => array
            (
                "currency" => "USD",
                "value" => $price
            )
        );

        $result = ebayCall($url, $method, $header, json_encode($content));
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

        $result = ebayCall($url, $method, $header);
        if($result != false)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }