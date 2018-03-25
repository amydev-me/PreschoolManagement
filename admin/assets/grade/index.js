const action = resolve => require(['./action'], resolve);
module.exports= {
  components: {action},
  data: function () {
    return {

    }
  },
  methods: {
    showAddModal () {
      $('#mymodal').modal('show');
    },


  },
  mounted () {

  }
}