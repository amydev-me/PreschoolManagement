<div class="tab-pane" id="employee_detail">
    <form class="form-horizontal animated bounceInRight"  @submit.prevent="validateData('employee_form')" data-vv-scope="employee_form" autocomplete="off">
        <div class="form-group">
            <label class="control-label col-sm-2" for="biography">Biography:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="biography" rows="2" v-model="teacher.biography" name="biography"  placeholder="Enter Biography"></textarea>

            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="position">Position:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="position"  v-model="teacher.position" name="position" v-validate="'required'" placeholder="Enter Position">
                <div v-show="errors.has('employee_form.position')"><span class="error">@{{ errors.first('employee_form.position') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="degree">Qualification:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="degree" rows="1" v-model="teacher.degree" name="qualification" v-validate="'required'"  placeholder="Enter Qualification"></textarea>
                <div v-show="errors.has('employee_form.qualification')"><span class="error">@{{ errors.first('employee_form.qualification') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="salary">Salary:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="salary"  v-model="teacher.salary" name="salary" v-validate="'required'" placeholder="Enter Salary">
                <div v-show="errors.has('employee_form.salary')"><span class="error">@{{ errors.first('employee_form.salary') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="benefit">Benefits:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="benefit" rows="1" v-model="teacher.benefit" name="benefits" placeholder="Enter Benefits"></textarea>

            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="joindate">Join Date:</label>
            <div class="col-sm-10">
                <datepicker data-vv-scope="employee_form" v-validate="'required'" v-model="teacher.join_date" data-vv-name="join_date" v-validate="'required'"></datepicker>
                <div v-show="errors.has('employee_form.join_date')"><span class="error">@{{ errors.first('employee_form.join_date') }}</span></div>
            </div>
        </div>
        <div class="text-right">
            <button  class="btn btn-primary" type="button" @click="employee_back_click">Previous</button>
            <button type="submit" class="btn btn-primary">Next</button>
        </div>
    </form>
</div>