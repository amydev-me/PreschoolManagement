const datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);

let create=route.urls.subject.create;
let update=route.urls.subject.update;

module.exports= {
  components: {datepicker},
  props: ['subject', 'isedit'],
  template: `  <div ref="thismodel" id="mymodal" class="modal fade modal-dialog-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ isedit?'Edit Subject':'Add  Subject' }}</h4>
                    </div>
                    <form class="form-horizontal" role="form" @submit.prevent="submitdata">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Subject :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="subjectName" v-model="subject.subjectName" v-validate="'required'">
                                </div>
                                <div class="col-sm-push-3 col-sm-9" v-show="errors.has('subjectName')"><span class="error">Required subject name.</span></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Description :</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" name="description" v-model="subject.description"></textarea>
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
      this.subject.id = null;
      this.subject.subjectName = null;
      this.subject.description = null;
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
      axios.post(url, this.subject).then(response => {
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