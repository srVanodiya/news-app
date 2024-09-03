<!-- components/TableCell.vue -->
<template>
  <td class="border px-4 py-2">
    <template v-if="type === 'image'">
      <img :src="content" :alt="altText" class="w-16 h-16 object-cover" />
    </template>
    <template v-else-if="type === 'link'">
      <a :href="content" target="_blank" class="text-blue-600 hover:underline">{{ displayText }}</a>
    </template>
    <template v-else>
      {{ content }}
    </template>
  </td>
</template>

<script>
export default {
  props: {
    content: String,
    type: {
      type: String,
      default: 'text', // 'text', 'image', 'link'
    },
    displayText: {
      type: String,
      default: '',
    },
    altText: {
      type: String,
      default: 'Image',
    },
  },
};
</script>
