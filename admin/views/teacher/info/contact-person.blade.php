<div class="tab-pane" id="contact_info">
    <form class="form-horizontal animated bounceInRight"  @submit.prevent="validateData('contact_form')" data-vv-scope="contact_form" autocomplete="off">
        <div class="form-group">
            <label class="control-label col-sm-2" for="contactFirstName">First Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  id="contactFirstName"  v-model="teacher.contactFirstName" name="contactFirstName" v-validate="'required'" placeholder="Enter First Name">
                <div v-show="errors.has('contact_form.contactFirstName')"><span class="error">The first name field is required.</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="contactLastName">Last Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  id="contactLastName"  v-model="teacher.contactLastName" name="contactLastName" v-validate="'required'" placeholder="Enter Last Name">
                <div v-show="errors.has('contact_form.contactLastName')"><span class="error">The last name field is required.</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="contactphone">Phone:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  id="contactphone"  v-model="teacher.contactphone" name="contactphone" v-validate="'required'" placeholder="Enter Phone">
                <div v-show="errors.has('contact_form.contactphone')"><span class="error">The phone nubmer field is required.</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="contactEmail">Email:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  id="contactEmail"  v-model="teacher.contactEmail" name="contactEmail" v-validate="'required'" placeholder="Enter Email">
                <div v-show="errors.has('contact_form.contactEmail')"><span class="error">The email field is required.</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="contactrelation">Relationship:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  id="contactrelation"  v-model="teacher.contactrelation" name="contactrelation" v-validate="'required'" placeholder="Enter Relationship">
                <div v-show="errors.has('contact_form.contactrelation')"><span class="error">The relationship field is required.</span></div>
            </div>
        </div>
        <div class="text-right">
            <button  class="btn btn-primary" type="button" @click="contact_back">Previous</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>