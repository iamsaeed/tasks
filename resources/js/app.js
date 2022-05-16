window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
import Dashboard from "./components/Dashboard";
import ShowTask from "./components/tasks/Show";
import ProjectsIndex from "./components/projects/Index";
import TaskStatusesIndex from "./components/task_statuses/Index";

import { createApp } from "vue";

const app = createApp({
    components : {
        Dashboard, ShowTask, ProjectsIndex, TaskStatusesIndex
    }
}).mount("#app");
