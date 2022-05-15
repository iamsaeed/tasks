<template>
    <div class="flex flex-col h-full">
        <div class="flex-1 border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
            <div class="block w-full py-3 border-0 resize-none focus:ring-0 sm:text-sm h-96 overflow-y-auto">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <ul role="list" class="divide-y divide-gray-200 px-2">
                    <li class="py-4" v-for="comment in comments">
                        <div class="flex items-center" :class="auth.id === comment.created_by.id ? 'flex-row-reverse' : ''">
                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            <div class="ml-3" :class="auth.id === comment.created_by.id ? 'px-2' : ''">
                                <p class="text-sm text-gray-900 text-xs"
                                   :class="auth.id === comment.created_by.id ? 'text-right' : ''"
                                >{{comment.description}}</p>
                                <p class="text-sm text-gray-500 text-xs"
                                   :class="auth.id === comment.created_by.id ? 'text-right' : ''"
                                >{{comment.created_at}}</p>
                            </div>
                            <ReplyIcon class="h-5 w-5 text-gray-500 cursor-pointer"
                                       :class="auth.id === comment.created_by.id ? 'transform rotate-180' : ''"
                                       title="Reply"
                                       @click="handleOpenReplyModal(comment)"
                            />
                        </div>
                        <div class="flex items-center " :class="auth.id === comment.created_by.id ? '' : 'flex-row-reverse'">
                            <ul class="px-2" v-if="comment.comment_replies_count">
                                <li class="py-4 flex items-center" v-for="reply in comment.comment_replies">
                                    <img class="h-5 w-5 rounded-full" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                    <div class="ml-3 px-2">
                                        <p class="text-sm text-gray-900 text-xs"
                                           :class="auth.id === reply.created_by.id ? '' : 'text-right'"
                                        >{{reply.description}}</p>
                                        <p class="text-sm text-gray-500 text-xs t"
                                           :class="auth.id === reply.created_by.id ? '' : 'ext-right'"
                                        >{{reply.created_at}}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex items-start space-x-4">
            <div class="min-w-0 flex-1">
                <form class="relative" method="post" @submit.prevent="addComment">
                    <div class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                        <textarea v-model="description" class="block w-full py-3 border-0 resize-none focus:ring-0 sm:text-sm" placeholder="Add your comment..."></textarea>
                        <!-- Spacer element to match the height of the toolbar -->
                        <div class="py-2" aria-hidden="true">
                            <!-- Matches height of button in toolbar (1px border + 36px content height) -->
                            <div class="py-px">
                                <div class="h-9"></div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute bottom-0 inset-x-0 pl-3 pr-2 py-2 flex justify-between">
                        <div class="flex items-center space-x-5">
                            <div class="flex items-center">
                                <button type="button" class="-m-2.5 w-10 h-10 rounded-full flex items-center justify-center text-gray-400 hover:text-gray-500">
                                    <!-- Heroicon name: solid/paper-clip -->
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <TransitionRoot as="template" :show="openReplyModal">
            <Dialog as="div" class="relative z-10" @close="closeReplyModal">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </TransitionChild>

                <div class="fixed z-10 inset-0 overflow-y-auto">
                    <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            <DialogPanel class="relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-sm sm:w-full sm:p-6">
                                <div class="flex items-start space-x-4">
                                    <div class="min-w-0 flex-1">
                                        <form class="relative" method="post" @submit.prevent="addComment">
                                            <div class="border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                                                <textarea v-model="description" class="block w-full py-3 border-0 resize-none focus:ring-0 sm:text-sm" placeholder="Add your comment..."></textarea>
                                                <!-- Spacer element to match the height of the toolbar -->
                                                <div class="py-2" aria-hidden="true">
                                                    <!-- Matches height of button in toolbar (1px border + 36px content height) -->
                                                    <div class="py-px">
                                                        <div class="h-9"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="absolute bottom-0 inset-x-0 pl-3 pr-2 py-2 flex justify-between">
                                                <div class="flex items-center space-x-5">
                                                    <div class="flex items-center">
                                                        <button type="button" class="-m-2.5 w-10 h-10 rounded-full flex items-center justify-center text-gray-400 hover:text-gray-500">
                                                            <!-- Heroicon name: solid/paper-clip -->
                                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Post</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

</template>

<script>
import { ReplyIcon } from '@heroicons/vue/solid'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/outline'
export default {
    props : ['comment_id', 'model', 'id', 'comments', 'auth'],
    components : { ReplyIcon, Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot, CheckIcon },
    data(){
        return {
            description : '',
            openReplyModal : false,
            comment_id_for_reply : ''
        }
    },
    created() {
        this.comment_id_for_reply = this.comment_id;
    },
    methods : {
        handleOpenReplyModal(comment){
            this.comment_id_for_reply = comment.id
            this.openReplyModal = true
        },
        closeReplyModal(){
            this.openReplyModal = false
            this.comment_id_for_reply = ''
            this.description = ''
        },
        addComment(){
            let _this = this;
            _this.loader = true
            axios.post('/apis/addComment/', {
                description : _this.description,
                comment_id: _this.comment_id_for_reply,
                model : 'Task',
                id : _this.id
            })
            .then(response => {
                _this.closeReplyModal();
                _this.$emit('success')
            }).catch(error => {

            })
        },
    }
}
</script>
