<?php
/**
 * Created by PhpStorm.
 * User: jbob
 * Date: 6/8/17
 * Time: 1:48 PM
 */

?>
<div class="row">
    <div class="col s6 offset-s3">
        <ul class="collapsible" data-collapsible="accordion">
            <li>
                <div class="collapsible-header">Info</div>
                <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
            </li>
        </ul>
    </div>
</div>
<form action="/<?php echo base_url(); ?>import/getSpreadsheet/" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="file-field input-field col s6 offset-s2">
            <div class="btn">
                <span for="fileSelect">Browse...</span>
                <input type="file" id="fileSelect" name="fileSelect">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
        </div>
        <div class="input-field col s2">
            <select>
                <option value="" disabled selected>Select file type</option>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
            </select>
            <label>Materialize Select</label>
        </div>
    </div>
    <div class="row">
        <div class="col s12 center-align">
            <input type="submit" value="Submit" class="btn">
        </div>
    </div>
</form>
<script
    src="https://code.jquery.com/jquery-3.2.1.js"
    integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
    crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('select').material_select();
    });
</script>
