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
                <td>{{index+1}}</td>
                <td v-html="category.category_name"></td>
                <button class="btn btn-danger btn-sm" @click="deleteCategory(category)">
                    Delete category
                </button>
            </tr>
            </tbody>
        </table>
            <br>
    </div>
</template>

<script>
    import VueNotifications from 'vue-notifications'

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
            },
            deleteCategory(category){
                axios.delete(`/api/categories/${category.id}`)
                    .then(response =>{
                        this.categories = response.data.data
                        this.showInfoMsg({message: response.data.message})
                    })
            }
        },
        notifications: {
            showSuccessMsg: {
                type: VueNotifications.types.success,
                title: 'Hello there',
                message: 'That\'s the success!'
            },
            showInfoMsg: {
                type: VueNotifications.types.info,
                title: 'Hey you',
                message: 'Here is some info for you'
            },
            showWarnMsg: {
                type: VueNotifications.types.warn,
                title: 'Wow, man',
                message: 'That\'s the kind of warning'
            },
            showErrorMsg: {
                type: VueNotifications.types.error,
                title: 'Wow-wow',
                message: 'That\'s the error'
            }
        }
    }
</script>
