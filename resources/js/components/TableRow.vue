<template>
  <tr class="hover:bg-gray-50">
    <TableCell v-if="visibleColumns.title" :content="article.title" />
    <TableCell v-if="visibleColumns.source" :content="article.source.name" />
    <TableCell v-if="visibleColumns.publishedAt" :content="formattedDate(article.publishedAt)" />
    <TableCell v-if="visibleColumns.author" :content="article.author" />
    <TableCell v-if="visibleColumns.description" :content="article.description" />
    <TableCell v-if="visibleColumns.urlToImage" :content="article.urlToImage" type="image" :altText="article.title" />
    <TableCell v-if="visibleColumns.url" :content="article.url" type="link" displayText="Open Link" />
    <TableCell v-if="visibleColumns.content" :content="article.content" />
  </tr>
</template>

<script>
import TableCell from './TableCell.vue';

export default {
  components: {
    TableCell,
  },
  props: {
    article: Object,
    visibleColumns: Object,
  },
  methods: {
    formattedDate(date) {
      return new Date(date).toLocaleDateString();
    },
  },
};
</script>
