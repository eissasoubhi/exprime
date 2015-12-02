    <div class="modal fade" id="picture-link" tabindex="-1" role="dialog" aria-labelledby="picture-linkLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="picture-linkLabel">Lien de l'image</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="pic-link" class="control-label">Copier le lien dans le presse papier.</label>
                <input type="text" class="form-control" id="pic-link">
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" onclick='' data-dismiss="modal">Fermer</button>
          </div>
        </div>
      </div>
    </div>
    <script>
    jQuery(document).ready(function($)
    {
        $('#picture-link').on('shown.bs.modal', function (e)
        {
            $(this).find('#pic-link').select();
        })
    });
    </script>