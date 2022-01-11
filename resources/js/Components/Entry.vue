<template>
    <div class="grid grid-cols-6 gap-4 grid-rows-1 text-yellow-200 py-4 border-b-2 border-yellow-200 text-center text-xs lg:text-base">
        <div class="mt-1.5" v-bind:class="{'line-through':this.expense.is_paid}">
            {{this.expense.user}}
        </div>
        <div class="mt-1.5" v-bind:class="{'line-through':this.expense.is_paid}">
            {{this.expense.name}}
        </div>
        <div class="mt-1.5" v-bind:class="{'line-through':this.expense.is_paid}">
            {{this.expense.cost}} CHF
        </div>
        <div class="mt-1.5" v-bind:class="{'line-through':this.expense.is_paid}">
            {{this.expense.date}}
        </div>
        <div>
            <input type="checkbox" v-model="isPaid" @change="changePaid" class="mt-3 w-3 h-3 lg:mb-2.5 lg:w-4 lg:h-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div class="m-auto">
            <img src="../Icons/close_space.png" @click="this.$emit('deleteExpense', this.expense.id)" class="w-5 h-5 lg:w-6 lg:h-6" alt="Delete expense">
        </div>
    </div>
</template>
<script>
export default {
    props:{
        expense: Object
    },
    methods:{
        changePaid(){
            this.expense.is_paid = this.isPaid
            let data = {
                id: this.expense.id,
                paid: this.isPaid
            }
            axios.post('/updateExpense', data)
                .then(res => {
                }).catch(err => {
                console.log(err);
            })
        }
    },
    data(){
        return{
            isPaid: this.expense.is_paid == 1 ? true : false
        }
    }
}
</script>
