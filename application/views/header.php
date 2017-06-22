<?php
    /**
     * Created by IntelliJ IDEA.
     * User: jl-ro
     * Date: 6/5/2017
     * Time: 10:02 PM
     */

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
            <div class="navbar-fixed">
                <nav>
                    <div class="nav-wrapper blue m8">
                        <div class="container">
                            <a href="#" class="brand-logo left">eBay Lister</a>
                            <ul id="nav-mobile" class="right">
                                <li><a href="/<?php echo base_url(); ?>items_list/index/1">Items</a></li>
                                <li><a href="/<?php echo base_url(); ?>import/">Import</a></li>
                                <li><a href="/<?php echo base_url(); ?>settings/">Settings</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

        <ul id="slide-out" class="side-nav">
            <li><a class="waves-effect" href="#!">Create Item</a></li>
            <li><a class="waves-effect" href="#!">Bulk Listing</a></li>
        </ul>

