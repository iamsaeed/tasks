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

    <div class="grid grid-cols-1 mt-5">
        <div v-for="task in tasks">
            <Task class="my-1" :task="task" @del="getTasks" />
        </div>
    </div>

    <AddProject :open="openProject" @close="closeProject" />

    <AddTask :editTask="task" :open="openTask" @close="closeTask" />

    <AddTaskStatus :open="openTaskStatus" @close="closeTaskStatus" />

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
            task : null,
        }
    },
    created() {
      this.getProjects();
      this.getTasks();
    },
    methods : {

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
            axios.get('/get-tasks')
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
            this.getTasks();
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
