<div class="modal fade" id="{{ isset($modalId) ? $modalId : 'modal' }}" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button class="btn btn-default modal-cancel-btn" data-dismiss="modal">Batal</button>
        <button class="btn btn-primary modal-approve-btn">Proses</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
