<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
        <div class="md:col-span-2">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 text-gray-900 text-capitalize capitalize">{{ task.title }}</h3>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm text-gray-500">Status</dt>
                            <dd class="mt-1 text-sm text-gray-900 capitalize" v-if="task.task_status_id">{{ task.status.name }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm text-gray-500">Owner</dt>
                            <dd class="mt-1 text-sm text-gray-900 capitalize" v-if="task.created_id">{{ task.created_by.name }}</dd>
                        </div>

                        <div class="sm:col-span-2">
                            <dt class="text-sm text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900 capitalize">{{task.description}}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm text-gray-500 flex justify-between">
                                <div>Attachments</div>
                                <Upload model="Task" :id="id" @success="getTask" />
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 h-52 overflow-y-auto" v-if="task.images_count">
                                <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                    <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm" v-for="image in task.images">
                                        <div class="w-0 flex-1 flex items-center">
                                            <!-- Heroicon name: solid/paper-clip -->
                                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="ml-2 flex-1 w-0 truncate"> {{image.name}} </span>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <a :href="'/images/attachments/'+image.name" target="_blank" class="font-medium text-indigo-600 hover:text-indigo-500"> View </a>
                                        </div>
                                    </li>
                                </ul>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <AddComment model="Task" :id="id" :comments="task.comments" @success="getTask" :auth="auth" />
        </div>
    </div>
</template>

<script>
import Upload from "../images/Upload";
import AddComment from "../comments/AddComment";
export default {
    props : ['id', 'auth'],
    components : { Upload, AddComment },
    data(){
        return {
            task : '',
        }
    },
    created() {
        this.getTask();
    },
    methods : {
        getTask(){
            let _this = this;
            axios.get('/apis/getTask/'+_this.id)
                .then(response => {
                    _this.task = response.data.task;
                }).catch(error => {

            })
        }
    }
}
</script>
