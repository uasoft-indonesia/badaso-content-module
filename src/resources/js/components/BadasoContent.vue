<template>
  <div :style="tableStyles">
    <table class="w-100">
      <tbody>
        <template v-for="(item, key, index) in items.data">
          <tr :key="items.name + '-' + key">
            <td style="vertical-align: inherit;">
              <vs-icon icon="chevron_right" :class="{'expandable rotate': opened.includes(index), 'expandable': !opened.includes(index)}" @click="toggle(index)" v-if="contentHelper.isMultipleFields(item)"></vs-icon>
            </td>
            <td>
              <badaso-text
                v-model="item.label"
                size="12"
                :label="$t('content.add.field.content.label.title')"
                :placeholder="$t('content.add.field.content.label.placeholder')"
              ></badaso-text>
            </td>
            <td>
              <badaso-text
                v-model="item.name"
                size="12"
                :label="$t('content.add.field.content.name.title')"
                :placeholder=" $t('content.add.field.content.name.placeholder')"
                disabled
              ></badaso-text>
            </td>
            <td>
              <badaso-select
                v-model="item.type"
                size="12"
                :label="$t('content.add.field.content.type')"
                :items="fieldList"
                :value="field.type"
                @input="changeDataType(item, $event)"
              ></badaso-select>
            </td>
            <td style="vertical-align: inherit;">
              <vs-button
                color="primary"
                type="relief"
                @click="openCopyItemDialog(item)"
              >
                <vs-icon icon="content_copy"></vs-icon>
              </vs-button>
              <vs-button
                color="danger"
                type="relief"
                @click="dropItem(items, key)"
              >
                <vs-icon icon="delete"></vs-icon>
              </vs-button>
            </td>
          </tr>
          <tr :key="items.name + '-' + key + '-opened'" v-if="opened.includes(index)">
            <td colspan="5" class="clear-td">
              <badaso-content :items="item" v-model="invalid"></badaso-content>
            </td>
          </tr>
        </template>
      </tbody>
      <badaso-content-add-field v-model="invalid" @click="addItem($event, items)"></badaso-content-add-field>
    </table>
    <vs-prompt
      color="primary"
      @cancel="copyItemName = ''"
      @accept="copyItem"
      @close="willCopyItem = {}; copyItemName = ''"
      :is-valid="validName"
      :active.sync="copyItemDialog">
      <div class="con-exemple-prompt">
        <badaso-text
          v-model="copyItemName"
          size="12"
          :label="$t('content.add.field.content.name.title')"
          :placeholder=" $t('content.add.field.content.name.placeholder')"
        ></badaso-text>
      </div>
    </vs-prompt>
  </div>
</template>

<script>
import * as _ from 'lodash'
import contentHelper from '../utils/content-helper'

export default {
  name: "BadasoContent",
  components: {},
  data: () => ({
    opened: [],
    errors: {},
    field: [],
    padding: 0,
    willCopyItem: {},
    copyItemDialog: false,
    copyItemName: "",
    invalid: false,
    contentHelper
  }),
  props: {
    items: {
      type: Object,
      required: true,
    },
  },
  watch: {
    invalid(val) {
      this.$emit('input', val)
    }
  },
  computed: {
    validName() {
      return this.copyItemName.length > 0
    },
    fieldList: {
      get() {
        return contentHelper.getAllTypeContent();
      },
    },
    tableStyles() {
      let pl = this.padding + 15;
      this.padding = pl
      return {
        "padding-left": pl + "px",
        "margin-bottom": "0.5rem",
        "border-left": "5px solid var(--primary)"
      }
    }
  },
  methods: {
    isMultipleFields(item) {
      item.type === 'group' ? true : false
    },
    changeDataType(item, event) {
      if (item.type === 'group' || item.type === 'image') {
        item.data = {};
      }

      if (item.type === 'text') {
        item.data = "";
      }

      if (item.type === 'url') {
        item.data = {
          url: "",
          text: ""
        };
      }
    },
    addItem(event, items) {
      this.$set(items.data, Object.keys(event), Object.values(event)[0])
    },
    toggle(index) {
      if (this.opened.includes(index)) {
        let idx = this.opened.indexOf(index)
        this.opened.splice(idx, 1)
      } else {
        this.opened.push(index)
      }
    },
    dropItem(items, key) {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("action.delete.title"),
        text: this.$t("action.delete.text"),
        accept: () => this.$delete(items.data, key),
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => {},
      });
    },
    copyItem() {
      let item = _.cloneDeep({
        ...this.willCopyItem,
        label: "",
        name: this.copyItemName,
      });
      this.$set(this.items.data, this.copyItemName, item);
      this.copyItemName = '';
    },
    openCopyItemDialog(item) {
      this.willCopyItem = item
      this.copyItemDialog = true
    }
  },
};
</script>

<style>
.drag_icon:hover {
  cursor: all-scroll;
}
.expandable {
  cursor: pointer;
  user-select: none;
  animation: all 5s;
  display: inline-block;
}
.rotate {
  transform: rotate(90deg);
}
.clear-td {
  padding: 0 !important;
  border-top: none !important;
}
</style>