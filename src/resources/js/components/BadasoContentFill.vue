<template>
  <vs-row class="mb-0" style="border-left: 5px solid var(--primary)" vs-justify="center" vs-align="center">
    <vs-col vs-lg="12" vs-xs="12" class="mb-0" v-for="(groupItem, index) in items" :key="index"
      style="padding: 0 0 0 15px">
      <badaso-text v-if="groupItem.type === 'text'" :label="groupItem.label" :placeholder="groupItem.label"
        v-model="groupItem.data" size="12"></badaso-text>
      <badaso-upload-image v-if="groupItem.type === 'image'" :label="groupItem.label" :placeholder="groupItem.label"
        v-model="groupItem.data" size="12"></badaso-upload-image>
      <vs-col class="mb-2" vs-lg="12" vs-xs="12" v-if="groupItem.type === 'url'">
        <span class="ml-1">{{ groupItem.label }}</span>
        <vs-row class="mt-2">
          <badaso-text label="Text" placeholder="Text" v-model="groupItem.data.text" size="6" class="pr-2 p-0">
          </badaso-text>
          <badaso-text label="URL" placeholder="URL" v-model="groupItem.data.url" size="6" class="p-0"></badaso-text>
        </vs-row>
      </vs-col>
      <vs-col :key="index" vs-lg="12" vs-xs="12" v-if="groupItem.type === 'group'">
        <h3 class="my-2">{{ groupItem.label }}</h3>
        <badaso-content-fill :items="groupItem.data"></badaso-content-fill>
      </vs-col>
      <vs-col :key="index" vs-lg="12" vs-xs="12" v-if="groupItem.type === 'array'">
        <h3 class="my-2">{{ groupItem.data }}</h3>
        <badaso-content-fill :items="groupItem.data"></badaso-content-fill>
      </vs-col>
    </vs-col>
  </vs-row>
</template>

<script>
export default {
  name: "BadasoContentFill",
  components: {},
  props: {
    type: null,
    items: {
      type: Object,
      required: true,
    },
  },
  };
</script>