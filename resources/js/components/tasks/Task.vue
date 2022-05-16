<template>
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul role="list" class="divide-y divide-gray-200">
            <li>
                <a href="#" @click="goTo(task)" class="block hover:bg-gray-50">
                    <div class="px-4 py-4 flex items-center sm:px-6">
                        <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                            <div class="truncate">
                                <div class="flex text-sm">
                                    <p class="text-indigo-600 truncate">{{ task.title }}</p>
                                </div>
                                <div class="mt-2 flex">
                                    <div class="flex-row items-center text-sm text-gray-500">
                                        <p> {{ task.description }} </p>
                                        <p v-if="task.ends_at"> Deadline: {{ task.ends_at }} </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 flex-shrink-0 sm:mt-0 sm:ml-5">
                                <div class="flex overflow-hidden space-x-1">
                                    <PencilIcon @click.stop="editTask()" class="flex-shrink-0 mr-1.5 h-5 w-5 text-orange-500 cursor-pointer" />
                                    <TrashIcon @click.stop="deleteTask()" class="flex-shrink-0 mr-1.5 h-5 w-5 text-red-500 cursor-pointer" />
                                    <CalendarIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" />
                                    <p class="ml-1 flex-shrink-0 font-normal text-gray-500 text-sm">{{task.created_at}}</p>
                                 </div>
                            </div>
                        </div>
                        <div class="ml-5 flex-shrink-0">
                            <ChevronRightIcon class="h-5 w-5 text-gray-400" />
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
import { ChevronRightIcon, TrashIcon, PencilIcon } from "@heroicons/vue/solid"
import { CalendarIcon, } from "@heroicons/vue/solid"
import AddTask from "./AddTask";

export default {
    props : {
      task : {
          type : Object
      },
    },
    components : { ChevronRightIcon, CalendarIcon, TrashIcon, PencilIcon, AddTask },
    data(){
      return {
          isEditable: false,
      }
    },
    created() {
    },
    methods : {
        goTo(){
          window.location = '/tasks/'+this.task.id
        },
        editTask(){

        },
        deleteTask(){
            let _this = this;
            if(confirm('Are you sure you want to delete this task?')){
               axios.post('/delete-tasks', {id : _this.task.id})
                   .then(response => {
                       _this.$emit('del')
                   }).catch(error => {

               })
            }
        }
    }

}
</script>

