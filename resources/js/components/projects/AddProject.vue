<template>
    <slide-over :open="open" @close="close" :title="!isEditable ? 'Add Project' : 'Edit Project'">
        <div>
        <form class="space-y-3" @submit.prevent="addProject" method="post">
            <div>
                <label class="block text-sm font-medium text-gray-700"> Project Name </label>
                <div class="mt-1">
                    <input placeholder="Project Name" v-model="current_project.name" autofocus type="text" autocomplete="email" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <small class="text-red-500 font-light" v-if="errors && errors.name">
                        <strong>{{errors.name[0]}}</strong>
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
        open : false,
        isEditable : false,
        project : {
            default : ''
        }
    },
    components : { SlideOver },
    data(){
        return {
            current_project: {
                name : ''
            },
            errors : '',
            success : '',
        }
    },
    created() {
        if(this.isEditable){
            this.current_project = this.project;
        }
    },
    methods : {
        reset(){
            this.current_project = {
                name: ''
            };
            this.errors = '';
            this.success = '';
        },
        close(){
           this.$emit('close')
        },
        addProject(){
            let _this = this;
            axios.post('/add-project', _this.current_project).then(response => {
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
