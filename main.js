import Vue from "vue";
//如果你需要引入的文件是通过npm或cnpm安装 import moduleName from filename
//如果你需要引入的文件不是通过cnpm或npm安装 import modulename from "路径+filename"
import root from "./template/root.vue";
import "./reset.css";
import axios from "axios";


Vue.prototype.$http = axios;

Vue.filter("toSex",function(val){

  return val==0?"男":"女";
});

Vue.filter("showMaleOrFemale",function(val){

});

const vm = new Vue({
  el:"#app",
  render:h=>h(root)
});
