<div class="tab-pane" id="grade_detail">
    <form class="form-horizontal  animated bounceInRight"  role="form" @submit.prevent="validateData('grade_form')" data-vv-scope="grade_form">

            <div class="form-group">
                <label class="control-label col-sm-2">Grade:</label>
                <div class="col-sm-10">
                    <multiselect v-model="selected_grade" :options="grades" :multiple="false" group-values="grades"
                                 group-label="categoryName" :group-select="false" placeholder="Select grade"
                                 label="gradeName">
                        <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
                    </multiselect>

                </div>
                <div class="col-sm-offset-2 col-sm-9" v-show="errors.has('grade_form.category')"><span class="error">Required grade category.</span></div>
            </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>