<?php
    /**
     * Created by IntelliJ IDEA.
     * User: jl-ro
     * Date: 6/6/2017
     * Time: 7:01 PM
     */
    $payment = $policies["payment"]["paymentPolicies"];
    $return = $policies["return"]["returnPolicies"];
    $fulfillment = $policies["fulfillment"]["fulfillmentPolicies"];
    $locations = json_decode($locations, true);
    $locations = $locations["locations"];
?>

    <div style="position: fixed; top: 10%; right: 2%; width: 21%;">
        <ul class="collection with-header">
            <li class="collection-header"><h5>Current Settings</h5></li>
            <li class="collection-item"><h6>Policies</h6></li>
            <li class="collection-item">Payment:
            <?php
                foreach($payment as $index => $policy) {
                    if($policy["paymentPolicyId"] == $_COOKIE["payment"]) {
                        echo $policy["name"];
                    }
                };
            ?>
            </li>
            <li class="collection-item">Return:
                <?php
                    foreach($return as $index => $policy) {
                        if($policy["returnPolicyId"] == $_COOKIE["return"]) {
                            echo $policy["name"];
                        }
                    };
                ?>
            </li>
            <li class="collection-item">Fulfillment:
                <?php
                    foreach($fulfillment as $index => $policy) {
                        if($policy["fulfillmentPolicyId"] == $_COOKIE["fulfillment"]) {
                            echo $policy["name"];
                        }
                    };
                ?>
            </li>
            <li class="collection-item"><h6>Location:
                <?php echo $_COOKIE["location"] ?>
                </h6></li>

        </ul>
    </div>

    <div class="container center-align">
        <ul class="tabs" style="width: 40%;">
            <li class="tab"><a class="active" href="#policies">Policies</a></li>
            <li class="tab"><a href="#location">Location</a></li>
        </ul>
        <div id="policies">
            <div class="row">
                <div class="col s12">
                    <ul class="tabs tabs-fixed-width" style="width: 50%;">
                        <li class="tab col s2"><a class="active" href="#payment">Payment</a></li>
                        <li class="tab col s2"><a href="#return">Return</a></li>
                        <li class="tab col s2"><a href="#fulfillment">Fulfillment</a></li>
                    </ul>
                </div>
            </div>
            <div class="row center-align">
                <div id="payment" class="col s12 center-align">
                    <form action="../settings/setpaymentpolicy" method='post'>
                        <?php foreach($payment as $index => $policy) {
                            echo "
                                <p class='center-align'>
                                    <input name=\"" . $policy["paymentPolicyId"] . "\" type=\"radio\" id=\"paymentPolicy" . $index . "\" />
                                    <label for=\"paymentPolicy" . $index . "\">" . $policy["name"] . "</label>
                                </p>
                            ";
                        } ?>
                        <button id="paymentBtn" type="submit" class="btn" style="margin: 5%;">Save</button>
                    </form>
                </div>
                <div id="return" class="col s12 center-align">
                    <form action="../settings/setreturnpolicy" method='post'>
                        <?php foreach($return as $index => $policy) {
                            echo "
                                <p class='center-align'>
                                    <input name=\"" . $policy["returnPolicyId"] . "\" type=\"radio\" id=\"returnPolicy" . $index . "\" />
                                    <label for=\"returnPolicy" . $index . "\">" . $policy["name"] . "</label>
                                </p>
                            ";
                        } ?>
                        <button id="paymentBtn" type="submit" class="btn" style="margin: 5%;">Save</button>
                    </form>
                </div>
                <div id="fulfillment" class="col s12 center-align">
                    <form action="../settings/setfulfillmentpolicy" method='post'>
                        <?php foreach($fulfillment as $index => $policy) {
                            echo "
                                <p class='center-align'>
                                    <input name=\"" . $policy["fulfillmentPolicyId"] . "\" type=\"radio\" id=\"fulfillmentPolicy" . $index . "\" />
                                    <label for=\"fulfillmentPolicy" . $index . "\">" . $policy["name"] . "</label>
                                </p>
                            ";
                        } ?>
                        <button id="paymentBtn" type="submit" class="btn" style="margin: 5%;">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div id="location">
            <?php if(!isset($locations)) :
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
             */?>

            <div class="row">
                <form class="col s6 offset-s3" method="post" action="../settings/create_location">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="locationKey" type="text" class="validate" name="locationKey">
                            <label for="locationKey">Location Key</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="address_line_1" type="text" class="validate" name="addressLine1">
                            <label for="address_line_1">Address</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="city" type="text" class="validate" name="city">
                            <label for="city">City</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12" name="stateOrProvince">
                            <input id="state" type="text" class="validate">
                            <label for="state">State</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="postalCode" type="number" class="validate" name="postalCode">
                            <label for="postalCode">Zip</label>
                        </div>
                    </div>
                    <button type="submit" class="btn" id="submitLocationBtn" name="submit">Submit</button>
                </form>
            </div>
            <?php else : ?>
                <h4>Select Location</h4>
                <?php
                    echo "<form method='post' action='../settings/set_location'>";
                    foreach($locations as $index => $location) {
                        echo "
                            <p class='center-align'>
                                <input name=\"merchantLocationKey\" type=\"radio\" id=\"location" . $index . "\" value='" . $location["merchantLocationKey"] . "'/>
                                <label for=\"location" . $index . "\">" . $location["merchantLocationKey"] . "</label>
                            </p>
                        ";
                    }
                    echo "<button type='submit' class='btn'>Set Location</button></form>";
                ?>
            <?php endif ?>
        </div>
    </div>

    <script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>

    <script>
        $("#paymentBtn").click(function() {
            $("#paymentBtn").siblings("p").find("input").attr("name");
        });
        $("#enablePolBtn").click(function() {
           $.ajax({
               url: "../settings/optIntoPolicies/",
               method: "POST",

               success: function(response) {
                   console.log(response);
               }
           });
        });

        $("#submitLocationBtn").click(function() {
            $.ajax({
                url: "../"
            })
        });
    </script>