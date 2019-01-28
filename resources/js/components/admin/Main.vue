<template>
    <div class="row">
        <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
            <!--<a href='/admin/orders'>Orders ({{orders.length}})</a>-->
            <p>Orders ({{orders.length}})</p>
        </div>
        <hr>
        <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
            <!--<a href='/admin/products'>Products ({{products.length}})</a>-->
            <p>Products ({{products.length}})</p>
        </div>
        <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
            <!--<a href='/admin/users'>Users ({{users.length}})</a>-->
            <p>Users ({{users.length}})</p>
        </div>
        <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
            <!--<a href='/admin/categories'>Categories ({{categories.length}})</a>-->
            <p>Categories ({{categories.length}})</p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user : null,
                orders : [],
                products : [],
                users : [],
                categories : []
            }
        },
        mounted() {
            axios.get('/api/users/').then(response => this.users = response.data)
            axios.get('/api/products/').then(response => this.products = response.data)
            axios.get('/api/orders/').then(response => this.orders = response.data)
            axios.get('/api/categories').then(response=> this.categories = response.data)
        }
    }
</script>

<style scoped>
    .big-text { font-size: 28px; }
    .product-box { border: 1px solid #cccccc; padding: 10px 15px; height: 20vh }
</style>
