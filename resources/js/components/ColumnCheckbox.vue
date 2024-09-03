<template>
  <label class="flex items-center space-x-2">
    <input type="checkbox" v-model="isChecked" class="form-checkbox text-blue-600" />
    <span>{{ label }}</span>
  </label>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      required: true
    },
    modelValue: {
      type: Boolean,
      required: true
    }
  },
  computed: {
    isChecked: {
      get() {
        return this.modelValue;
      },
      set(value) {
        this.$emit('update:modelValue', value);
      }
    }
  }
};
</script>

<style scoped>
/* Add any custom styles here */
</style>
