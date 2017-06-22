<?php
/**
 * Created by PhpStorm.
 * User: jbob
 * Date: 6/8/17
 * Time: 1:47 PM
 */

    Class Import extends CI_Controller {
        function index() {
            $this->load->view("header");
            $this->load->view("import");
            $this->load->view("footer");
        }

        function getSpreadsheet() {

            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            $file = $_FILES["fileSelect"]["tmp_name"];

            $this->load->library("excel");
            $spreadsheetData = array();
            $inputFilename = $file;
            $inputFileType = 'OOCalc';
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objReader->setLoadSheetsOnly( array("Sheet1") );
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($inputFilename);

            foreach($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $spreadsheetData[$worksheet->getTitle()] = $worksheet->toArray();
            }
            $spreadsheetData = $spreadsheetData["Sheet1"];
            $rowTitles = array_shift($spreadsheetData);
            $formatted_spreadsheet = array();
            foreach($spreadsheetData as $itemNum=>$itemData) {
                foreach($itemData as $itemIndex=>$itemCell) {
                    if(isset($itemCell)) {
                        $formatted_spreadsheet[$itemNum][$rowTitles[$itemIndex]] = $itemCell;
                    }
                }
            }

            $this->load->model("ebay_calls");
            $itemsNotUl = array();
            foreach($formatted_spreadsheet as $index=>$item) {
                $result = $this->ebay_calls->createItem($item);
                if($result === FALSE) {
                    $itemsNotUl[$item["Sku"]] = "unable to create";
                }
                else {
                    $result2 = $this->ebay_calls->createOffer($item["Sku"], $item["Category"], $item["Price"]);
                    if($result2 === FALSE) {
                        $itemsNotUl[$item["Sku"]] = "unable to create offer";
                    }
                    else {
                        $result2 = json_decode($result2, true);
                        $offerId = $result2["offerId"];
                        $result3 = $this->ebay_calls->publishOffer($offerId);
                        if($result3 === FALSE) {
                            $itemsNotUl[$item["Sku"]] = "unable to publish offer";
                        }
                    }
                }
            }

            var_dump($itemsNotUl);
        }
    }