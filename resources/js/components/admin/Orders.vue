<template>
    <div>
        <table class="table table-responsive table-striped">
            <thead>
            <tr>
                <td></td>
                <td>Product</td>
                <td>Quantity</td>
                <td>Cost</td>
                <td>Delivery Address</td>
                <td>is Delivered?</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(order,index) in orders" @key="index">
                <td>{{index+1}}</td>
                <td v-html="order.product.name"></td>
                <td>{{order.quantity}}</td>
                <td>{{order.quantity * order.product.price}}</td>
                <td>{{order.address}}</td>
                <td>{{order.is_delivered == 1? "Yes" : "No"}}</td>
                <td v-if="order.is_delivered == 0"><button class="btn btn-success" @click="deliver(index)">Deliver</button></td>
                <td> <button class="btn btn-danger btn-sm" @click="deleteOrder(order)">
                    Delete order
                </button></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import VueNotifications from 'vue-notifications'

    export default {
        data() {
            return {
                orders : []
            }
        },
        beforeMount(){
            axios.get('/api/orders/').then(response => this.orders = response.data)
        },
        methods: {
            deliver(index) {
                let order = this.orders[index]
                axios.patch(`/api/orders/${order.id}/deliver`).then(response => {
                    this.orders[index].is_delivered = 1
                    this.$forceUpdate()
                })
            },
            deleteOrder(order){
                axios.delete(`/api/orders/${order.id}`)
                    .then(response =>{
                        this.orders = response.data.data
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
