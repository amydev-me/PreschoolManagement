<div class="tab-pane" id="grade_detail">
    <form class="form-horizontal  animated bounceInRight"  role="form" @submit.prevent="validateData('grade_form')" data-vv-scope="grade_form">
        <div class="form-group">
            <label class="control-label col-sm-2" for="join_date">Year:</label>
            <div class="col-sm-10">
                <multiselect
                        label="academicName"
                        v-model="selected_academic"
                        v-validate="'required'"
                        data-vv-scope="grade_form"
                        data-vv-name="academic_year"
                        :options="academics"
                        :show-labels="false"
                        placeholder="Type to search year"></multiselect>
                <div v-show="errors.has('grade_form.academic_year')"><span class="error">Required year.</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Grade Category :</label>
            <div class="col-sm-10">
                <multiselect @input="selectedGradeChange"
                        label="categoryName"
                        open-direction="bottom"
                        v-model="selected_category"
                        v-validate="'required'"
                             data-vv-scope="grade_form"
                             data-vv-name="category"
                        :options="categories"
                        :show-labels="false"
                        placeholder="Select Category"></multiselect>

            </div>
            <div class="col-sm-offset-2 col-sm-9" v-show="errors.has('grade_form.category')"><span class="error">Required grade category.</span></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Grade :</label>
            <div class="col-sm-10">
                <multiselect
                        label="gradeName"
                        open-direction="bottom"
                        v-model="selected_grade"
                        v-validate="'required'"
                        data-vv-scope="grade_form"
                        data-vv-name="grade"
                        :options="grades"
                        :show-labels="false"
                        placeholder="Select grade"></multiselect>
            </div>
            <div class="col-sm-offset-2 col-sm-9" v-show="errors.has('grade_form.grade')"><span class="error">Required grade.</span></div>
        </div>
        <div class="col-sm-offset-2 col-sm-10" v-if="selected_grade !=null">
            <div class="col-sm-12">
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-9">
                            <label class="cr-styled">
                                <input type="checkbox" v-model="firstchecked"  v-validate="'verify_term'" name="tt">
                                <i class="fa"></i>
                                Term#1
                            </label>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9">
                                <div class="radio">
                                    <label class="cr-styled" for="ffull">
                                        <input type="radio" id="ffull" name="ffull" value="Full" v-model="first_term.t_time">
                                        <i class="fa"></i>
                                        Full
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="cr-styled" for="fhalf">
                                        <input type="radio" id="fhalf" name="fhalf" value="Half" v-model="first_term.t_time">
                                        <i class="fa"></i>
                                        Half
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-9">
                              <label class="cr-styled">
                                  <input type="checkbox" v-model="secondchecked"  v-validate="'verify_term'"  name="td">
                                  <i class="fa"></i>
                                  Term#2
                              </label>
                          </div>
                          <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-9">
                                  <div class="radio">
                                      <label class="cr-styled" for="sfull">
                                          <input type="radio" id="sfull" name="sfull" value="Full" v-model="second_term.t_time">
                                          <i class="fa"></i>
                                          Full
                                      </label>
                                  </div>
                                  <div class="radio">
                                      <label class="cr-styled" for="shalf">
                                          <input type="radio" id="shalf" name="shalf" value="Half" v-model="second_term.t_time">
                                          <i class="fa"></i>
                                          Half
                                      </label>
                                  </div>
                              </div>
                          </div>
                      </div>
                </div>
            </div>
            <div class="col-sm-offset-1 col-sm-11" v-show="errors.has('grade_form.tt')&&errors.has('grade_form.td')"><span class="error">At least one term need to check.</span></div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>