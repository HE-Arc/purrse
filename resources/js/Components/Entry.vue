<template>
    <div class="flex flex-row justify-around text-yellow-200 py-4 border-b-2 border-yellow-200">
        <div v-bind:class="{'line-through':this.expense.is_paid}">
            {{this.expense.user}}
        </div>
        <div class="border-r-2 border-yellow-200"/>
        <div v-bind:class="{'line-through':this.expense.is_paid}">
            {{this.expense.name}}
        </div>
        <div class="border-r-2 border-yellow-200"/>
        <div v-bind:class="{'line-through':this.expense.is_paid}">
            {{this.expense.cost}} CHF
        </div>
        <div class="border-l-2 border-yellow-200"/>
        <div v-bind:class="{'line-through':this.expense.is_paid}">
            {{this.expense.date}}
        </div>
        <div class="border-r-2 border-yellow-200"/>
        <div>
            <input type="checkbox" v-model="isPaid" @change="changePaid" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div class="border-r-2 border-yellow-200"/>
        <div>
            <img src="../Icons/close_space.png" @click="this.$emit('deleteExpense', this.expense.id)" class="w-6 h-6" alt="Delete expense">
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
