<template>
  <div class="input-group input-group-sm">
    <div class="input-group-prepend">
      <span class="input-group-text">{{ label }}</span>
    </div>
    <input
      v-mask="mask"
      v-validate="validation ? validation : data"
      :class="[{'is-valid':!errors.has(name) && isFormDirty},{'is-invalid':errors.has(name) && isFormDirty},{'is-invalid':error && !isFormDirty}]"
      :type="type"
      @change="changeData"
      class="form-control"
      :name="name"
      v-model="data "
    />
    <div class="invalid-feedback" v-if="errors.has(name)">
      <span v-if="!errors.has(name) && error">
        <strong v-if="error && !errors.has(name)">Campo {{ label }}{{error[0]}}</strong>
      </span>
    </div>
    <div class="invalid-feedback" v-show="errorData">
      <span>
        <strong>{{ errorData[0] }}</strong>
      </span>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "label",
    "type",
    "name",
    "changedData",
    "inputChange",
    "edit",
    "error",
    "validation",
    "mask"
  ],
  mounted() {
    this.data = this.edit;
  },
  data() {
    return {
      data: "",
      errorData: ""
    };
  },
  methods: {
    changeData() {
      this.$emit("change", this.data);
    }
  },
  watch: {
    inputChange: function(novo, velho) {
      this.data = novo;
    },
    error: function(novo, velho) {
      this.errorData = novo;
    }
  },
  computed: {
    isFormDirty() {
      return Object.keys(this.fields).some(key => this.fields[key].dirty);
    }
  }
};
</script>
