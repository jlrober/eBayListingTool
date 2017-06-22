<?php
    /**
     * Created by IntelliJ IDEA.
     * User: jl-ro
     * Date: 6/5/2017
     * Time: 10:21 PM
     */
    $this->load->library('form_validation');
     echo validation_errors();
    $items = json_decode($items, true);
    $rawItems = $items;
    $items = $items["inventoryItems"];
    echo "<div class='row'>";

    foreach($items as $index => $item) {
        if($index % 5 == 0) {
            echo "</div><div class='row'>";
        }
        echo "<div class='col l2 m6 card-container'>
                <div class='card'>
                    <div class='card-image'>
                        <img src='" . $item["product"]["imageUrls"][0] . "'>
                        <span class='card-title'>" . $item["sku"] . "</span>
                        <button data-target=\"modal1\" class='item-info btn-floating halfway-fab waves-effect waves-light red'><i class='material-icons'>info</i></button>
                    </div>
                    <div class='card-content'>
                        <p>" . $item["product"]["title"] . "</p>
                    </div>
                </div>
             </div>";
    }

?>

<!-- Modal Trigger -->
<button data-target="modal1" class="btn"  style="position: fixed; bottom: 5%; right: 3%;" id="createItemBtn">Create Item</button>
<button type="button" class="btn" id="deleteAll" style="position: fixed; bottom: 12%; right: 3%;">Delete All</button>

<?php require_once 'item-modal.php' ?>

    <div class="row">
        <ul class="pagination col s12 center-align">
            <?php
                $numCols = ($rawItems["total"] / 25) + 1;
                for($i = 1; $i <= $numCols; $i++) {
                    echo "<li class='waves-effect'><a href='/" . base_url() . "items_list/index/" . $i . "'>" . $i . "</a></li>";

                }
            ?>
            <!--
            <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
            <li class="active"><a href="#!">1</a></li>
            <li class="waves-effect"><a href="#!">2</a></li>
            <li class="waves-effect"><a href="#!">3</a></li>
            <li class="waves-effect"><a href="#!">4</a></li>
            <li class="waves-effect"><a href="#!">5</a></li>
            <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
            -->
        </ul>
    </div>
<script
    src="https://code.jquery.com/jquery-3.2.1.js"
    integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
    crossorigin="anonymous"></script>
<script src="../../../application/js/item-modal-control.js"></script>





<!--
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
-->
