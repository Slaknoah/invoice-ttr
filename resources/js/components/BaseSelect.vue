<template>
  <div :class="parentClass">
    <slot name="bf-input"></slot>
    <label :for="name">{{ label }}</label>
    <div class="input-field">
      <select  :id="name" @change="change" class="form-control base-select" v-bind="$attrs" >
        <option value="">{{ notSelectedLabel || $t('general.all') }}</option>
        <option
          :value="option.value"
          v-for="(option, index) in options"
          :key="index"
          :selected="selectedOption(option)">{{option.text}}</option>
      </select>
    </div>
    <slot name="af-input"></slot>
  </div>

</template>

<script>
export default {
    name: "BaseSelect",
    inheritAttrs: false,
    data() {
        return {
        selected: null
        };
    },
    props: {
        label: {
          type: String,
          default: "Option"
        },
        value: [String, Number],
        notSelectedLabel: {
          type: String,
        },
        options: {
          type: Array
        },
        parentClass: String
    },
    methods: {
        selectedOption(option) {
          if (this.value) {
              return option.value === this.value;
          }
          return false;
        },
        change(e) {
            this.$emit("input", e.target.value);
        }
    },
    computed: {
        name() {
          return "input-" + this.label.replace(/\s+/g, "-").toLowerCase();
        },
    },
    watch: {
        options() {
            this.$nextTick(() => {
                $('.base-select').formSelect();
            });
        },
        value() {
          this.$nextTick(() => {
            // $('.base-select').formSelect();
          });
        }
    },
    mounted() {
        $(document).ready(function(){
            $('.base-select').formSelect();
        });
    },
};
</script>