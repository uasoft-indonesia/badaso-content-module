<template>
  <table class="w-100 table">
    <thead>
      <th sort-key="label" style="width: 200px">
        {{ $t("content.header.label") }}
      </th>
      <th sort-key="data" style="width: auto">
        {{ $t("content.header.data") }}
      </th>
    </thead>

    <tbody>
      <tr :key="indextr" v-for="(tr, indextr) in items">
        <td>{{ tr.label }}</td>
        <td>
          <template v-if="tr.type === 'text'">
            <p v-if="tr.data" class="mb-0">
              {{ tr.data }}
            </p>
            <p v-else class="is-italic is-gray mb-0">Empty</p>
          </template>
          <template v-if="tr.type === 'image'">
            <img
              v-if="tr.data"
              :src="tr.data"
              :alt="tr.data"
              class="image-container"
            />
            <p v-else class="is-italic is-gray mb-0">Empty</p>
          </template>
          <template v-if="tr.type === 'url'">
            <vs-row class="mb-0">
              <vs-col vs-w="6" class="p-0">
                <a v-if="tr.data" class="mb-0" :href="tr.data.url">{{ tr.data.text }}</a>
                <p v-else class="is-italic is-gray mb-0">Empty</p>
              </vs-col>
            </vs-row>
          </template>
          <template v-if="tr.type === 'group'">
            <badaso-content-read :items="tr.data"></badaso-content-read>
          </template>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "BadasoContentRead",
  components: {},
  props: {
    items: {
      type: Object,
      required: true
    },
  }
}
</script>