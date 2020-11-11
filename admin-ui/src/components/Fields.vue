<template>
  <div v-if="isLoading">Is Loading....</div>
  <div v-else-if="fields.data.length < 1">
    <h1 class="text-2xl leading-8 text-center mt-8">
      Congratulations 🥳🥳 There is no unused ACF Fields!
    </h1>
  </div>
  <div v-else>
    <div class="mb-4 flex justify-between items-center">
      <div class="flex-1 pr-4">
        <div class="relative md:w-1/3">
          <input
            type="text"
            class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
            placeholder="Search..."
            v-model="searchQuery"
          />
        </div>
      </div>
      <button
        class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        @click="deleteAllFields"
      >
        Delete All
      </button>
    </div>
    <Table :data="filteredFields" @delete-item="deleteItem" />
  </div>
</template>

<script>
import { computed, ref, watch } from "vue";
import { useGetAllFields, useDeleteFields } from "@/api/useFields";

import Table from "@/components/Table.vue";

function useFilterFields(fields, query) {
  return computed(() => {
    if (query.value === "") {
      return fields.value.data;
    }

    let res = Object.keys(fields.value.data)
      .filter((key) => key.includes(query.value))
      .reduce((obj, key) => {
        obj[key] = fields.value.data[key];
        return obj;
      }, {});

    return res;
  });
}

export default {
  props: {
    type: String,
  },
  components: {
    Table,
  },
  setup(props) {
    const searchQuery = ref("");
    const { isLoading, error, fields, getAllFields } = useGetAllFields(
      props.type
    );

    //Init Get Data
    //This === do the same in onmounted
    watch(getAllFields);

    const filteredFields = useFilterFields(fields, searchQuery);

    function deleteItem(field, key) {
      let ids = field.map((data) => data.meta_ids).join(",");

      const { result, error, deleteFields } = useDeleteFields(props.type, ids);
      watch(async () => {
        await deleteFields();
        console.log(result, error);
        if (error.value === null) {
          delete filteredFields.value[key];
        }
      });
    }

    function deleteAllFields() {
      let ids = Object.values(fields.value.data)
        .map((field) => field.map((data) => data.meta_ids))
        .join(",");

      const { result, error, deleteFields } = useDeleteFields(props.type, ids);
      watch(async () => {
        await deleteFields();
        console.log(result, error);
        if (error.value === null) {
          await getAllFields();
        }
      });
    }

    return {
      isLoading,
      error,

      fields,
      searchQuery,
      filteredFields,

      deleteItem,
      deleteAllFields,
    };
  },
};
</script>
