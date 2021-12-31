<template>
    <div class="flex items-center justify-center flex-col mr-10 bg-gray-300 rounded-lg">
        <p class="m-5 text-grey-500 font-semibold font-sans tracking-wide"> {{name}} </p>
        <ul class="w-60 max-w-sm h-full overflow-y-auto">
            <Space v-for="user in users" :key="user.id" :user="user"/>
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
            users: Array,
            name: String,
        },
    }
</script>
<style>
    .mainBoard {
        box-sizing: border-box;
        height: calc(100vh - 85px);
    }
</style>
