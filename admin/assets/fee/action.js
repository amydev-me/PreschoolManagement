const datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);
const NumericInput = resolve => require(['../core/NumericInput'], resolve);
let create=route.urls.fee.create;
let update=route.urls.fee.update;

module.exports={
  components:{datepicker,NumericInput},
  props:['feetype','isedit'],
  template:`  <div ref="thismodel" id="mymodal" class="modal fade modal-dialog-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ isedit?'Edit Fee Type':'Add  Fee Type' }}</h4>
                    </div>
                    <form class="form-horizontal" role="form" @submit.prevent="submitdata">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Fee Type :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="feeName" v-model="feetype.feeName" v-validate="'required'">
                                </div>
                                <div class="col-sm-push-3 col-sm-9" v-show="errors.has('feeName')"><span class="error">Required fee type.</span></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Amount :</label>
                                <div class="col-sm-9">
                                    <numeric-input  mask-type="currency"   v-model="feetype.amount" v-validate="'required'" data-vv-name="amount"> </numeric-input>
                                </div>     
                                <div class="col-sm-push-3 col-sm-9" v-show="errors.has('amount')"><span class="error">Required amount.</span></div>                           
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label">Description :</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" name="description" v-model="feetype.description"></textarea>
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
      this.feetype.id = null;
      this.feetype.feeName = null;
      this.feetype.description = null;
      this.feetype.amount = 0;
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
      axios.post(url, this.feetype).then(response => {
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