let create=route.urls.academic.create;
let update=route.urls.academic.update;

module.exports={
  props:['academic','isedit'],
  template:`  <div ref="thismodel" id="mymodal" class="modal fade modal-dialog-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ isedit?'Edit Year':'Add  Year' }}</h4>
                    </div>
                    <form class="form-horizontal" role="form" @submit.prevent="submitdata">
                        <div class="modal-body">
                            <div class="form-group">
                               <div class="col-sm-12  notice notice-warning">
                                        <strong>Note :</strong>   Must have one active academic year.
                                 </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Year :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="academicName" v-model="academic.academicName" v-validate="'required'">
                                </div>
                                <div class="col-sm-offset-2 col-sm-9" v-show="errors.has('academicName')"><span class="error">Required year.</span></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-9">
                                    <label class="cr-styled">
                                        <input type="checkbox" v-model="academic.active_year" name="active">
                                        <i class="fa"></i>
                                        Active
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>`,

  methods: {
    clearOnHidden () {
      this.academic.id = null;
      this.academic.academicName = null;
      this.academic.active_year = false;
      this.$validator.reset();
    },
    submitdata () {
      this.$validator.validateAll().then(successsValidate => {
        if (successsValidate) {
          let _url = this.isedit ? update : create;
          this.performAction(_url);
        }
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Opps!Something went wrong.');
        }
      });
    },
    performAction (url) {
      axios.post(url, this.academic).then(response => {
        if (response.data.success) {
          Notification.success('Success');

          this.$emit('success');
        } else {
          Notification.error('Failed.');
        }
      });
    },
  },
  mounted () {
    $(this.$refs.thismodel).on("hidden.bs.modal", this.clearOnHidden);
  }
}