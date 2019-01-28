<template>
    <div>
        <table class="table table-responsive table-striped">
            <thead>
            <tr>
                <td></td>
                <td>Categories</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(category,index) in categories" @key="index" >
                <!--@dblclick="editingItem = category"-->
                <td>{{index+1}}</td>
                <td v-html="category.category_name"></td>
            </tr>
            </tbody>
        </table>
            <br>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: [],
                editingItem: null,
                addingCategory: null
            }
        },

        beforeMount() {
            axios.get('/api/categories/').then(response => this.categories = response.data)
        },
        methods: {
            newCategory() {
                this.addingCategory = {
                    category_name: null,
                }
            },
            endEditing(category) {
                this.editingItem = null
                let index = this.categories.indexOf(category)
                let category_name = category.category_name
                axios.put(`/api/categories/${category.id}`, {category_name})
                    .then(response => this.categories[index] = category)
            },
            addCategory(category) {
                this.addingCategory = null

                let category_name = category.category_name

                axios.post("/api/categories/", {category_name})
                    .then(response => this.categories.push(category))
            }
        }
    }
</script>
