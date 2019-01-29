<template>
    <div>
        <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class="title">Welcome!</h2>
            <div class="version">Version 0.8</div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 product-box" v-for="(category,index) in categories" @key="index">
                            <router-link :to="{ path: '/categories/'+category.id}">
                                <h5><span v-html="category.category_name"></span>
                                </h5>
                                <button class="col-md-4 btn btn-sm btn-primary float-right">Select category</button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                categories : []
            }
        },
        mounted(){
            axios.get("api/categories/").then(response => this.categories = response.data)
        }
    }
</script>

<style scoped>
    div.version {
        font-size: 8px;
        color: #ffffff;
    }
    .small-text {
        font-size: 14px;
    }
    .product-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
    .hero-section {
        height: 30vh;
        background: #52ab3d;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }
    .title {
        font-size: 60px;
        color: #ffffff;
    }
</style>
