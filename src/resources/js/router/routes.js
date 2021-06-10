import Pages from "./../pages/index.vue";

let prefix = process.env.MIX_ADMIN_PANEL_ROUTE_PREFIX
  ? "/" + process.env.MIX_ADMIN_PANEL_ROUTE_PREFIX
  : "/badaso-dashboard";

export default [
  {
    path: prefix + "/content",
    name: "ContentManagementBrowse",
    component: Pages,
    meta: {
      title: "Content Manager",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/content/:id/read",
    name: "ContentManagementRead",
    component: Pages,
    meta: {
      title: "Detail Content",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/content/:id/fill",
    name: "ContentManagementFill",
    component: Pages,
    meta: {
      title: "Fill the Content",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/content/:id/edit",
    name: "ContentManagementEdit",
    component: Pages,
    meta: {
      title: "Edit Content",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/content/add",
    name: "ContentManagementAdd",
    component: Pages,
    meta: {
      title: "Add Content",
      useComponent: "AdminContainer",
    },
  },
];
