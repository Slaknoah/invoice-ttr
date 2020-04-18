<template>
  <div :class="parentClass">
    <slot name="bf-input"></slot>
    <input  v-if="!isTextarea"
        ref="input"
        :value="value"
        :id="name" 
        class="validate"
        :class="{valid: !isEmptyValue}"
        v-bind="$attrs"
        v-on="inputListeners"
    >
    
    <textarea  v-else
        ref="input"
        :value="value"
        :id="name" 
        class="validate materialize-textarea"
        :class="{valid: !isEmptyValue}"
        v-bind="$attrs"
        v-on="inputListeners"
    ></textarea>
    <label :for="name" :class="{active: !isEmptyValue}">{{ label }}</label>
    <slot name="af-input"></slot>
  </div>
</template>

<script>
export default {
  name: "BaseInput",
  inheritAttrs: false,
  props: ["label", "value", "parentClass", "isTextarea"],
  computed: {
    name() {
      if(this.label)
        return "input-" + this.label.replace(/\s+/g, "-").toLowerCase();
    },
    inputListeners: function() {
      var vm = this;
      return Object.assign(
        {},
        this.$listeners,
        {
          input: function(event) {
            vm.$emit("input", event.target.value);
          }
        }
      );
    },
    isEmptyValue() {
      return !!!this.value;
    }
  }
};
</script>
