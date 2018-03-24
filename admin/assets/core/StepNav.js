Vue.component("step-navigation-step", {
  template: `<li :class="indicatorclass">
                            <div class="step"><i :class="step.icon_class"></i></div>
                            <div class="caption hidden-xs hidden-sm"> <span v-text="step.title"></span></div>
                        </li>`,

  props: ["step", "currentstep"],

  computed: {
    indicatorclass() {
      return {
        active: this.step.id == this.currentstep,
        complete: this.currentstep > this.step.id
      };
    }
  }
});

Vue.component("step-navigation", {
  template: ` <ol class="step-indicator">
                            <li v-for="step in steps" is="step-navigation-step" :key="step.id" :step="step" :currentstep="currentstep">
                            </li>
                        </ol>`,

  props: ["steps", "currentstep"]
});

Vue.component("step", {
  template: ` <div class="step-wrapper pull-right" :class="stepWrapperClass">
                            <button class="btn btn-primary" @click="lastStep" v-show="!firststep">
                                Back
                            </button>
                            <button class="btn btn-primary" @click="nextStep" v-show="!laststep">
                                Next
                            </button>
                            <button class="btn btn-primary" v-if="laststep" @click="submitClick">
                                Submit
                            </button>
                        </div>`,

  props: ["step", "stepcount", "currentstep"],

  computed: {
    active() {
      return this.step.id == this.currentstep;
    },

    firststep() {
      return this.currentstep == 1;
    },

    laststep() {
      return this.currentstep == this.stepcount;
    },

    stepWrapperClass() {
      return {
        active: this.active
      };
    }
  },

  methods: {
    nextStep() {
      this.$emit("step-change", [this.currentstep + 1,'front']);
    },

    lastStep() {
      this.$emit("step-change", [this.currentstep-1,'back']);
    },
    submitClick(){
      this.$emit("step-change",[this.currentstep,'submit']);
    }
  }
});