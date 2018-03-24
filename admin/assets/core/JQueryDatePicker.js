module.exports ={
  template: "<div class='input-group date'>" +
  "<input class='form-control'  ref='input' v-bind:value='value' v-on:input='updateValue($event.target.value)' data-date-format='yyyy-mm-dd' data-date-end-date='0d' placeholder='dd-mm-yyyy' type='text'/>" +
  " <span class='input-group-addon'><i class='glyphicon glyphicon-calendar'></i></span>" +

  "</div>",
  props: ['value'],
  mounted: function() {
    let self = this;
    this.$nextTick(function() {
      $(this.$el).datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
      })
        .on('changeDate', function(e) {
          var date = e.format('yyyy-mm-dd');
          self.updateValue(date);
        });
    });
  },
  methods: {
    updateValue: function (value) {

      this.$emit('input', value);
    },
  }
};