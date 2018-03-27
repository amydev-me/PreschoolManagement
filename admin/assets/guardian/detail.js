const GuardianInfo = resolve => require(['./info'], resolve);

let _getdetail=route.urls.guardian.details;
let _update=route.urls.guardian.update;
module.exports= {
  components: {
    GuardianInfo
  },
  data: function () {
    return {
      guardian: {
        id: null,
        fullName:null,
        firstName: null,
        lastName: null,
        realation: null,
        occupation: null,
        phone: null,
        address: null,
        email: null,

      },
      students:[]
    }
  },

  methods: {
    checkUrlParam () {
      let guardian_id = Helper.getUrlParameter('guardian_id');
      if (guardian_id != null) {

        this.guardian.id = guardian_id;
        this.getDetail();
      }
    },

    formatDate (date) {
      return Helper.formatDate(date);
    },

    getDetail () {
      axios.get(_getdetail + this.guardian.id).then(response => {
        let _guardian = response.data;
        this.guardian.id=_guardian.id;
        this.guardian.firstName=_guardian.firstName;
        this.guardian.lastName=_guardian.lastName;
        this.guardian.fullName=_guardian.fullName;
        this.guardian.email=_guardian.email;
        this.guardian.phone=_guardian.phone;
        this.guardian.realation=_guardian.realation;
        this.guardian.occupation=_guardian.occupation;
        this.guardian.address=_guardian.address;

        // this.students=response.data.students;
      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = Helper.loginPage();
        } else {
          Notification.error('Error occured while loading data.');
        }
      });
    },
    submit(){
      this.$validator.validateAll().then(successValidate=>{
        if(successValidate){
          this.guardian.fullName=this.guardian.firstName+' '+this.guardian.lastName;
          axios.post(_update, this.guardian).then(response => {
            Notification.success('Success');
          }).catch(error => {
            if (error.response.status == 401 ||error.response.status==419) {
              window.location.href = route.urls.login;
            } else {
              Notification.error('Invalid data.');
            }
          });
        }
      });
    }
  },
  mounted () {
    this.checkUrlParam();
  }
}