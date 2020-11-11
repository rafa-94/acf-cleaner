<template>
  <h3
    class="text-center text-lg font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate"
  >
    {{ title }}
  </h3>
  <div class="p-5">
    <slot />
  </div>
</template>

<script>
export default {
  props: {
    title: String,
  },
};
</script>
