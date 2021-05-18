import resource from "../../../../../../badaso/src/resources/js/api/resource";
import QueryString from "../../../../../../badaso/src/resources/js/api/query-string";

let apiPrefix = process.env.MIX_API_ROUTE_PREFIX
  ? "/" + process.env.MIX_API_ROUTE_PREFIX
  : "/badaso-api";

export default {
  browse(data = {}) {
    let ep = apiPrefix + "/v1/module/content";
    let qs = QueryString(data);
    let url = ep + qs;
    return resource.get(url);
  },

  read(data) {
    let ep = apiPrefix + "/v1/module/content/read";
    let qs = QueryString(data);
    let url = ep + qs;
    return resource.get(url);
  },

  fill(data) {
    return resource.put(apiPrefix + "/v1/module/content/fill", data);
  },

  edit(data) {
    return resource.put(apiPrefix + "/v1/module/content/edit", data);
  },

  add(data) {
    return resource.post(apiPrefix + "/v1/module/content/add", data);
  },

  delete(data) {
    let paramData = {
      data: data,
    };
    return resource.delete(apiPrefix + "/v1/module/content/delete", paramData);
  },

  deleteMultiple(data) {
    let paramData = {
      data: data,
    };
    return resource.delete(
      apiPrefix + "/v1/module/content/delete-multiple",
      paramData
    );
  },
};
