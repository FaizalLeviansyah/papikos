 <div class="modal fade text-left" id="rekeningEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Form Update Rekening Bank</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form>
            <div class="modal-body">
                <div class="form-group">
                  <label for="Nama Bank">Nama Bank</label>
                  <input type="text" class="form-control" name="nama_bank" id="nama_bank">
                </div>
                <input type="text" name="id" id="id">
                <div class="form-group">
                  <div class="controls">
                    <label for="No Rekening">No. Rekening</label>
                    <input type="number" name="no_rekening" class="form-control" id="no_rekening">
                  </div>
                </div>

                <div class="form-group">
                  <div class="controls">
                    <label for="Nama Pemilik">Nama Pemilik</label>
                    <input type="text" name="nama_pemilik" class="form-control" id="nama_pemilik">
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="update_bank">Update</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
  </div>
</div>