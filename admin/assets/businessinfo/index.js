let _asyncacademic=route.urls.academic.asyncget;

module.exports= {

  data: function () {
    return {
      info: {
        id: null,
        title: null,
        phone: null,
        address: null,
        email: null,
        fax: null,
        note: null,
        logo: null,
        footer: null,
        login_text: null,
        remove: false,

      },
      showremove: false,

    }
  },

  methods: {

    newProfile (event) {
      let files = event.target.files;
      if (files.length) {
        this.info.logo = files[0];
      }
    },
    submit () {
      this.$validator.validateAll().then(successsValidate => {
        if (successsValidate) {
          let url = this.info.id == null ? '/api/info/create' : '/api/info/edit';
          this.performAction(url);
        }
      }).catch(error => {
        Notification.warning('Invalid data.');
      });
    },
    removelogo () {
      this.showremove = false;
      this.info.remove = true;
    },
    performAction (url) {
      let data = new FormData();
      data.set('title', this.info.title);
      data.set('email', this.info.email);
      data.set('phone', this.info.phone);
      data.set('fax', this.info.fax);
      data.set('address', this.info.address);
      data.set('note', this.info.note);
      data.append('logo', this.info.logo);
      data.set('footer', this.info.footer);
      data.set('login_text', this.info.login_text);

      data.set('remove', this.info.remove);
      const config = {headers: {'Content-Type': 'multipart/form-data'}};
      axios.post(url, data, config).then(response => {

        window.location.href = '/';

      }).catch(error => {
        if (error.response.status == 401 || error.response.status == 419) {
          window.location.href = route.urls.login;
        } else {
          Notification.error('Error occured while loading data.');
        }
      });
    },
    getDetail () {
      axios.get('/admin/info/detail').then(response => {
        if (response.data.information != null) {
          let info = response.data.information;
          this.info.id = info.id;
          this.info.title = info.title;
          this.info.email = info.email;
          this.info.phone = info.phone;
          this.info.fax = info.fax;
          this.info.address = info.address;
          this.info.note = info.note;
          this.info.footer = info.footer;
          this.info.login_text = info.login_text;

          if (info.logo == 'null') {
            this.showremove = false;
          } else {
            this.showremove = true;
          }
        }
      });
    },
    asyncacademics () {
      axios.get(_asyncacademic).then(({data}) => {
        this.academics = data;
        this.getDetail();
      });
    }
  },
  mounted () {
    this.asyncacademics();
  }
}