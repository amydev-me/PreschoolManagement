module.exports={
  template: `
        <div id="deleteModal" class="modal fade bs-example-modal-sm modal-dialog-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
             <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h4 class="modal-title" id="mySmallModalLabel">Delete</h4>
                      </div>
                      <div class="modal-body">
                             <h4> Are you sure to delete?</h4>
                      </div>
                       <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                              <button type="button" class="btn btn-primary" v-on:click.prevent="$emit('input')">Yes</button>
                        </div>
                  </div>
              </div>
        </div>`,

};


