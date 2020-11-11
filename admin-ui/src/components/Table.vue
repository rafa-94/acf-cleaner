<template>
  <div class="overflow-x-auto overflow-y-auto table-wrapper">
    <table
      class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative"
    >
      <thead>
        <tr class="text-left">
          <th
            class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100 w-px"
          >
            <label
              class="text-teal-500 hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer"
            >
              <input
                type="checkbox"
                class="form-checkbox focus:outline-none focus:shadow-outline"
              />
            </label>
          </th>
          <th
            class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs"
          >
            Field Name
          </th>
          <th
            class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs w-px"
          >
            Entries Found
          </th>
          <th
            class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs w-48 text-center"
          >
            Actions
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, key) in data" :key="key">
          <td class="border-dashed border-t border-gray-200 px-3 text-left">
            <label
              class="text-teal-500 hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer"
            >
              <input
                type="checkbox"
                class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline"
              />
            </label>
          </td>
          <td class="border-dashed border-t border-gray-200">
            <span class="text-gray-700 px-6 py-3 flex items-center">
              {{ key }}
            </span>
          </td>
          <td class="border-dashed border-t border-gray-200 text-center">
            <span class="text-gray-700 px-6 py-3">{{ item.length }}</span>
          </td>
          <td class="border-dashed border-t border-gray-200">
            <span
              class="text-gray-700 px-6 py-3 flex items-center justify-between"
            >
              <button class="text-blue-600 text-sm font-medium">
                View more
              </button>
              <button
                class="text-red-600 text-sm font-medium ml-2"
                @click="deleteField(item, key)"
              >
                Delete
              </button>
            </span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    data: Object,
  },
  setup(props, { emit }) {
    function deleteField(field, key) {
      emit("delete-item", field, key);
    }
    return {
      deleteField,
    };
  },
};
</script>

<style scoped>
.table-wrapper {
  height: 70vh;
}
</style>
