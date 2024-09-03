<template>
  <div class="mt-4 flex justify-between">
    <button @click="prevPage" :disabled="currentPage === 1" class="p-2 border rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50">Previous</button>
    <span>Page {{ currentPage }} of {{ totalPages }}</span>
    <button @click="nextPage" :disabled="currentPage === totalPages" class="p-2 border rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50">Next</button>
  </div>
</template>

<script>
export default {
  props: {
    currentPage: {
      type: Number,
      required: true,
    },
    totalPages: {
      type: Number,
      required: true,
    },
  },
  methods: {
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.$emit('update:currentPage', this.currentPage + 1);
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.$emit('update:currentPage', this.currentPage - 1);
      }
    },
  },
};
</script>

<style scoped>
/* Add any custom styles here */
</style>