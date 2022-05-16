<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Task Management</h1>
            </div>
            <div class="flex flex-col gap-1 md:flex-row">
                <button @click="addProject" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Add Project
                </button>
                <button @click="addTask" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Add Task
                </button>
                <button @click="addTaskStatus" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Add Task Status
                </button>
            </div>
        </div>
    </div>

    <div class="px-4 sm:px-6 lg:px-8">
        <div>
            <label class="block text-sm font-medium text-gray-700"> Filter Projects </label>
            <div class="mt-1">
                <select @change="handleProjectChange" v-model="project_id" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Show All</option>
                    <option v-for="project in projects" :value="project.id">{{project.name}}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 mt-5">
        <div v-for="task in tasks">
            <div v-if="task">
                <Task class="my-1" :task="task" @del="getTasks" @edit="editTask" />
            </div>
        </div>
    </div>

    <div v-if="openProject">
        <AddProject :open="openProject" @close="closeProject" />
    </div>

    <div v-if="openTask">
        <AddTask :editTask="task" :isEditable="isEditable" :open="openTask" @close="closeTask" />
    </div>

    <div v-if="openTaskStatus">
        <AddTaskStatus :open="openTaskStatus" @close="closeTaskStatus" />
    </div>

</template>

<script>
import AddProject from "./projects/AddProject";
import AddTask from "./tasks/AddTask";
import AddTaskStatus from "./task_statuses/AddTaskStatus";
import Task from "./tasks/Task"

export default {
    components : { AddProject, AddTask, AddTaskStatus, Task },
    data(){
        return {
            openProject : false,
            openTask : false,
            openTaskStatus : false,
            projects : [],
            tasks : [],
            task : {},
            isEditable : false,
            project_id: ''
        }
    },
    created() {
      this.getProjects();
      this.getTasks();
    },
    methods : {
        handleProjectChange(){
            this.getTasks();
        },
        getProjects(){
            let _this = this;
            axios.get('/get-projects')
            .then(response => {
                _this.projects = response.data.projects;
            }).catch(error => {

            })
        },
        getTasks(){
            let _this = this;
            axios.get('/get-tasks/?project_id='+this.project_id)
                .then(response => {
                    _this.tasks = response.data.tasks;
                }).catch(error => {

            })
        },
        addProject(){
            this.openProject = true;
        },
        closeProject(){
            this.openProject = false;
            this.getProjects();
        },
        addTask(){
            this.openTask = true;
        },
        closeTask(){
            this.openTask = false;
            this.isEditable = false;
            this.task = '';
            this.getTasks();
        },
        editTask(task){
          this.task = task;
          this.openTask = true;
          this.isEditable = true;
        },
        addTaskStatus(){
            this.openTaskStatus = true;
        },
        closeTaskStatus(){
            this.openTaskStatus = false;
            this.getTasks();
        }
    }
}
</script>
