<template>
  <div>
    <badaso-breadcrumb-row> </badaso-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('fill_content')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ content.label }}</h3>
          </div>
          <vs-row>
            <badaso-text v-model="content.label" size="6" :label="$t('content.fill.field.label.title')"
              :placeholder="$t('content.fill.field.label.placeholder')" :alert="errors.label" readonly></badaso-text>

            <badaso-text v-model="content.slug" size="6" :label="$t('content.fill.field.slug.title')"
              :placeholder="$t('content.fill.field.slug.placeholder')" :alert="errors.slug" readonly></badaso-text>
          </vs-row>
        </vs-card>
      </vs-col>
      <vs-col>
        <vs-card>
          <div slot="header">
            <h3>{{ $t("content.fill.title") }}</h3>
          </div>
          <vs-row vs-justify="center" vs-align="end">
            <template v-for="(item, index) in content.json">
              <!-- TEXT TYPE -->
              <badaso-text :key="index" v-if="item.type === 'text'" :label="item.label" :placeholder="item.label"
                v-model="item.data" size="12"></badaso-text>

              <!-- IMAGE TYPE -->
              <badaso-upload-image :key="index" v-if="item.type === 'image'" :label="item.label" v-model="item.data"
                :placeholder="item.label" size="12"></badaso-upload-image>

              <!-- URL TYPE -->
              <vs-col class="mb-2" vs-lg="12" vs-xs="12" :key="index" v-if="item.type === 'url'">
                <span class="ml-1">{{ item.label }}</span>
                <vs-row class="mt-2">
                  <badaso-text label="Text" placeholder="Text" v-model="item.data.text" size="6" class="pr-2 p-0">
                  </badaso-text>
                  <badaso-text label="URL" placeholder="URL" v-model="item.data.url" size="6" class="p-0"></badaso-text>
                </vs-row>
              </vs-col>

              <!-- GROUP TYPE -->
              <vs-col :key="index" vs-lg="12" vs-xs="12" v-if="item.type === 'group'">
                <h3 class="my-2">{{ item.label }}</h3>
                <badaso-content-fill :items="item.data"></badaso-content-fill>
              </vs-col>

              <!-- ARRAY TYPE -->
              <vs-col :key="index" vs-lg="12" vs-xs="12" v-if="item.type === 'array'" style="margin-bottom: 20px;">
                <h3 class="my-2">{{ item.label }}</h3>
                <div>
                  <badaso-content-fill :items="item"></badaso-content-fill>
                </div>
                  <vs-button color="primary" type="relief" @click="addNewItem(item.data, item.data)"
                    :style="{'left' : 'none'}">
                    <vs-icon icon="add"></vs-icon>
                    {{ $t("content.fill.button.fill") }}
                  </vs-button>
              </vs-col>
            </template>
          </vs-row>
        </vs-card>
      </vs-col>
      <vs-col vs-lg="12">
        <vs-card>
          <vs-row>
            <vs-col vs-lg="12">
              <vs-button color="primary" type="relief" @click="submitForm">
                <vs-icon icon="save"></vs-icon>
                {{ $t("content.fill.button.save") }}
              </vs-button>
            </vs-col>
          </vs-row>
        </vs-card>
      </vs-col>
    </vs-row>
    <vs-row v-else>
      <vs-col vs-lg="12">
        <vs-card>
          <vs-row>
            <vs-col vs-lg="12">
              <h3>{{ $t("content.warning.notAllowedToFill") }}</h3>
            </vs-col>
          </vs-row>
        </vs-card>
      </vs-col>
    </vs-row>
  </div>
</template>

<script>
export default {
  name: "ContentManagementFill",
  components: {},
  data: () => ({
    errors: {},
    content: {
      label: "",
      slug: "",
      json: {},
    },
    windowWidth: window.innerWidth,
    viewType: "desktop",
    field: undefined,
  }),
  beforeDestroy() {
    window.removeEventListener("resize", this.handleWindowResize);
  },
  mounted() {
    this.getContent();
    this.$nextTick(() => {
      window.addEventListener("resize", this.handleWindowResize);
    });
    this.setViewType();
  },
  methods: {
    submitForm() {
      this.$openLoader();
      this.$api.badasoContent
        .fill({
          id: this.$route.params.id,
          slug: this.content.slug,
          label: this.content.label,
          value: this.content.json,
        })
        .then((response) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.success"),
            text: response.message,
            color: "success",
          });
          this.$router.push({ name: "ContentManagementBrowse" });
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
    getContent() {
      this.$openLoader();
      this.$api.badasoContent
        .read({
          id: this.$route.params.id,
          filtered: false,
        })
        .then((response) => {
          this.$closeLoader();
          this.selected = [];
          this.content.label = response.data.content.label;
          this.content.slug = response.data.content.slug;
          this.content.json = response.data.content.value;
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
    handleWindowResize(event) {
      this.windowWidth = event.currentTarget.innerWidth;
      this.setViewType();
    },
    setViewType() {
      if (this.windowWidth < 768) {
        this.viewType = this.$constants.MOBILE;
      } else {
        this.viewType = this.$constants.DESKTOP;
      }
    },
    addNewItem(parent, value) {
        let data = JSON.parse(JSON.stringify(value[0]))
        for(let item in data){
          if(data[item].type == 'url' || data[item].type == 'group'){
              for(let key in data[item].data){
                data[item].data[key] = ''
              }
          }else{
            data[item].data = ''
          }
        }
      parent.splice(parent.length + 1, 0, data);
    },
  },
};
</script>

<style>
.drag_icon:hover {
  cursor: all-scroll;
}
</style>
