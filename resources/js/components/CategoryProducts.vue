<template>
    <div>
        <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class="title">Available products
            </h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 product-box" v-for="(product,index) in category_products" @key="index">
                            <router-link :to="{ path: '/products/'+product.id}">
                                <img :src="product.image" :alt="product.name" style="width:128px;height:128px;">
                                <h5><span v-html="product.name"></span>
                                    <span class="small-text text-muted float-right">$ {{product.price}}</span>
                                </h5>
                                <button class="col-md-4 btn btn-sm btn-primary float-right">Buy Now</button>
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
                category_products : []
            }
        },
        beforeMount(){
            let url = `/api/categories/${this.$route.params.id}`;
            axios.get(url).then(response => this.category_products = response.data)
        }
    }
</script>
