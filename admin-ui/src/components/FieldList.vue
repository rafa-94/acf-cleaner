<template>
  <div v-if="error">
    {{ error }}
  </div>
  <div v-else>
    <div v-if="fields.length < 1">
      <div class="text-2xl leading-8 text-center mt-8">
        Congratulations 🥳🥳 There is no unused ACF Fields!
      </div>
    </div>

    <div v-else class="m-5 px-6 flex">
      <button
        class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        @click="deleteAllAcf"
      >
        {{ isDeleting ? "Deleting..." : "Delete All" }}
      </button>
    </div>
    <div class="flex flex-wrap px-6">
			<div class="fixed bg-gray-100 bg-opacity-25 w-full h-full" v-if="isDeleting"></div>
      <FieldCard
        v-for="(field, key) in fields"
        :key="key"
        :field="field"
        :name="key"
        @deleteacf="deleteAcf"
      />
    </div>
  </div>
</template>

<script>
import { ref } from "vue";
import { useGetAcfFields, useDeleteAcfField } from "@/api/useAcfFields";

import FieldCard from "@/components/FieldCard.vue";

export default {
  name: "FieldList",
  components: {
    FieldCard,
  },
  async setup() {
    const isDeleting = ref(false);
    const { error, fields } = await useGetAcfFields();

    function deleteAcf(name) {
      delete fields.value[name];
    }

    async function deleteAllAcf() {
			isDeleting.value = true;

      let ids = Object.values(fields.value).reduce((accIds, curField) => {
        let meta_ids = curField.reduce((accId, curMeta) => {
          return accId + "," + curMeta.meta_ids;
        }, "");

        meta_ids = meta_ids.substr(1);

        return accIds + "," + meta_ids;
      }, "");

      ids = ids.substr(1);

      const { error, result } = await useDeleteAcfField(ids);
      console.log("Delete:", result.value.data, error.value);

      if (!error.value) {
				isDeleting.value = false;
        fields.value = [];
      }
    }

    return { isDeleting, error, fields, deleteAcf, deleteAllAcf };
  },
};
</script>
