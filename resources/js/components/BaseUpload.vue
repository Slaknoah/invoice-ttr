<template>
    <div class="custom-upload">
        <div class="file-field input-field">
            <div class="btn waves-effect waves-light">
                <span>{{ label || $t('general.choose_file') }}</span>
                <input 
                    v-if="isMultiple" 
                    type="file" 
                    :class="{ 'is-invalid': inputError}" 
                    ref="inputCoverImage" 
                    @change="change" 
                    multiple
                >
                <input v-else type="file" class="custom-file-input " ref="inputCoverImage" @change="change">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" ref="file_path" type="text">
            </div>
            <BaseValidationError v-if="validationErrors" :errors="validationErrors"></BaseValidationError>
        </div>

        <div v-if="previews.length > 0" class="preview-box" :class="{ multiple: isMultiple }">
            <div class="preview" v-for="(obj, index) in previews" :key= "index">
                <div v-if="obj.isImage" class="preview-img" :style="{ backgroundImage: 'url(' + obj.url + ')' }"></div>
                <div v-else class="preview-img" :style="{ backgroundImage: 'url(' + file_icon_src + ')' }"></div>
                <div class="preview-name">{{ obj.name }}</div>
            </div>
        </div>

        <div class="error-log" v-if="errors.length > 0">
            <div>The following files cant be uploaded:</div>
            <div v-for="(res, index) in errors" :key="index">
                <span>- {{ res.fileName }}</span>
                <ul>
                    <li v-for="(err, index) in res.errors" :key="index">{{ err }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import BaseValidationError from "./BaseValidationError";
import { EventBus } from "../event-bus";

export default {
    name: "BaseUpload",
    components: {BaseValidationError},
    data() {
        return {
            files: [],
            previews: [],
            errors: [],
            response: [],
            validationErrors: this.validationError,
            file_icon_src: '/img/file-icon.png',
        }
    },
    props: {
        validationError: Array,
        maxFileSize: {
            type: Number,
            default: 10 * 1024
        },
        allowedExt: [Array, String],
        isMultiple: {
            type: Boolean,
            default: false
        },
        label: {
            type: String,
        }
    },
    methods: {
        resetData() {
            Object.assign(this.$data, this.$options.data());
        },
        resetInput() {
            this.resetData();
            if(this.$refs.file_path)
                this.$refs.file_path.value = '';
        },
        async change() {
            // Reset on each upload if not multiple
            this.resetData();
            
            let i = 0;
            for (const file of this.$refs.inputCoverImage.files) {
                const fileSize = Math.round(file.size / 1024),
                    maxFileSize = this.maxFileSize * 1024,
                    fileExt = file.name.split('.').pop(),
                    fileName = file.name;
                    
                const isInvalidSize = fileSize > maxFileSize,
                    isInvalidExtension = Array.isArray(this.allowedExt) && !this.allowedExt.includes(fileExt);

                this.response[i] = { fileName, isValid: false, errors: [], file: {}, previewUrl: ""}
                if(isInvalidSize || isInvalidExtension) {
                    if (isInvalidSize) 
                        this.response[i].errors.push(`File too big. Max: ${this.maxFileSize}MB`);
                    if (isInvalidExtension)
                        this.response[i].errors.push("Invalid file extension");

                    this.errors.push(this.response[i]);
                } else {
                    try {
                        this.response[i].previewUrl = await this.readFileAsync(file);
                        this.previews.push({url: this.response[i].previewUrl, name: fileName, isImage: this.isFileImage(file)});
                        this.response[i].isValid = true;
                        this.response[i].file = file;
                        this.files.push(file);
                    } catch(err) {
                        this.response[i].errors.push(err);
                    }   
                }
                i++;
            }
            this.$emit('files-uploaded', this.response);
            this.$emit('input', this.files);
        },
        readFileAsync(file) {
            return new Promise( (resolve, reject) => {
                let reader = new FileReader();
                reader.onload = () => {
                    resolve(reader.result);
                };
                reader.onerror = reject;
                reader.readAsDataURL(file);
            });
        },
        isFileImage(file) {
            return file && file['type'].split('/')[0] === 'image';
        }
    },
    mounted() {
        EventBus.$on("BASE_UPLOAD_SUBMITTED", this.resetInput);
    }
}
</script>

<style scoped>
    .custom-upload {
        width: 100%;
    }
    .preview-box {
        padding: 10px;
        border: dotted 1px #fff;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        margin: 20px 0;
    } 

    .preview-box.multiple {
        justify-content: space-between;
    }

    .preview { width: 150px}

    .preview-img {
        width: 100%;
        height: 150px;
        background-size: cover;
        margin-bottom: 10px;
    }

    .preview-name { text-align: center; overflow-wrap: break-word; }

    .preview-box.multiple .preview {
        margin-bottom: 20px;
    }

    .error-log {
        margin-top: 10px;
    }
</style>