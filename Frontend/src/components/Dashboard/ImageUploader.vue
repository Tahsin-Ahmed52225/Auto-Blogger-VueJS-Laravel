<template>
    <div class="base-image-input" :style="{ 'background-image': `url(${imageData})` }" @click="chooseImage">
        <span v-if="!imageData" class="placeholder">
            Choose an Image
        </span>
        <input class="file-input" ref="fileInput" type="file" @input="onSelectFile" accept="image/png, image/gif, image/jpeg">
    </div>
</template>

<script>
export default {
    data() {
        return {
            imageData: null
        }
    },
    methods: {
        chooseImage() { 
            this.$refs.fileInput.click()
        },
        onSelectFile() { 
            const input = this.$refs.fileInput
            const files = input.files
            if (files && files[0]) {
                const reader = new FileReader
                reader.onload = e => {
                    this.imageData = e.target.result
                }
                console.log(files[0]);
                reader.readAsDataURL(files[0])
                this.$emit('imageData', files[0])
            }
        }
    }
}
</script>
<style scoped>
.base-image-input {
    display: block;
    height: 150px;
    cursor: pointer;
    background-size: cover;
    background-position: center center;
}

.placeholder {
    background: #afafaf;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #333;
    font-size: 15px;
    cursor: pointer;
}

.placeholder:hover {
    background: #E0E0E0;
}

.file-input {
    display: none;
}</style>