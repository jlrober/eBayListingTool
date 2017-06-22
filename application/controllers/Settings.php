<?php
    /**
     * Created by IntelliJ IDEA.
     * User: jl-ro
     * Date: 6/6/2017
     * Time: 6:59 PM
     */

     Class Settings extends CI_Controller {
        public function index() {
            $this->load->view("header");
            $this->load->model("ebay_calls", "", true);
            $isOptedIn = $this->ebay_calls->checkIfOptedIn();
            $locations = $this->ebay_calls->getLocations();
            if($isOptedIn) {
                $this->load->view("need-optin-bp");
            }
            else {
                $data["policies"]["fulfillment"] = $this->ebay_calls->getPolicies("fulfillment");
                $data["policies"]["return"] = $this->ebay_calls->getPolicies("return");
                $data["policies"]["payment"] = $this->ebay_calls->getPolicies("payment");
                $data["locations"] = $locations;
                $this->load->view("settings", $data);
            }
            $this->load->view("footer");
        }

         public function setpaymentpolicy() {
             setcookie("payment", array_keys($_POST)[0], time() + 3600, "/");
             header("location: ../settings/");
         }

         public function setreturnpolicy() {
             setcookie("return", array_keys($_POST)[0], time() + 3600, "/");
             header("location: ../settings/");
         }

         public function setfulfillmentpolicy() {
             setcookie("fulfillment", array_keys($_POST)[0], time() + 3600, "/");
             header("location: ../settings/");
         }

         public function optIntoPolicies() {
            $this->load->model("ebay_calls", "", true);
            $result = $this->ebay_calls->optIntoPolicies();
            echo $result;
         }
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
        function create_location() {
            $this->load->model("ebay_calls", "", true);
            $location["locationKey"] = $this->input->post("locationKey");
            $location["addressLine1"] = $this->input->post("addressLine1");
            $location["city"] = $this->input->post("city");
            $location["stateOrProvince"] = $this->input->post("stateOrProvince");
            $location["postalCode"] = $this->input->post("postalCode");
            $location["country"] = "US";
            $location["name"] = "testName";
            $location["status"] = "ENABLED";
            $result = $this->ebay_calls->createLocation($location);
            var_dump($result);
        }

        function get_locations() {
            $this->load->model("ebay_calls", "", true);
            $result = $this->ebay_calls->getLocations();
            echo $result;
        }

        function set_location() {
            $location = $this->input->post("merchantLocationKey");
            setcookie("location", $location, time() + 3600, "/");
            header("location: ../settings/");
        }
     }