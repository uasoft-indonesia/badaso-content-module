<template>
  <tfoot>
    <td v-show="show"></td>
    <td v-show="show">
      <badaso-text
        :placeholder="$t('content.fill.field.addField.label.placeholder')"
        v-model="field.label"
        size="12"
        :alert="$v.field.label.$error ? $t('vuelidate.required', [ $t('content.fill.field.addField.label.title')]) : ''"
      ></badaso-text>
    </td>
    <td v-show="show">
      <badaso-text
        :placeholder="$t('content.fill.field.addField.name.placeholder')"
        v-model="field.name"
        size="12"
        :alert="$v.field.type.$error ? [
          $v.field.name.required ? '' : $t('vuelidate.required', [ $t('content.fill.field.addField.name.title')]),
          $v.field.name.alphaNum ? '' : $t('vuelidate.alphaNum', [ $t('content.fill.field.addField.name.title')]),
          $v.field.name.nonNumericOnFirstChar ? '' : $t('vuelidate.nonNumericOnFirstChar'),
        ] : ''"
      ></badaso-text>
    </td>
    <td v-show="show">
      <badaso-select
        class="mb-0"
        :placeholder="$t('content.fill.field.addField.type.placeholder')"
        v-model="field.type"
        size="12"
        :items="getTypeContent"
        :alert="$v.field.type.$error ? $t('vuelidate.required', [$t('content.fill.field.addField.type.title')]): ''"
      ></badaso-select>
    </td>
    <td style="text-align: center;" :colspan="show ? 1 : 5">
      <vs-button
        color="primary"
        type="relief"
        @click="addItem()"
        :style="{'float': show ? 'left' : 'none'}"
      >
        <vs-icon icon="add"></vs-icon>
        {{ show ? $t("content.fill.button.save") : $t("content.fill.button.fill") }}
      </vs-button>
    </td>
  </tfoot>
</template>

<script>
import { required, alphaNum, helpers } from "vuelidate/lib/validators";

import contentHelper from '../utils/content-helper'

const nonNumericOnFirstChar = (value) => helpers.regex(value, /^(?![0-9_])\w+$/)

export default {
  name : "BadasoContentAddField",
  data: () => ({
    field: {
      name: "",
      label: "",
      type: "",
      data: "",
    },
    show: false
  }),
  computed: {
    getTypeContent: {
      get() {
        return contentHelper.getAllTypeContent();
      },
    },
  },
  validations() {
    return {
      field: {
        type: {
          required,
        },
        label: {
          required,
        },
        name: {
          required,
          alphaNum,
          nonNumericOnFirstChar: nonNumericOnFirstChar(this.field.name)
        },
      },
    }
  },
  watch: {
    show(val) {
      this.$emit('input', val)
    }
  },
  methods: {
    addItem() {
      if (this.show) {
        this.$v.field.$touch();
        if (!this.$v.field.$invalid) {
          if (this.field.type === 'group') {
            this.field.data = {};
          }

          if (this.field.type === 'array') {
            this.field.data = {};
          }

          if (this.field.type === 'text' || this.field.type === 'image') {
            this.field.data = "";
          }

          if (this.field.type === 'url') {
            this.field.data = {
              url: "",
              text: ""
            };
          }

          var key = this.field.name;
          var value = { ...this.field };
          this.$emit('click', { [key]: value });
          this.clearItem();
          this.$v.$reset();
          this.show = false
        }
      } else {
        this.show = true
      }
    },
    clearItem() {
      this.field.label = "";
      this.field.name = "";
      this.field.type = "";
    },
  },
};
</script>
