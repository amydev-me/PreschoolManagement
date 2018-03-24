const datepicker = resolve => require(['../core/JQueryDatePicker'], resolve);

let create=route.urls.category.create;
let update=route.urls.category.update;

module.exports={
  components:{datepicker},
  props:['category','isedit'],
  template:`  <div ref="thismodel" id="mymodal" class="modal fade modal-dialog-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ isedit?'Edit Category':'Add  Category' }}</h4>
                    </div>
                    <form class="form-horizontal" role="form" @submit.prevent="submitdata">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Category :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="categoryName" v-model="category.categoryName" v-validate="'required'">
                                </div>
                                <div class="col-sm-offset-2 col-sm-9" v-show="errors.has('categoryName')"><span class="error">Required category name.</span></div>
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
      this.category.id = null;
      this.category.categoryName = null;

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
      axios.post(url, this.category).then(response => {
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