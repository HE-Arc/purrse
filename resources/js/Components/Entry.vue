<template>
    <div class="flex flex-row justify-around text-yellow-200 py-4 border-b-2 border-yellow-200">
        <div>
            {{this.name}}
        </div>
        <div class="border-r-2 border-yellow-200"/>
        <div>
            {{this.cost}} CHF
        </div>
        <div class="border-l-2 border-yellow-200"/>
        <div>
            {{this.date}}
        </div>
    </div>
</template>
<script>
export default {
    props:{
        name: String,
        cost: Number,
        date: Date
    },
}
</script>

