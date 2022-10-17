<script type="text/javascript">
    function confirm_modal(delete_url) {
        "use strict"
        jQuery('#confirm-delete').modal('show', {backdrop: 'static'});
        document.getElementById('delete_link').setAttribute('href', delete_url);
    }
</script>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabels"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabels">@translate(Confirmation)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <p>@translate(Action confirmation message)</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close">@translate(Cancel)</button>
                <a id="delete_link" type="submit" class="btn btn-danger">@translate(Execute)</a>
            </div>
        </div>
    </div>
</div>

