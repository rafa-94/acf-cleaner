<template>
  <h1
    class="text-center text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate mb-10"
  >
    Orphan Meta Data
  </h1>
  <div class="flex justify-between">
    <div class="w-2/4">
      <Fields type="orphans" />
    </div>
    <div class="w-2/5">
      <Description title="What is an orphan meta data?">
        <p>
          The post metadata is the information you provide to viewers about each
          post, like author or category or any other custom field (ACF for
          example).
        </p>
        <p>
          In some cases the post is delete but this fields still presist in the
          database.
        </p>
        <p>
          They are then called orphan post meta and should be cleaned since they
          are not useful.
        </p>
      </Description>
    </div>
  </div>
</template>

<script>
import Description from "@/components/Description.vue";
import Fields from "@/components/Fields.vue";

export default {
  name: "Orphans",
  components: {
    Fields,
    Description,
  },
};
</script>
