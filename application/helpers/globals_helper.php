<?php
    /**
     * Created by IntelliJ IDEA.
     * User: jl-ro
     * Date: 5/29/2017
     * Time: 9:06 PM
     */

    //Set environment: 0 for sandbox, 1 for production
    $environment = 0;
    $clientId = "";
    $clientSecret = "";
    $ruName = "";
    $authCode = "";
    $manualToken = "v^1.1#i^1#p^3#I^3#r^0#f^0#t^H4sIAAAAAAAAAOVXa2wURRzvtdc2FSgGEZCAnAshqWXvZl/32PTOXmkLLbQ9euWppOxjtl26t3vu7LZdv3BURTBIDBFi0GiBEB/EQIIfUEJCNBrEd0LAGE0lomBIMCqEBBLj7PV1rRH64EMT98NuZub//P1//9kZkCkqeXzHyh23ZniK83szIJPv8VDTQElRYXlpQf78wjyQI+DpzSzJeHsKrlYgIaWl+WaI0oaOoK87pemIz05GCdvUeUNAKuJ1IQURb0l8Mt6wmqf9gE+bhmVIhkb46qqjBM2GaVYOs0ARKYljWTyrD9psMaKEKNAKHZEVvAwjohLC6wjZsE5HlqBbWB9QIRIESUC3AI6nGZ5l/CwV2kT41kETqYaORfyAiGXD5bO6Zk6sdw9VQAiaFjZCxOritcmmeF11TWNLRSDHVmwAh6QlWDYaOVpuyNC3TtBseHc3KCvNJ21JgggRgVi/h5FG+fhgMBMIPws1lCHHwIjAMJIUkhj5vkBZa5gpwbp7HO6MKpNKVpSHuqVazr0QxWiIW6FkDYwasYm6ap/7WWMLmqqo0IwSNVXxjWuTNc2EL5lImEanKkPZzZRiGA6wTIQjYhZEGEJotiI7DU3ZfaXUDjjgsd/sAN6jXC43dFl10UO+RsOqgjh8OBokKgckLNSkN5lxxXJDy5ULDYIJwpvc6vaX07badbfAMIUR8WWH9y7FIDeG2XC/2CEGaRoIQGHZIMTwwUF2uL0+GYbE3CLFE4mAGwsUBYdMCWYHtNKaIEFSwvDaKWiqMs9wCs2EFUjKwYhCshFFIUVODpKUAiGAUBSlSPh/SRTLMlXRtuAQWUYvZLONEknJSMOEoamSQ4wWye5CA9ToRlGi3bLSfCDQ1dXl72L8htkWoAGgAhsaVieldpgSiCFZ9d7CpJoliIQ5g+V5y0njaLoxB7FzvY2IMaacEEzLqbIdPE5CTcOfQR6PiDA2evY/UkVuqlMrSVcfYQNCWvW7NPdLRipgCLit3anWbMS+sQgFRNvB/mVo+k0oyIauOWPXa7Mxjfu1x6aEcDX8/R2p6m6vt43T6wgDbePQUfVOzGXDdCbicEh5HDqCJBm2bk3E3YDqODQUW1NUTXPbdSIOc9THE6YuaI6lSmjI5aS6LJ5O18lTq8vqbYRp1myQLhDulk0mqzaQgOWUIMuyEolPkoKIj4qTyluGnaoEW9Uplrtua9qk8qqGncP1xL3+3tTIC4gSxTJ0hMR/eJlkw1yQFCAMkTJgABUWZEaUlUnl3dA21UrZGIhPKqPlmop3hhZnqv0EVxrIgvLkUsOH0qmVlLvDDG4wIsdyJCeJNMkqIEyKMhciuUiQHWvKoyZyjnT/OtYHRl6wY3nZh+rxnAY9ng/wHR2EAEmVg7KigrXegukEUi3oR4Iui0a3XxUUP1LbdHx/NKG/AzppQTXzizwNP+/euC3nat+7GcwbutyXFFDTcm76YMHwSiE1c+4MKgSCgAYczbDMJrB4eNVLzfHONp2+RQ8/VFe233ni5dtzlhyOPvLYMjBjSMjjKczz9njyDp1o9z771+f+vd0L582afWzf5pK50VU/XD1Tu+zsrAcPVCw4vevTr499cmft9hdnluT9Wd68/Y1nyr0f22TPzje/++P29VTHtuOvF5cevUleKpr9dN+hK79tE3effODtc8X1nznTLme2vHIj76L07dZMSfSk8kLNcxcvF++/1FdwYnH+38nSr66sW1XJrT6vXk5m7KcyZ/LfP1h24/fEvr7D1yr3HFiqVNJFfalD9a0v3Tq++Y5z8/ph++ipc6+uWFqvnY++u+vIwSdLn+9t1R/98bWFO76EW97Z+8vO9R+uOMVU7/UtXP/F/J/WXAgvMo4oTQV7pn/vJYWL1yqPSM2rrJpv3qqgPmpJnL1Q9uvxvv4y/gMDw56qdBEAAA==";
    $userToken = "";
    $ebayLoginPage = "";
    $getTokenUrl = "/identity/v1/oauth2/token";
    $accountUrl = "/sell/account/v1";



/*
    if(isset($_GET["code"]))
    {
        $authCode = $_GET["code"];
    }
    else
    {
        $authCode = false;
    }

    if($environment == 0)
    {
        $baseUrl = "https://api.sandbox.ebay.com";
        $clientId = "JustinRo-ebaytest-SBX-045f6444c-d84abb1e";
        $certId = "SBX-45f6444cb545-5cb2-4f08-bd57-5964";
        $ruName = "Justin_Roberts-JustinRo-ebayte-yrmkpfx";
        $ebayLoginPage = "https://signin.sandbox.ebay.com/authorize?client_id=JustinRo-ebaytest-SBX-045f6444c-d84abb1e&response_type=code&redirect_uri=Justin_Roberts-JustinRo-ebayte-yrmkpfx&scope=https://api.ebay.com/oauth/api_scope https://api.ebay.com/oauth/api_scope/buy.order.readonly https://api.ebay.com/oauth/api_scope/buy.guest.order https://api.ebay.com/oauth/api_scope/sell.marketing.readonly https://api.ebay.com/oauth/api_scope/sell.marketing https://api.ebay.com/oauth/api_scope/sell.inventory.readonly https://api.ebay.com/oauth/api_scope/sell.inventory https://api.ebay.com/oauth/api_scope/sell.account.readonly https://api.ebay.com/oauth/api_scope/sell.account https://api.ebay.com/oauth/api_scope/sell.fulfillment.readonly https://api.ebay.com/oauth/api_scope/sell.fulfillment https://api.ebay.com/oauth/api_scope/sell.analytics.readonly";
    }
    else
    {
        $baseUrl = "https://api.ebay.com";
        $clientId = "JustinRo-ebaytest-PRD-745f6444c-1d195591";
        $certId = "PRD-45f6444cd92d-c562-46fd-9c27-cf9d";
        $ruName = "Justin_Roberts-JustinRo-ebayte-aghtdoe";
        $ebayLoginPage = "https://signin.ebay.com/authorize?client_id=JustinRo-ebaytest-PRD-745f6444c-1d195591&response_type=code&redirect_uri=Justin_Roberts-JustinRo-ebayte-aghtdoe&scope=https://api.ebay.com/oauth/api_scope https://api.ebay.com/oauth/api_scope/sell.marketing.readonly https://api.ebay.com/oauth/api_scope/sell.marketing https://api.ebay.com/oauth/api_scope/sell.inventory.readonly https://api.ebay.com/oauth/api_scope/sell.inventory https://api.ebay.com/oauth/api_scope/sell.account.readonly https://api.ebay.com/oauth/api_scope/sell.account https://api.ebay.com/oauth/api_scope/sell.fulfillment.readonly https://api.ebay.com/oauth/api_scope/sell.fulfillment https://api.ebay.com/oauth/api_scope/sell.analytics.readonly";
    }

*/