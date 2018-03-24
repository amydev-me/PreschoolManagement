const datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);

let create=route.urls.academic.create;
let update=route.urls.academic.update;

module.exports={
  components:{datepicker},
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

                                <label class="col-sm-2 control-label">Year :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="academicName" v-model="academic.academicName" v-validate="'required'">

                                </div>
                                <div class="col-sm-offset-2 col-sm-9" v-show="errors.has('academicName')"><span class="error">Required year.</span></div>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Start At :</label>
                                <div class="col-sm-10">
                                    <datepicker v-model="academic.start_date" data-vv-name="start_date" v-validate="'required'" ></datepicker>
                                </div>
                                <div class="col-sm-offset-2 col-sm-9" v-show="errors.has('start_date')"><span class="error">Required year.</span></div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label">End At :</label>
                                <div class="col-sm-10">
                                    <datepicker v-model="academic.end_date" data-vv-name="end_date" v-validate="'required'"></datepicker>
                                </div>

                                <div class="col-sm-offset-2 col-sm-9" v-show="errors.has('end_date')"><span class="error">Required year.</span></div>
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
    formatDate (date) {
      return Helper.formatDate(date);
    },
    clearOnHidden () {
      this.academic.id = null;
      this.academic.academicName = null;
      this.academic.start_date = this.formatDate(new Date());
      this.academic.end_date = this.formatDate(new Date());
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
        Notification.warning('Invalid data.');
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
    this.academic.start_date = this.formatDate(new Date());
    this.academic.end_date = this.formatDate(new Date());
    $(this.$refs.thismodel).on("hidden.bs.modal", this.clearOnHidden);
  }
}