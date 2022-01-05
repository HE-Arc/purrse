<template>
    <div class="flex flex-row justify-around text-yellow-200 py-4 border-b-2 border-yellow-200">
        <div>
            {{this.title}}
        </div>
        <div class="border-r-2 border-yellow-200"/>
        <div>
            {{this.price}} CHF
        </div>
        <div class="border-l-2 border-yellow-200"/>
        <div>
            {{this.date}}
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            title: "Papier toilette",
            price: 20,
            date: "05.10.2021",
        };
    }
}
</script>

