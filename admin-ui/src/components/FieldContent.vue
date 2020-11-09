<template>
  <table class="table-fixed w-full">
    <thead>
      <tr>
        <th class="w-1/2 px-4 py-2">
          Content
        </th>
        <th class="w-1/2 px-4 py-2">
          Post
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(entrie, key) in field"
        :key="key"
      >
        <td class="border px-4 py-2 overflow-hidden word-break">
          {{ entrie.meta_value || 'Empty' }}
        </td>
        <td class="border px-4 py-2">
          {{ entrie.post_info.post_id }}
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  props: {
    field: {
      type: Object
    }
  },
  setup (props) {
    console.log(props.field)
  }
}
</script>
