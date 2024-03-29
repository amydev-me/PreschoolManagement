require('./bootstrap');

window.Vue = require('vue');

window.Notification=require('./core/VueNotification');
window.route=require('./routes');
window.Helper=require('./core/Helper');
Vue.use(require('vee-validate'));
Vue.component('multiselect', require('vue-multiselect').default);
Vue.component('businessInfo', resolve => require(['./businessinfo/index'], resolve));
Vue.component('academicYear', resolve => require(['./academic/index'], resolve));
Vue.component('allUser', resolve => require(['./user/index'], resolve));
Vue.component('manageCategory', resolve => require(['./category/index'], resolve));
Vue.component('manageSubject', resolve => require(['./subject/index'], resolve));
Vue.component('manageFee', resolve => require(['./fee/index'], resolve));
Vue.component('manageTerm', resolve => require(['./term/index'], resolve));
Vue.component('gradeList', resolve => require(['./grade/index'], resolve));
Vue.component('manageGrade', resolve => require(['./grade/action'], resolve));
Vue.component('editGrade', resolve => require(['./grade/edit-action'], resolve));
Vue.component('allTeacher', resolve => require(['./teacher/index'], resolve));
Vue.component('teacherAction', resolve => require(['./teacher/create'], resolve));
Vue.component('detailTeacher', resolve => require(['./teacher/detail'], resolve));
Vue.component('gradeTeacher', resolve => require(['./grade_teacher/index'], resolve));

Vue.component('allGuardian', resolve => require(['./guardian/index'], resolve));
Vue.component('detailGuardian', resolve => require(['./guardian/detail'], resolve));


Vue.component('allStudent', resolve => require(['./student/index'], resolve));
Vue.component('createStudent', resolve => require(['./student/create'], resolve));
Vue.component('detailStudent', resolve => require(['./student/detail'], resolve));

Vue.component('createPayment', resolve => require(['./payment/create'], resolve));
Vue.component('editPayment', resolve => require(['./payment/edit'], resolve));
Vue.component('invoiceList', resolve => require(['./payment/index'], resolve));
Vue.component('invoiceView', resolve => require(['./payment/view'], resolve));

Vue.component('dashboard', resolve => require(['./dashboard/index'], resolve));

Vue.component('attendance', resolve => require(['./attendance/index'], resolve));
const app = new Vue({
  el: '#app',
  data: function () {
    return {
      info: {
        id: null,
        title: null,
        phone: null,
        address: null,
        email: null,
        website:null,
        facebook:null,
        fax: null,
        note: null,
        invoice_logo:null,
        logo: null,
        footer: null,
        instruction:null,
        business_type:null
      }
    }
  },
  methods:{
    getImage (profile) {
      if(profile==null) return;
      return '/image/business/' + profile;
    },
    getDetail(){
      axios.get('/admin/info/detail').then(response=>{
        if(response.data.information !=null) {

          let info = response.data.information;
          this.info.id = info.id;
          this.info.title = info.title=="null"?'':info.title;
          this.info.email = info.email=="null"?'':info.email;
          this.info.website = info.website=="null"?'':info.website;
          this.info.facebook = info.facebook=="null"?'':info.facebook;
          this.info.phone = info.phone=="null"?'':info.phone;
          this.info.fax = info.fax=="null"?'':info.fax;
          this.info.address = info.address=="null"?'':info.address;
          this.info.note = info.note=="null"?'':info.note;
          this.info.footer = info.footer=="null"?'':info.footer;
          this.info.login_text = info.login_text=="null"?'':info.login_text;
          this.info.logo=info.logo;
          this.info.invoice_logo=info.invoice_logo;
          this.info.instruction=info.instruction=="null"?'':info.instruction;
          this.info.business_type=info.business_type=="null"?'':info.business_type;

        }
      });
    }
  },
  mounted() {
    this.getDetail();
  }
});