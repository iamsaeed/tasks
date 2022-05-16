<template>
    <div>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Task Statuses</h1>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button @click="addTaskStatus" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                        Add
                    </button>
                </div>
            </div>
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="w-2/5 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tasks Count</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Owner</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"></th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="status in task_statuses">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 capitalize">{{ status.name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">{{ status.tasks_count }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <span v-if="status.created_id">
                                            {{ status.created_by.name }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ status.created_at }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <div class="flex">
                                            <PencilAltIcon @click="editTaskStatus(status)" class="w-5 h-5 text-orange-500 cursor-pointer" />
                                            <TrashIcon v-if="status.tasks_count" class="w-5 h-5 text-red-200 cursor-not-allowed" />
                                            <TrashIcon v-else @click="deleteTaskStatus(status)" class="w-5 h-5 text-red-500 cursor-pointer" />
                                        </div>
                                    </td>
                                </tr>

                                <!-- More people... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="openTaskStatus">
        <AddTaskStatus :task_status="taskStatus" :isEditable="isEditable" :open="openTaskStatus" @close="closeTaskStatus" />
    </div>
</template>

<script>
import { PencilAltIcon, TrashIcon } from '@heroicons/vue/solid'
import AddTaskStatus from "./AddTaskStatus";

export default {
    components : { PencilAltIcon, TrashIcon, AddTaskStatus },
    data(){
        return {
            task_statuses : [],
            taskStatus : '',
            isEditable : false,
            openTaskStatus : false
        }
    },
    created() {
        this.getTaskStatuses();
    },
    methods : {
        closeTaskStatus(){
            this.openTaskStatus = false;
            this.isEditable = false;
            this.getTaskStatuses();
        },
        addTaskStatus(){
            this.isEditable = false;
            this.taskStatus = '';
            this.openTaskStatus = true;
        },
        editTaskStatus(status){
            this.taskStatus = status;
            this.isEditable = true;
            this.openTaskStatus = true;
        },
        deleteTaskStatus(status){
            let _this = this;
            if(confirm('Are you sure, you want to delete this task status?')){
                axios.post('/delete-task-status', {id: status.id})
                    .then(response => {
                        _this.getTaskStatuses()
                    }).catch(error => {

                })
            }
        },
        getTaskStatuses(){
            let _this = this;
            axios.get('/get_task_statuses')
                .then(response => {
                    _this.task_statuses = response.data.task_statuses
                }).catch(error => {

            })
        },
    }
}
</script>
