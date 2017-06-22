<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer" style="width: 40% !important;">
    <form method="post" action="/create_item/" id="modal-form">
        <div class="modal-content">
            <div class="row">
                <div class="input-field col s12">
                    <input id="sku" type="text" name="sku" class="validate">
                    <label for="sku" class="active">Sku</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="title" type="text" name="title">
                    <label for="title">Title</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s3">
                    <input id="quantity" type="number" name="quantity">
                    <label for="quantity">Quantity</label>
                </div>
                <div class="input-field col s9">
                    <select name="condition" id="condition">
                        <option value="" disabled selected>Choose condition</option>
                        <option value="NEW">NEW</option>
                        <option value="LIKE_NEW">LIKE_NEW</option>
                        <option value="USED_EXCELLENT">USED_EXCELLENT</option>
                        <option value="USED_GOOD">USED_GOOD</option>
                        <option value="USED_ACCEPTABLE">USED_ACCEPTABLE</option>
                    </select>
                    <label>Condition</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="description" class="materialize-textarea" name="description"></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s4">
                    <input type="text" id="brand" name="brand">
                    <label for="brand">Brand</label>
                </div>
                <div class="input-field col s4">
                    <input type="text" id="type" name="type">
                    <label for="type">Type</label>
                </div>
                <div class="input-field col s4">
                    <input type="text" id="MPN" name="mpn">
                    <label for="MPN">MPN</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="imageUrls" name="imageUrls">
                    <label for="imageUrls">Image URLs</label>
                </div>
            </div>
        </div>
    </form>
    <div class="modal-footer">
        <button id="cancelBtn" type="button" name="listing" class="modal-form-button modal-action modal-close waves-effect waves-green btn-flat">Close</button>
        <button id="createBtn" type="button" name="create" class="modal-form-button waves-effect waves-green btn-flat" style="display: none">Create Item</button>
        <button id="deleteBtn" type="button" name="delete" class="modal-form-button waves-effect waves-green btn-flat" style="display: none">Delete</button>
        <button id="listingBtn" type="button" name="update" class="modal-form-button waves-effect waves-green btn-flat" style="display: none">List</button>
        <button id="updateBtn" type="button" name="create" class="modal-form-button waves-effect waves-green btn-flat" style="display: none">Update</button>
        <button id="publishBtn" type="button" name="publish" class="modal-form-button waves-effect waves-green btn-flat" style="display: none">Publish</button>
        <button id="updateListingBtn" type="button" name="create" class="modal-form-button waves-effect waves-green btn-flat" style="display: none">Update</button>

    </div>

    <div class="modal-content" id="listingForm" style="display: none;">
        <div class="row">
            <div class="input-field col s12">
                <input id="offerSku" type="text" name="Sku" class="validate" disabled>
                <label for="offerSku" class="active">Sku</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="offerId" type="text" name="offerId" class="validate" disabled>
                <label for="offerId" class="active">Offer ID</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input id="offerPrice" type="number" name="offerPrice" class="validate">
                <label for="offerPrice" class="active">Price</label>
            </div>
            <div class="input-field col s6">
                <input id="offerQuant" type="number" name="offerQuant" class="validate">
                <label for="offerQuant" class="active">Quantity</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="offerCat" type="text" name="offerCat" class="validate">
                <label for="offerCat" class="active">Category ID</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="offerStatus" type="text" name="offerStatus" class="validate">
                <label for="offerStatus" class="active">Status</label>
            </div>
        </div>
    </div>

    <div id="progress" style="align-items: center; justify-content: center; position: fixed; top: 0; right: 0; bottom: 0; left: 0; display: none;">
        <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-response">
        <h4></h4>
    </div>
</div>