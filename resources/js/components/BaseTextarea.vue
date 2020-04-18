<template>
  <div :class="parentClass">
    <slot name="bfinput"></slot>
    <input  
        :value="value"
        :id="name" 
        class="validate"
        v-bind="$attrs"
        v-on="inputListeners"
    >
    <label :for="name" :class="{active: value.length}">{{ label }}</label>
    <slot name="afinput"></slot>
  </div>
</template>

<script>
export default {
  name: "BaseInput",
  inheritAttrs: false,
  props: ["label", "value", "parentClass"],
  computed: {
    name() {
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
    }
  }
};
</script>
