<template>
    <slide-over :open="open" @close="close" :title="!isEditable ? 'Add Task' : 'Edit Task'">
        <div>
        <form class="space-y-3" @submit.prevent="addTask" method="post">

            <div>
                <label class="block text-sm font-medium text-gray-700"> Status </label>
                <div class="mt-1">
                    <select v-model="task.task_status_id" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option selected disabled value="">Select Status</option>
                        <option v-for="status in statuses" :value="status.id">{{status.name}}</option>
                    </select>
                    <small class="text-red-500 font-light" v-if="errors && errors.project_id">
                        <strong>{{errors.project_id[0]}}</strong>
                    </small>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700"> Project </label>
                <div class="mt-1">
                    <select v-model="task.project_id" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option selected disabled value="">Select Project</option>
                        <option v-for="project in projects" :value="project.id">{{project.name}}</option>
                    </select>
                    <small class="text-red-500 font-light" v-if="errors && errors.project_id">
                        <strong>{{errors.project_id[0]}}</strong>
                    </small>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700"> Title </label>
                <div class="mt-1">
                    <input placeholder="Title" v-model="task.title" autofocus type="text" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <small class="text-red-500 font-light" v-if="errors && errors.title">
                        <strong>{{errors.title[0]}}</strong>
                    </small>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700"> Description </label>
                <div class="mt-1">
                    <textarea
                        rows="10"
                        placeholder="Description"
                        v-model="task.description"
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    ></textarea>
                    <small class="text-red-500 font-light" v-if="errors && errors.description">
                        <strong>{{errors.description[0]}}</strong>
                    </small>
                </div>
            </div>

            <div>
                <button
                    type="submit"
                    :class="!isEditable ? 'bg-indigo-600 hover:bg-indigo-700  focus:ring-indigo-500' : 'bg-orange-500 hover:bg-orange-700  focus:ring-orange-500'"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2">
                    {{ !isEditable ? 'Add' : 'Update' }}
                </button>
            </div>
        </form>
    </div>
    </slide-over>
</template>

<script>
import SlideOver from "../resuable/SlideOver";

export default {
    props : {
        open : {
            default : false
        },
        isEditable : {
            default : false
        } ,
        project_id : {
            default : null
        },
        query : {
            default : ''
        }
    },
    components : { SlideOver },
    data(){
        return {
            statuses : [],
            projects : [],
            task: {
                title : '',
                description : '',
                project_id : '',
                task_status_id : ''
            },
            errors : '',
            success : '',
        }
    },
    computed : {

    },
    created() {
        this.getProjects();
        this.getTaskStatuses();
    },
    methods : {
        reset(){
            this.task = {
                title : '',
                description : '',
                project_id : 1,
                task_status_id : 1
            };
            this.errors = '';
            this.success = '';
        },
        close(){
           this.$emit('close')
        },
        getTaskStatuses(){
            let _this = this;
            axios.get('/api/get_active_task_statuses',).then(response => {
                _this.statuses = response.data.task_statuses;
            }).catch(error => {
                if(error.response.data.errors){
                    _this.errors = error.response.data.errors
                }
            })
        },
        getProjects(){
            let _this = this;
            axios.get('/api/get-active-projects').then(response => {
                _this.projects = response.data.projects;
            }).catch(error => {
                if(error.response.data.errors){
                    _this.errors = error.response.data.errors
                }
            })
        },
        addTask(){
            let _this = this;
            axios.post('/api/add-task', _this.task).then(response => {
                _this.reset();
                _this.close();
            }).catch(error => {
                if(error.response.data.errors){
                    _this.errors = error.response.data.errors
                }
            })
        }
    }
}
</script>
