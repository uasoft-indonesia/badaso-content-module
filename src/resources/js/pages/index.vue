<template>
  <component
    v-if="globalComponentList[defaultComponent]"
    v-bind:is="globalComponentList[defaultComponent]"
  ></component>
  <component v-else v-bind:is="defaultComponent"></component>
</template>

<script>
import ContentManagementAdd from "./content/add";
import ContentManagementBrowse from "./content/browse";
import ContentManagementEdit from "./content/edit";
import ContentManagementFill from "./content/fill";
import ContentManagementRead from "./content/read";

export default {
  components: {
    ContentManagementAdd,
    ContentManagementBrowse,
    ContentManagementEdit,
    ContentManagementFill,
    ContentManagementRead,
  },
  name: "BlogEntryIndex",
  data: () => ({
    globalComponentList: {},
    defaultComponent: null,
  }),
  mounted() {

    const routeName = this.$route.name;
    const componentName = this.$caseConvert.kebab(routeName);
    const slug = this.$route.params ? this.$route.params.slug : "";

    this.globalComponentList = this.constructor.superOptions.components;

    this.defaultComponent = componentName;
  },
  methods: {},
};
</script>
