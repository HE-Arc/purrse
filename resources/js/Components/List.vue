<template>
    <div class="flex items-center justify-center flex-col mr-10 bg-gray-300 rounded-lg">
        <p class="m-5 text-grey-500 font-semibold font-sans tracking-wide"> {{name}} </p>
        <ul class="w-60 max-w-sm h-full overflow-y-auto">
            <Space v-for="space in spaces" :key="space.id" :description="space.description" :budget="space.budget" :total="space.total" :to_pay="space.to_pay" :name="space.name"/>
        </ul>
    </div>
</template>
<script>
    import Space from '@/Components/Space.vue';

    export default {
        components: {
            Space,
        },
        props: {
            spaces: Array,
            name: String
        },
    }
</script>
<style>
    .mainBoard {
        box-sizing: border-box;
        height: calc(100vh - 85px);
    }
</style>
