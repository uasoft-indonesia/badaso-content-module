<template>
  <vs-row class="mb-0" style="border-left: 5px solid var(--primary)" vs-justify="center" vs-align="center">
    <template v-if="items.type == 'array'">
      <vs-col vs-lg="12" vs-xs="12" class="mb-0" v-for="(groupItems, index) in items.data" :key="index"
        style="padding: 0 0 0 15px">
          <table class="badaso-table">
            <tbody>
              <td>
                <vs-col v-for="(groupItem, indexx) in groupItems" :key="indexx">
                  <badaso-text v-if="groupItem.type === 'text'" :label="groupItem.label" :placeholder="groupItem.label"
                    v-model="groupItem.data" size="12"></badaso-text>
                  <badaso-upload-image v-if="groupItem.type === 'image'" :label="groupItem.label"
                    :placeholder="groupItem.label" v-model="groupItem.data" size="12"></badaso-upload-image>
                  <vs-col class="mb-2" vs-lg="12" vs-xs="12" v-if="groupItem.type === 'url'">
                    <span class="ml-1">{{ groupItem.label }}</span>
                    <vs-row class="mt-2">
                      <badaso-text label="Text" placeholder="Text" v-model="groupItem.data.text" size="6" class="pr-2 p-0">
                      </badaso-text>
                      <badaso-text label="URL" placeholder="URL" v-model="groupItem.data.url" size="6" class="p-0">
                      </badaso-text>
                    </vs-row>
                  </vs-col>
                  <vs-col :key="index" vs-lg="12" vs-xs="12" v-if="groupItem.type === 'group'">
                    <h3 class="my-2">{{ groupItem.label }}</h3>
                    <badaso-content-fill :items="groupItem.data"></badaso-content-fill>
                  </vs-col>
                  <vs-col :key="index" vs-lg="12" vs-xs="12" v-if="groupItem.type === 'array'">
                    <h3 class="my-2">{{ groupItem.label }}</h3>
                    <badaso-content-fill :items="groupItem.data"></badaso-content-fill>
                  </vs-col>
                </vs-col>
              </td>
              <td style="vertical-align: middle; width: 20%;">
                <vs-button
                     color="primary"
                     type="relief"
                     @click="openCopyItemDialog(items.data, index)"
                   >
                     <vs-icon icon="content_copy"></vs-icon>
                   </vs-button>
           
               <vs-button  color="danger" type="relief" @click="dropItem(index)" :disabled="index === 0">
                 <vs-icon icon="delete"></vs-icon>
               </vs-button>
             
               <vs-button
                     color="warning"
                     type="relief"
                     @click="moveUp(index)"
                     v-if="items.data.length > 1"
                     :disabled="index === 0"
                   >
                     <vs-icon icon="expand_less"></vs-icon>
                   </vs-button>
            
                 <vs-button
                     color="warning"
                     type="relief"
                     @click="moveDown(index)"
                     v-if="items.data.length > 1"
                     :disabled="index === Object.values(items.data).length - 1"
                   >
                     <vs-icon icon="expand_more"></vs-icon>
                 </vs-button>
              </td>
            </tbody>
        </table>
      </vs-col>
    </template>
    <template v-else>
      <vs-col vs-lg="12" vs-xs="12" class="mb-0" v-for="(groupItem, index) in items" :key="index"
        style="padding: 0 0 0 15px;">
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
    </template>
  </vs-row>
</template>

<script>
export default {
  name: "BadasoContentFill",
  components: {},
  props: {
    items: {
      type: Object,
      required: true,
    },
  },
  methods: {
    dropItem(index) {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("action.delete.title"),
        text: this.$t("action.delete.text"),
        accept: () => this.$delete(this.items.data, index),
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => { },
      });
    },
    openCopyItemDialog(item, index) {
      let data = JSON.parse(JSON.stringify(item[index]))
      item.splice(item.length + 1, 0, data);
    },
    moveDown(index) {
      const temp = [];
      for (const item in this.items.data) {
        if (Object.hasOwnProperty.call(this.items.data, item)) {
          temp.push(this.items.data[item]);
        }
      }
      [temp[index], temp[index + 1]] = [temp[index + 1], temp[index]];

      this.items.data = temp;
    },
    moveUp(index) {
      const temp = [];
      for (const item in this.items.data) {
        if (Object.hasOwnProperty.call(this.items.data, item)) {
          temp.push(this.items.data[item]);
        }
      }
      [temp[index], temp[index - 1]] = [temp[index - 1], temp[index]];

      this.items.data = temp;
    },
    convertArrayToObject(array, key) {
      const initialValue = {};
      return array.reduce((obj, item) => {
        return {
          ...obj,
          [item[key]]: item,
        };
      }, initialValue);
    },
  }
};
</script>
