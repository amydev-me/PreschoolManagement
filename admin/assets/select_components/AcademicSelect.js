let asyncurl=route.urls.academic.asyncget;
module.exports = {

  props: {
    value:{
      default:null
    },
    empty:{
      default:false,
      type:Boolean
    }

  },
  template: `            
             <multiselect  
                placeholder="Select year"  
                v-model="selectedValues"  
                label="academicName"           
                :options="collections"
                :multiple="false"
                :searchable="false"    
                :allow-empty="empty"
                :show-labels="false"
                :internal-search="false"
                :custom-label="customLabel" 
                @input="onSelectChange">                                                                          
              </multiselect>`,
  data: function () {
    return {

      collections: [],
      selectedValues: null,
      customstyle: '',
      isbind: false
    }
  },
  methods: {
    customLabel ({ academicName, active_year }) {
      return `${academicName}  ${active_year==1?'(Active)':''}`
    },
    asyncGet () {
      axios.get(asyncurl).then(({data}) => {
        this.collections = data;


      });

    },
    onSelectChange () {

      let temp = null;

      if (this.isbind) {
        temp = this.value;
        this.selectedValues = this.value;
      } else {

        temp = this.selectedValues;
      }
      this.isbind = false;
      let _id = null;
      if (temp != null) {
        _id = temp;
      }
      this.$emit('input', _id);

    }
  },
  watch: {
    'value': function () {
      this.isbind = true;
      this.onSelectChange();
    }
  },

  mounted () {
    this.asyncGet();
    this.selectedValues=this.value;
  }
}