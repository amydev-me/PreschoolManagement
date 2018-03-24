@extends('layout.app')
@section('page-title','Informations')
@section('setup','active')
@section('setting','active')

@section('content')
    <div class="panel" v-cloak>
        <div class="panel-body">
                <business-info inline-template>

        <div v-cloak>
    <form class="form-horizontal  animated bounceInRight" @submit.prevent="submit" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Name:</label>
            <div class="col-sm-10">
                <input type="text" id="name"  class="form-control"  v-model="info.title" name="name" v-validate="'required'" placeholder="Enter Name">
                <div v-show="errors.has('name')"><span class="error">@{{ errors.first('name') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="phone">Phone:</label>
            <div class="col-sm-10">
                <input type="text" id="phone"  class="form-control"  v-model="info.phone" name="phone" v-validate="'required'" placeholder="Enter Phone No">
                <div v-show="errors.has('phone')"><span class="error">@{{ errors.first('phone') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="email" id="email"  class="form-control"  v-model="info.email" name="email" v-validate="'email'" placeholder="Enter Email">
                <div v-show="errors.has('email')"><span class="error">@{{ errors.first('email') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="fax">Fax:</label>
            <div class="col-sm-10">
                <input type="text" id="fax"  class="form-control"  v-model="info.fax" name="fax"  placeholder="Enter Fax">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="address">Address:</label>
            <div class="col-sm-10">
                <textarea id="address" class="form-control" rows="1" v-model="info.address" name="address" v-validate="'required'" placeholder="Enter Address"></textarea>
                <div v-show="errors.has('address')"><span class="error">@{{ errors.first('address') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="note">Note:</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="1" v-model="info.note" name="note" placeholder="Enter Note" id="note"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="footer">Footer:</label>
            <div class="col-sm-10">
                <input type="text" id="footer"  class="form-control"  v-model="info.footer" name="footer"  placeholder="Enter Footer">
                <div v-show="errors.has('footer')"><span class="error">@{{ errors.first('footer') }}</span></div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="login_text">Login Text:</label>
            <div class="col-sm-10">
                <input type="text" id="login_text"  class="form-control"  v-model="info.login_text" name="login_text"  placeholder="Enter Login text">
                <div v-show="errors.has('login_text')"><span class="error">@{{ errors.first('login_text') }}</span></div>
            </div>
        </div>

        <div class="form-group ">
            <label class="control-label col-sm-2" for="email">Logo:</label>
            <div class="col-sm-10 ">
                <div class="fileUpload btn btn-default">
                    <span>Upload</span>
                    <input type="file" class="upload "  @change="newProfile"  name="logo" v-validate="'image'"/>
                </div>
                <a @click="removelogo" v-show="showremove"> <span class="error"><i class="fa fa-remove"></i>Remove Logo</span></a>
                <div v-show="errors.has('logo')"><span class="error">Logo image Required.</span></div>
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
        </div>
    </business-info>
        </div>
    </div>
@endsection