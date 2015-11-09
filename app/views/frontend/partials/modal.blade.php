<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="delete-modalLabel">Confirmation de suppression !</h4>
      </div>
      <div class="modal-body">
        êtes vous sûre de vouloire supprimer?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-undo"></i> Annuler</button>
        {{Form::open(array('method' => 'DELETE','class' => 'commit-delete'))}}
            <button type="submit" class="btn btn-danger delete-modal-submit" ><i class="fa fa-times"></i> Supprimer</button>
        {{Form::close()}}
      </div>
    </div>
  </div>
</div>