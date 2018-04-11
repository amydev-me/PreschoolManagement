
const AcademicSelect = resolve => require(['../select_components/AcademicSelect'], resolve);
const CategorySelect = resolve => require(['../select_components/CategorySelect'], resolve);

let update=route.urls.grade.update;

module.exports= {
template:`
<action :grade="grade"  @success="successdata" inline-template>
                <div ref="thismodel" id="mymodal" class="modal fade modal-dialog-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Grade</h4>
                            </div>
                            <form class="form-horizontal" role="form" @submit.prevent="submitdata">

                                 <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Year :</label>
                                        <div class="col-sm-9">
                                            <academic-select  @input="selectedAcadmiceChange" :value="selected_academic" data-vv-name="academic" v-validate="'required'"></academic-select>
                                            <div  v-show="errors.has('academic')"><span class="error">Required year.</span></div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Category :</label>
                                        <div class="col-sm-9">
                                            <category-select @input="selectedCategoryChange" :value="selected_category" data-vv-name="category" v-validate="'required'"></category-select>
                                            <div  v-show="errors.has('category')"><span class="error">Required category.</span></div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Grade :</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="gradeName" v-model="performdata.gradeName" v-validate="'required'">
                                            <div  v-show="errors.has('gradeName')"><span class="error">Required grade name.</span></div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Description :</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" rows="1" class="form-control" name="description" v-model="performdata.description"></textarea>
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
                </div>
            </action>`,
  props:['grade','isedit'],
  components: { CategorySelect,AcademicSelect},

  data: function () {
    return {
      selected_academic: null,
      academics: [],
      categories: [],
      selected_category: null,
      performdata: {
        id: null,
        category_id: null,
        academic_id: null,
        gradeName: null,
        description: null

      }
    }
  },

  methods: {
    selectedCategoryChange(value){
      this.selected_category=value;
    },
    selectedAcadmiceChange(value){
      this.selected_academic=value;
    },

    submitdata () {
      this.$validator.validateAll().then(successsValidate => {
        if (successsValidate) {

          this.performAction(update);
        }
      }).catch(error => {
        Notification.warning('Invalid data.');
      });
    },

    performAction (url) {

      this.performdata.academic_id=this.selected_academic.id;
      this.performdata.category_id=this.selected_category.id;

      axios.post(url, this.performdata).then(({data}) => {
        if(data.success==true){
          this.$emit('success');
        }else{
          Notification.error('Opps!Something went wrong.');
        }
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Opps!Something went wrong.');
        }
      });
    },
    showModal(){

        this.performdata.id = this.grade.id;
        this.performdata.gradeName = this.grade.gradeName;
        this.performdata.academic_id = this.grade.academic.id;
        this.performdata.category_id = this.grade.category.id;
        this.performdata.description = this.grade.description;
        this.selected_academic=this.grade.academic;
        this.selected_category=this.grade.category;

    }
  },

  mounted () {
    $(this.$refs.thismodel).on("shown.bs.modal", this.showModal);
  }
}