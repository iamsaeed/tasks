<template>
    <div class="text-center md:text-left">
        <loader-icon v-if="loader" />
        <input type="button" class="w-52 cursor-pointer inline-flex items-center justify-center px-4 py-2 text-sm border border-indigo-500 rounded-full text-white bg-indigo-500 hover:bg-indigo-500 focus:outline-none" @click="selectFileToUpload" value="Upload"/>
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
            }
            fileReader.readAsDataURL(e.target.files[0]);
            fileReader.onload = (e) => {
                this.file = e.target.result
            }
            this.loader = true
            setTimeout(() => {
                this.uploadFile()
                this.loader = false
            }, 2000)

        },
        uploadFile(){
            let _this = this;
            _this.loader = true
            axios.post('/api/uploadAttachment/', {'file': _this.file, 'model' : 'Task', 'id' : _this.id})
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
