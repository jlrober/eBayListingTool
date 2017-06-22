<?php
    /**
     * Created by IntelliJ IDEA.
     * User: jl-ro
     * Date: 6/5/2017
     * Time: 10:18 PM
     */

     Class Items_list extends CI_Controller {
        function index($page) {
            $this->load->model('ebay_calls', "", true);
            $data["items"] = $this->ebay_calls->getItems((($page - 1) * 25), 25);
            $this->load->view("header");
            $this->load->view("Items_list", $data);
            $this->load->view("footer");
        }

        function get_item_page($page) {
            $this->load->model('ebay_calls', "", true);
            $data["items"] = $this->ebay_calls->getItems((($page - 1)* 25), 25);
            var_dump(json_decode($data, true));
            $this->load->view("header");
            $this->load->view("Items_list", $data);
            $this->load->view("footer");
        }

        function item_details() {
            $this->load->model("ebay_calls", "", true);
            $result = $this->ebay_calls->getItem($this->input->post("sku"));
            echo $result;
        }

         public function delete_item($sku) {
             $this->load->model("ebay_calls", "", true);
             $result = $this->ebay_calls->deleteItem($sku);
             echo $result;
         }

         function create_item() {

             $this->load->helper(array('form', 'url'));

             $this->load->library('form_validation');

             $this->form_validation->set_rules('Sku', "Sku", 'required');

             if ($this->form_validation->run() == FALSE)
             {

                 var_dump($_POST);
                 echo "form validation failed";
             }
             else
             {
                 $this->load->model("ebay_calls", "", true);
                 $result = $this->ebay_calls->createItem($_POST);
                 echo $result;
             }

         }

         function get_offers() {
            $this->load->model("ebay_calls", "", true);
            $result = $this->ebay_calls->getOffers($this->input->post("sku"));
            echo $result;
         }

         function publish_offer() {
            $this->load->model("ebay_calls", "", true);
            $result = $this->ebay_calls->publishOffer($this->input->post("offerId"));
            if($result === FALSE) {
                echo false;
            } else {
                echo $result;
            }
         }
     }