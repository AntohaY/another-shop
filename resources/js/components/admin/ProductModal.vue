
<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-header">
                    <slot name="header" v-html="data.name"></slot>
                </div>
                <div class="modal-body mx-3">
                    <slot name="body">
                        <h6>Name</h6>
                        <input type="text" v-model="data.name">
                        <h6>Units</h6>
                        <input type="text" v-model="data.units">
                        <h6>Price</h6>
                        <input type="text" v-model="data.price">
                        <h6>Category</h6>
                        <input type="text" v-model="data.category_name">
                        <textarea v-model="data.description" placeholder="description"></textarea>
                        <span>
                                <img :src="data.image" v-show="data.image != null" style="width:128px;height:128px;">
                                <input type="file" id="file" @change="attachFile">
                        </span>
                        <button class="modal-default-button" @click="uploadFile">
                            Finish
                        </button>
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    input {
        width: 80%;
        padding: 8px 14px;
        margin: 5px 0;
        box-sizing: content-box;
    }

    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }
    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }
    .modal-container {
        width: 800px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }
    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }
    .modal-body {
        margin: 20px 0;
    }
    .modal-default-button {
        float: right;
    }
    .modal-enter {
        opacity: 0;
    }
    .modal-leave-active {
        opacity: 0;
    }
    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>

<script>
    export default {
        props: ['product'],
        data() {
            return {
                attachment: null
            }
        },
        computed: {
            data: function() {
                if (this.product != null) {
                    return this.product
                }
                return {
                    name: "",
                    category_name: "",
                    description: "",
                    units: "",
                    price: "",
                    image: false,
                }
            }
        },
        methods: {
            attachFile(event) {
                this.attachment = event.target.files[0];
            },
            uploadFile(event) {
                if (this.attachment != null) {
                    var formData = new FormData();
                    formData.append("image", this.attachment)
                    let headers = {'Content-Type': 'multipart/form-data'}
                    axios.post("/api/upload-file", formData, {headers}).then(response => {
                        this.product.image = response.data
                        this.$emit('close', this.product)
                    })
                } else {
                    this.$emit('close', this.product)
                }
            },

        }
    }
</script>
