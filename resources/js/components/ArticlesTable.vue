<template>
  <div class="p-6 bg-gray-100 min-h-screen">
    <div class="mb-6 space-x-4 flex flex-wrap items-center">
    <ColumnCheckbox v-model="visibleColumns.title" label="Title" />
    <ColumnCheckbox v-model="visibleColumns.source" label="Source" />
    <ColumnCheckbox v-model="visibleColumns.publishedAt" label="Published At" />
    <ColumnCheckbox v-model="visibleColumns.author" label="Author" />
    <ColumnCheckbox v-model="visibleColumns.description" label="Description" />
    <ColumnCheckbox v-model="visibleColumns.urlToImage" label="Image" />
    <ColumnCheckbox v-model="visibleColumns.url" label="URL" />
    <ColumnCheckbox v-model="visibleColumns.content" label="Content" />
  </div>
    <div class="mb-6 flex space-x-4">
      <input v-model="localSearchQuery" placeholder="Search articles..." class="p-3 border rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-600" />
      <button @click="handleSearch" class="p-3 border rounded bg-blue-500 text-white hover:bg-blue-600">Search</button>
      <button @click="clearFilters" class="p-3 border rounded bg-gray-500 text-white hover:bg-gray-600">Clear Filters</button>
      <select v-model="localSortBy" @change="handleSortByChange" class="p-3 border rounded bg-white">
        <option value="relevancy">Relevancy</option>
        <option value="popularity">Popularity</option>
        <option value="publishedAt">Published At</option>
      </select>
    </div>
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
      <table class="min-w-full bg-white border border-gray-200">
        <thead class="bg-gray-100">
    <tr>
      <TableColumn
        v-if="visibleColumns.title"
        label="Title"
        sortKey="title"
        :currentSortKey="sortKey"
        :sortOrder="sortOrders.title"
        @sort="sort"
      />
      <TableColumn
        v-if="visibleColumns.source"
        label="Source"
        sortKey="source.name"
        :currentSortKey="sortKey"
        :sortOrder="sortOrders['source.name']"
        @sort="sort"
      />
      <TableColumn
        v-if="visibleColumns.publishedAt"
        label="Published At"
        sortKey="publishedAt"
        :currentSortKey="sortKey"
        :sortOrder="sortOrders.publishedAt"
        @sort="sort"
      />
      <TableColumn
        v-if="visibleColumns.author"
        label="Author"
        sortKey="author"
        :currentSortKey="sortKey"
        :sortOrder="sortOrders.author"
        @sort="sort"
      />
      <TableColumn
        v-if="visibleColumns.description"
        label="Description"
        :isSortable="false"
      />
      <TableColumn
        v-if="visibleColumns.urlToImage"
        label="Image"
        :isSortable="false"
      />
      <TableColumn
        v-if="visibleColumns.url"
        label="URL"
        :isSortable="false"
      />
      <TableColumn
        v-if="visibleColumns.content"
        label="Content"
        :isSortable="false"
      />
    </tr>
  </thead>
        <tbody>
          <TableRow
            v-for="article in sortedArticles"
            :key="article.url"
            :article="article"
            :visibleColumns="visibleColumns"
          />
        </tbody>
      </table>
    </div>
    <Pagination :currentPage.sync="page" :totalPages="totalPages" @update:currentPage="handlePageChange" />
  </div>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'pinia';
import { useArticlesStore } from '../stores/articles';
import Pagination from './Pagination.vue';
import ColumnCheckbox from './ColumnCheckbox.vue';
import TableColumn from './TableColumn.vue';
import TableRow from './TableRow.vue';

export default {
  components: {
    Pagination,
    ColumnCheckbox,
    TableColumn,
    TableRow,
  },
  data() {
    return {
      visibleColumns: {
        title: true,
        source: true,
        publishedAt: true,
        author: true,
        description: true,
        urlToImage: true,
        url: true,
        content: true,
      },
      localSearchQuery: '',
      localSortBy: 'relevancy',
      sortKey: '',
      sortOrders: {
        title: 'asc',
        'source.name': 'asc',
        publishedAt: 'asc',
        author: 'asc',
      },
    };
  },
  computed: {
    ...mapState(useArticlesStore, ['articles', 'searchQuery', 'page', 'totalPages', 'pageSize', 'sortBy','columns']),
    ...mapGetters(useArticlesStore, ['filteredArticles']),
    sortedArticles() {
      if (!this.sortKey) return this.filteredArticles;
      return [...this.filteredArticles].sort((a, b) => {
        let result = 0;
        if (this.sortKey === 'source.name') {
          result = a.source.name.localeCompare(b.source.name);
        } else if (this.sortKey === 'publishedAt') {
          result = new Date(a.publishedAt) - new Date(b.publishedAt);
        } else {
          result = a[this.sortKey].localeCompare(b[this.sortKey]);
        }
        return this.sortOrders[this.sortKey] === 'asc' ? result : -result;
      });
    },
  },
  methods: {
    ...mapActions(useArticlesStore, ['fetchArticles', 'clearFilters', 'handlePageChange', 'updateSearchQuery', 'updateSortBy']),
    handleSearch() {
      this.updateSearchQuery(this.localSearchQuery);
      this.fetchArticles();
    },
    sort(key) {
      if (this.sortKey === key) {
        this.sortOrders[key] = this.sortOrders[key] === 'asc' ? 'desc' : 'asc';
      } else {
        this.sortKey = key;
        this.sortOrders[key] = 'asc';
      }
    },
    handleSortByChange() {
      this.updateSortBy(this.localSortBy);
    },
    formattedDate(date) {
      return new Date(date).toLocaleDateString();
    },
  },
 
  mounted() {
    this.localSearchQuery = this.searchQuery;
    this.localSortBy = this.sortBy;
    this.fetchArticles();
  },
};
</script>

<style scoped>
/* Add any custom styles here */
</style>