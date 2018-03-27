module.exports= {
  props: ['inputid', 'inputurl'],
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
                              <button type="button" class="btn btn-primary" v-on:click.prevent="performdelete">Yes</button>
                        </div>
                  </div>s
              </div>
        </div>`,
  data:function () {
    return {
      id: null
    }
  },

  methods: {
    performdelete () {
      axios.get(this.inputurl + this.inputid).then(response => {
        if (response.data.success) {
          this.$emit('input');
        } else {
          Notification.error('Error occured whild deleting.');
        }
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Error occured whild deleting.');
        }
      });
    }
  }
};


