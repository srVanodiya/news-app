<!-- components/TableColumn.vue -->
<template>
  <th @click="sort" v-if="isSortable" class="py-3 px-4 border-b cursor-pointer hover:bg-gray-200">
    {{ label }}
    <span v-if="isSorted">
      <i :class="sortOrder === 'asc' ? 'fas fa-sort-up' : 'fas fa-sort-down'"></i>
    </span>
  </th>
  <th v-else class="py-3 px-4 border-b">
    {{ label }}
  </th>
</template>

<script>
export default {
  props: {
    label: String,
    sortKey: String,
    currentSortKey: String,
    sortOrder: String,
    isSortable: {
      type: Boolean,
      default: true,
    },
  },
  computed: {
    isSorted() {
      return this.sortKey === this.currentSortKey;
    },
  },
  methods: {
    sort() {
      if (this.isSortable) {
        this.$emit('sort', this.sortKey);
      }
    },
  },
};
</script>
