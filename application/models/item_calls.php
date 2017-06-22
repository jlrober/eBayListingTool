<?php
    /**
     * Created by IntelliJ IDEA.
     * User: jl-ro
     * Date: 5/29/2017
     * Time: 8:58 PM
     */

    /**
     * eBay Item calls, includes the following calls
     * 1. Create Item
     * 2. Delete Item
     * 3. Get Item
     * 4. Get All Items
     */



    /**
     * 1. Create Item
     */

    /**
     * 1a. CREATE ITEM
     * @param: array containing the following keys
     *          "sku"
     *          "quantity"
     *          "condition" NEW, LIKE_NEW, USED_EXCELLENT, USED_VERY_GOOD, USED_GOOD, NEW_WITH_DEFECTS)("
     *          "title" (max 80 characters)
     *          "description"
     *          "brand"
     *          "type"
     *          "imageUrls"
     *          "mpn"
     *
     */

    $item = array
    (
        "sku" => "supercoolsku",
        "quantity" => "10",
        "condition" => "NEW",
        "title" => "Test Title",
        "description" => "Test Description",
        "brand" => "Test Brand",
        "type" => "TV Remote",
        "imageUrls" => array
        (
            "https://someplacecool.com/cool.jpg"
        ),
        "mpn" => "AEV421"
    );

    //$result = createItem($item);
    //var_dump($result);

    function createItem($item)
    {
        global $baseUrl;
        global $inventoryUrl;
        global $userToken;

        $url = $baseUrl . $inventoryUrl . "/inventory_item/" . $item["sku"];
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
                    "quantity" => intval($item["quantity"])
                )
            ),
            "condition" => $item["condition"],
            "product" => array
            (
                "title" => $item["title"],
                "description" => $item["description"],
                "imageUrls" => array
                (
                    $item["imageUrls"]
                )
            )
        );
        $content = json_encode($content);
        $result = ebayCall($url, $method, $header, $content);
        if($result === FALSE)
        {
            return false;
        }
        else
        {
            return $result;
        }
    }

    function getItems()
    {
        global $baseUrl;
        global $inventoryUrl;
        global $userToken;

        $url = $baseUrl . $inventoryUrl . "/inventory_item";
        $method = "GET";
        $header = "Authorization: Bearer " . $userToken;

        $result = ebayCall($url, $method, $header);
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

        $result = ebayCall($url, $method, $header);
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

        ebayCall($url, $method, $header);
    }