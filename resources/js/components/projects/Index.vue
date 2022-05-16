<template>
    <div>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Projects</h1>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button @click="addProject" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
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
                                <tr v-for="project in projects">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 capitalize">{{ project.name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">{{ project.tasks_count }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ project.created_by.name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ project.created_at }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                       <div class="flex">
                                           <PencilAltIcon @click="editProject(project)" class="w-5 h-5 text-orange-500 cursor-pointer" />
                                           <TrashIcon v-if="project.tasks_count" class="w-5 h-5 text-red-200 cursor-not-allowed" />
                                           <TrashIcon v-else @click="deleteProject(project)" class="w-5 h-5 text-red-500 cursor-pointer" />
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
    <div v-if="openProject">
        <AddProject :isEditable="isEditable" :project='project' :open="openProject" @close="closeProject" />
    </div>
</template>

<script>
import { PencilAltIcon, TrashIcon } from '@heroicons/vue/solid'
import AddProject from "./AddProject";

export default {
    components : { PencilAltIcon, TrashIcon, AddProject },
    data(){
        return {
            projects : [],
            openProject : false,
            project : '',
            isEditable : false
        }
    },
    created() {
        this.getProjects();
    },
    methods : {
        editProject(project){
            this.project = project;
            this.isEditable = true;
            this.openProject = true;
        },
        addProject(){
            this.isEditable = false
            this.openProject = true;
        },
        closeProject(){
          this.openProject = false
          this.getProjects()
        },
        getProjects(){
            let _this = this;
            axios.get('/get-projects')
            .then(response => {
                _this.projects = response.data.projects;
            }).catch(error => {

            })
        },
        deleteProject(project){
            let _this = this;
            if(confirm('Are you sure, you want to delete this project?')){
                axios.post('/delete-projects', {id: project.id})
                    .then(response => {
                        _this.getProjects()
                    }).catch(error => {

                })
            }
        }
    }
}
</script>
