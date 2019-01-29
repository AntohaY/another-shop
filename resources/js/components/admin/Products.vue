<template>
    <div>
        <table class="table table-responsive table-striped">
            <thead>
            <tr>
                <td></td>
                <td>Product</td>
                <td>Units</td>
                <td>Price</td>
                <td>Description</td>
                <td>Category</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(product,index) in products" @key="index" @dblclick="editingItem = product">
                <td>{{index+1}}</td>
                <td v-html="product.name"></td>
                <td v-model="product.units">{{product.units}}</td>
                <td v-model="product.price">{{product.price}}</td>
                <td v-model="product.description">{{product.description}}</td>
                <td v-model="product.category_name">{{product.category_name}}</td>
                <button class="btn btn-danger" @click="deleteProduct(product)">
                    Delete product
                </button>
            </tr>
            </tbody>
        </table>
        <modal @close="endEditing" :product="editingItem" v-show="editingItem != null"></modal>
        <modal @close="addProduct"  :product="addingProduct" v-show="addingProduct != null"></modal>
        <br>

        <button class="btn btn-primary" @click="newProduct">Add New Product</button>
    </div>
</template>

<script>
    import Modal from './ProductModal'

    export default {
        data() {
            return {
                products: [],
                editingItem: null,
                addingProduct: null
            }
        },
        components: {Modal},
        beforeMount() {
            axios.get('/api/products').then(response => this.products = response.data)
        },
        methods: {
            newProduct() {
                this.addingProduct = {
                    name: null,
                    category_name: null,
                    description: null,
                    units: null,
                    price: null,
                    image: null,
                }
            },
            endEditing(product) {
                this.editingItem = null

                let index = this.products.indexOf(product)
                let name = product.name
                let units = product.units
                let price = product.price
                let description = product.description
                let category_name = product.category_name

                axios.put(`/api/products/${product.id}`, {name,category_name,description, units, price})
                    .then(response => this.products[index] = product)
            },
            addProduct(product) {
                this.addingProduct = null

                let name = product.name
                let units = product.units
                let price = product.price
                let description = product.description
                let image = product.image
                let category_name = product.category_name

                axios.post("/api/products", {name, category_name, description ,units, price,image})
                    .then(response => this.products.push(product))
            },
            deleteProduct(product){
                axios.delete(`/api/products/${product.id}`)
            }
        }
    }
</script>

