<template>
  <div class="w-full lg:w-1/4 md:px-4 lg:px-6 py-5">
    <div class="bg-white hover:shadow-xl">
      <div class="px-4 py-4 md:px-5">
        <h1 class="font-bold text-lg break-words text-center">
          {{ name }}
        </h1>
        <h3 class="text-m break-words text-center pt-1">
          Found {{ field.length }} entries!
        </h3>
        <div class="flex flex-wrap pt-4 justify-between">
          <button class="text-blue-600 text-sm font-medium">
            View more
          </button>
          <button
            class="text-red-600 text-sm font-medium ml-2"
            @click="deleteAcf(field)"
          >
            {{ deleteing ? 'Deleting...' : 'Delete' }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
import { useDeleteAcfField } from '@/api/useAcfFields'

import FieldContent from '@/components/FieldContent.vue'

export default {
  name: 'FieldCard',
  components: {
    FieldContent
  },
  props: {
    field: {
      type: Object
    },
    name: {
      type: String
    }
  },
  setup (props, { emit }) {
    const deleting = ref(false)

    async function deleteAcf (field) {
      let ids = field.reduce((ids, curField) => {
        return ids + ',' + curField.meta_ids
      }, '')

      ids = ids.substr(1)

      const { error, result } = await useDeleteAcfField(ids)
      console.log('Delete Single:', result.value.data, error.value)
      emit('deleteacf', props.name)
    }

    return { deleting, deleteAcf }
  }
}
</script>
