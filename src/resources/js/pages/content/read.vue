<template>
  <div>
    <badaso-breadcrumb-row> </badaso-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('read_content')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ $t("content.read.title") }}</h3>
          </div>
          <vs-row>
            <badaso-text
              v-model="content.label"
              size="6"
              :label="$t('content.read.field.label.title')"
              :placeholder="$t('content.read.field.label.placeholder')"
              :alert="errors.label"
              readonly
            ></badaso-text>

            <badaso-text
              v-model="content.slug"
              size="6"
              :label="$t('content.read.field.slug.title')"
              :placeholder="$t('content.read.field.slug.placeholder')"
              :alert="errors.slug"
              readonly
            ></badaso-text>

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
                <tr :key="indextr" v-for="(tr, indextr) in content.json">
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
                        :src="$api.badasoFile.view(tr.data)"
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
          </vs-row>
        </vs-card>
      </vs-col>
    </vs-row>
    <vs-row v-else>
      <vs-col vs-lg="12">
        <vs-card>
          <vs-row>
            <vs-col vs-lg="12">
              <h3>{{ $t("content.warning.notAllowedToRead") }}</h3>
            </vs-col>
          </vs-row>
        </vs-card>
      </vs-col>
    </vs-row>
  </div>
</template>

<script>
export default {
  name: "ContentManagementRead",
  components: {},
  data: () => ({
    errors: {},
    content: {
      label: "",
      slug: "",
      json: {},
    },
  }),
  mounted() {
    this.getContent();
  },
  methods: {
    getContent() {
      this.$openLoader()
      this.$api.badasoContent
        .read({
          id: this.$route.params.id,
        })
        .then((response) => {
          this.$closeLoader();
          this.selected = [];
          this.content.label = response.data.content.label;
          this.content.slug = response.data.content.slug;
          this.content.json = JSON.parse(response.data.content.value)
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
  },
};
</script>

<style>
.drag_icon:hover {
  cursor: all-scroll;
}
.image-container {
  width: 200px !important;
}
</style>
