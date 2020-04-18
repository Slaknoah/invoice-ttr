<template>
  <li class="waves-effect" :class="{'active' : isCurrentPage}">
    <a @click="onClick">
      {{ pageNumber }}
    </a>
  </li>
</template>

<script>
export default {
  name: "BasePaginationTrigger",
  props: {
    pageNumber: {
      type: [String, Number],
      required: true
    },
    isCurrentPage: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  methods: {
    onClick() {
      this.$emit("loadPage", this.pageNumber);
    }
  }
};
</script>