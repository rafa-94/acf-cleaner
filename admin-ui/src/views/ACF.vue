<template>
  <h1
    class="text-center text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate mb-10"
  >
    ACF Fields
  </h1>
  <div class="flex justify-between">
    <div class="w-2/4">
      <Fields type="acf" />
    </div>
    <div class="w-2/5">
      <Description title="Why delete this?">
        <p>
          This ACF Fields where deleted and but their data presists in the Post
          Meta table.
        </p>
        <p>
          The ACF will still use this data if a new ACF with the same
          <b>Field Name</b> is created and will update it values when editing
          the post with when that ACF Field was previously used.
        </p>
        <p>
          Only delete if you are sure that that data will no longer will be
          usefull which in most of the cases it will not be.
        </p>
      </Description>
    </div>
  </div>
</template>


<script>
import Fields from "@/components/Fields.vue";
import Description from "@/components/Description.vue";

export default {
  name: "ACF",
  components: {
    Fields,
    Description,
  },
};
</script>
