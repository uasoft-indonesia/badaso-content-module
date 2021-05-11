<template>
  <div>
    <badaso-breadcrumb-row>
      <template slot="action">
        <vs-button
          color="primary"
          type="relief"
          :to="{ name: 'ContentManagementAdd' }"
          v-if="$helper.isAllowed('add_content')"
          ><vs-icon icon="add"></vs-icon> {{ $t("action.add") }}</vs-button
        >
        <vs-button
          color="danger"
          type="relief"
          v-if="selected.length > 0 && $helper.isAllowed('delete_content')"
          @click.stop
          @click="confirmDeleteMultiple"
          ><vs-icon icon="delete_sweep"></vs-icon>
          {{ $t("action.bulkDelete") }}</vs-button
        >
      </template>
    </badaso-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('browse_content')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ $t("content.title") }}</h3>
          </div>

          <badaso-table
            multiple
            v-model="selected"
            pagination
            max-items="10"
            search
            :data="contents"
            stripe
            description
            :description-items="descriptionItems"
            :description-title="$t('content.footer.descriptionTitle')"
            :description-connector="$t('content.footer.descriptionConnector')"
            :description-body="$t('content.footer.descriptionBody')"
          >
            <template slot="thead">
              <vs-th sort-key="label">
                {{ $t("content.header.label") }}
              </vs-th>
              <vs-th sort-key="slug">
                {{ $t("content.header.slug") }}
              </vs-th>
              <vs-th> {{ $t("content.header.action") }} </vs-th>
            </template>

            <template slot-scope="{ data }">
              <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                <vs-td :data="data[indextr].label">
                  {{ data[indextr].label }}
                </vs-td>

                <vs-td :data="data[indextr].slug">
                  {{ data[indextr].slug }}
                </vs-td>

                <vs-td style="width: 1%; white-space: nowrap">
                  <badaso-dropdown vs-trigger-click>
                      <vs-button
                        size="large"
                        type="flat"
                        icon="more_vert"
                      ></vs-button>
                      <vs-dropdown-menu>
                        <badaso-dropdown-item
                          icon="list"
                          v-if="$helper.isAllowed('fill_content')"
                          :to="{
                            name: 'ContentManagementFill',
                            params: { id: data[indextr].id },
                          }"
                        >
                          Fill Content
                        </badaso-dropdown-item>
                        <badaso-dropdown-item
                          icon="visibility"
                          v-if="$helper.isAllowed('read_content')"
                          :to="{
                            name: 'ContentManagementRead',
                            params: { id: data[indextr].id },
                          }"
                        >
                          Read
                        </badaso-dropdown-item>
                        <badaso-dropdown-item
                          icon="edit"
                          v-if="$helper.isAllowed('edit_content')"
                          :to="{
                            name: 'ContentManagementEdit',
                            params: { id: data[indextr].id },
                          }"
                        >
                          Edit
                        </badaso-dropdown-item>
                        <badaso-dropdown-item
                          icon="delete"
                          v-if="$helper.isAllowed('delete_content')"
                          @click="confirmDelete(data[indextr].id)"
                        >
                          Delete
                        </badaso-dropdown-item>
                      </vs-dropdown-menu>
                    </badaso-dropdown>
                </vs-td>
              </vs-tr>
            </template>
          </badaso-table>
        </vs-card>
      </vs-col>
    </vs-row>
    <vs-row v-else>
      <vs-col vs-lg="12">
        <vs-card>
          <vs-row>
            <vs-col vs-lg="12">
              <h3>{{ $t("content.warning.notAllowedToBrowse") }}</h3>
            </vs-col>
          </vs-row>
        </vs-card>
      </vs-col>
    </vs-row>
  </div>
</template>

<script>
export default {
  name: "ContentManagementBrowse",
  components: {},
  data: () => ({
    contents: [],
    selected: [],
    descriptionItems: [10, 50, 100],
    willDeleteId: null,
  }),
  mounted() {
    this.getContent();
  },
  methods: {
    confirmDelete(id) {
      this.willDeleteId = id;
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: `Confirm`,
        text: "Are you sure?",
        accept: this.deleteContent,
        cancel: () => {
          this.willDeleteId = null;
        },
      });
    },
    confirmDeleteMultiple(id) {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("action.delete.title"),
        text: this.$t("action.delete.text"),
        accept: this.bulkDeleteContent,
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => {},
      });
    },
    getContent() {
      this.$openLoader()
      this.$api.badasoContent
        .browse()
        .then((response) => {
          this.$closeLoader();
          this.selected = [];
          this.contents = response.data;
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
    deleteContent() {
      this.$openLoader()
      this.$api.badasoContent
        .delete({
          id: this.willDeleteId,
        })
        .then((response) => {
          this.$closeLoader();
          this.getContent();
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
    bulkDeleteContent() {
      const ids = this.selected.map((item) => item.id);
      this.$openLoader()
      this.$api.badasoContent
        .deleteMultiple({
          ids: ids.join(","),
        })
        .then((response) => {
          this.$closeLoader();
          this.getContent();
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