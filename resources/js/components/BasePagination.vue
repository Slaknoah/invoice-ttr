<template>
  <div class="base-pagination">
    <ul class="pagination">
      <li class="waves-effect" :disabled="isPreviousButtonDisabled" :class="{ disabled: isPreviousButtonDisabled}">
        <a  @click="!isPreviousButtonDisabled && previousPage()"><i class="material-icons">chevron_left</i></a>
      </li>

      <PaginationTrigger
        v-for="(paginationTrigger, index) in paginationTriggers"
        :key="index"
        :isCurrentPage="paginationTrigger == currentPage"
        :pageNumber="paginationTrigger"
        @loadPage="onloadPage"
      />

      <li class="waves-effect" :disabled="isNextButtonDisabled" :class="{ disabled: isNextButtonDisabled}" >
        <a @click="!isNextButtonDisabled && nextPage()"><i class="material-icons">chevron_right</i></a>
      </li>
    </ul>
  </div>
</template>

<script>
import PaginationTrigger from './PaginationTrigger';
export default {
  name: "BasePagination",
  props: {
    currentPage: {
      type: Number,
      required: true
    },
    pageCount: {
      type: Number,
      required: true
    },
    isAddDots: {
      type: Boolean,
      required: false
    },
    visiblePagesCount: {
      type: Number,
      default: 5
    }
  },
  computed: {
    isPreviousButtonDisabled() {
      return this.currentPage === 1;
    },
    isNextButtonDisabled() {
      return this.currentPage === this.pageCount;
    },
    paginationTriggers() {
      const currentPage = this.currentPage;
      const pageCount = this.pageCount;
      const visiblePagesCount =
        this.visiblePagesCount <= pageCount
          ? this.visiblePagesCount
          : pageCount;
      const visiblePagesThreshold = Math.ceil( (visiblePagesCount - 1) / 2 );
      const paginationTriggersArray = visiblePagesCount
        ? Array(visiblePagesCount - 1).fill(0)
        : [];

      // If selected page is smaller than half of the list width
      if (currentPage <= (visiblePagesThreshold + 1) ) {
        paginationTriggersArray[0] = 1;
        const paginationTriggers = paginationTriggersArray.map(
          (paginationTrigger, index) => {
            return paginationTriggersArray[0] + index;
          }
        );

        paginationTriggers.push(pageCount);

        return this.addDotsToPages(paginationTriggers);
      }

      // If selected page is greater than half of the selected list width, counting from the end
      if (currentPage >= pageCount - visiblePagesThreshold + 1) {
        const paginationTriggers = paginationTriggersArray.map(
          (paginationTrigger, index) => {
            return pageCount - index;
          }
        );
        paginationTriggers.reverse().unshift(1);

        return this.addDotsToPages(paginationTriggers);
      }

      // All other cases
      console.log(currentPage, visiblePagesThreshold);
      paginationTriggersArray[0] = currentPage - visiblePagesThreshold + 1;
      const paginationTriggers = paginationTriggersArray.map(
        (paginationTrigger, index) => {
          return paginationTriggersArray[0] + index;
        }
      );

      paginationTriggers.unshift(1);
      paginationTriggers[paginationTriggers.length - 1] = pageCount;

      // return this.addDotsToPages(paginationTriggers);
      return this.addDotsToPages(paginationTriggers);
    }
  },
  methods: {
    previousPage() {
      this.$emit("previousPage");
    },
    nextPage() {
      this.$emit("nextPage");
    },
    onloadPage(pageNumber) {
      this.$emit("loadPage", pageNumber);
    },
    addDotsToPages(pages) {
      if (this.isAddDots) {
        if (pages[1] !== 2) pages.splice(1, 0, "...");

        if (pages[pages.length - 2] !== pages[pages.length - 1] - 1)
          pages.splice(-1, 0, "...");
      }

      return pages;
    }
  },
  components: {PaginationTrigger}
};
</script>