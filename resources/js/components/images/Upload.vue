<template>
    <div class="text-center md:text-left">
        <loader-icon v-if="loader" />
        <button title="Upload File" type="button" class="-m-2.5 w-10 h-10 rounded-full flex items-center justify-center text-gray-400 hover:text-gray-500" @click="selectFileToUpload">
            <!-- Heroicon name: solid/paper-clip -->
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
            </svg>
        </button>

        <input id="file-input" type="file" @change="selectFile" style="display: none;">
        <small v-if="fileTypeError" class="text-red-500"><br>{{fileTypeErrorMessage}}</small>
        <small class="text-success"><br>{{file_name}}</small>
    </div>
</template>

<script>
import LoaderIcon from '../LoaderIcon'
export default {
    props : ['model', 'id'],
    components : { LoaderIcon },
    data(){
        return {
            file_name : '',
            file: '',
            validFileTypes : ['doc', 'docx', 'pdf', 'jpeg', 'jpg', 'png', 'vnd.openxmlformats-officedocument.wordprocessingml.document'],
            fileTypeError : false,
            fileTypeErrorMessage : 'Supported file types are doc, docx and pdf',
            loader : false
        }
    },
    methods : {
        selectFileToUpload(){
            document.querySelector('#file-input').click();
        },
        validateFileType(type){
            if(type){
                let t = type.split('/')[1]
                if(t && t !== 'undefined'){
                    return this.validFileTypes.includes(t);
                } else {
                    return 0
                }
            } else{
                return 0;
            }
        },
        selectFile(e){
            let fileReader = new FileReader();
            this.file_name = e.target.files[0].name;
            let isValid = this.validateFileType((e.target.files[0].type))
            if(!isValid){
                this.fileTypeError = true
            } else {
                this.fileTypeError = false
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.file = e.target.result
                }
                this.loader = true
                setTimeout(() => {
                    this.uploadFile()
                    this.loader = false
                }, 2000)
            }

        },
        uploadFile(){
            let _this = this;
            _this.loader = true
            axios.post('/apis/uploadAttachment/', {'file': _this.file, 'model' : 'Task', 'id' : _this.id})
                .then(response => {
                    _this.$emit('success')
                    _this.loader = false
                }).catch(error => {
                    _this.loader = false
            })
        },
    }
}
</script>
