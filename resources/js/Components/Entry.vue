<template>
    <div class="flex flex-row justify-around text-yellow-200 py-4 border-b-2 border-yellow-200">
        <div v-bind:class="{'line-through':isPaid}">
            {{this.payer}}
        </div>
        <div class="border-r-2 border-yellow-200"/>
        <div v-bind:class="{'line-through':isPaid}">
            {{this.title}}
        </div>
        <div class="border-r-2 border-yellow-200"/>
        <div v-bind:class="{'line-through':isPaid}">
            {{this.price}} CHF
        </div>
        <div class="border-l-2 border-yellow-200"/>
        <div v-bind:class="{'line-through':isPaid}">
            {{this.date}}
        </div>
        <div class="border-r-2 border-yellow-200"/>
        <div>
            <input type="checkbox" v-model="isPaid" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div class="border-r-2 border-yellow-200"/>
        <div>
            <img src="../Icons/close_space.png" class="w-6 h-6" alt="Delete space">
        </div>
    </div>
</template>
<script>
export default {
    props:{
        payer : String,
        title : String,
        price : Number,
        date : Date,
        isPaid : Boolean
    },
}
</script>

