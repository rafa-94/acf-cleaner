<template>
  <div class="home">
    <h1
      class="text-center text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate"
    >
      Unused ACF Fields
    </h1>
    <div v-if="error">
      Error
    </div>
    <Suspense v-else>
      <template #default>
        <FieldList />
      </template>
      <template #fallback>
        <div>Loading ACFs</div>
      </template>
    </Suspense>
  </div>
</template>

<script>
import FieldList from '@/components/FieldList.vue'
import { onErrorCaptured, ref } from 'vue'

export default {
  name: 'Home',
  components: {
    FieldList
  },
  setup () {
    const error = ref(null)

    onErrorCaptured((e) => {
      error.value = e
    })
  }
}
</script>
