<template>
    <li class="p-4 m-3 flex justify-between items-center bg-yellow-200 shadow rounded-lg cursor-pointer" @click.stop="openModal">
        {{name}}
    </li>
    <transition name="fade">
        <SpaceModal v-if="showModal" @close="closeModal" :description="description" :budget="budget" :total="total" :to_pay="to_pay" :expenses="expenses" :space_id="space_id"/>
    </transition>
</template>
<script>
    import SpaceModal from '@/Components/SpaceModal.vue';

    export default {
        components: {
            SpaceModal,
        },
        props: {
            space_id: Number,
            name: String,
            description: String,
            budget: Number,
            total: Number,
            to_pay: Number,
            space_id: Number,
            expenses: Array
        },
        data() {
            return {
                showModal: false,
            };
        },
        methods : {
            openModal() {
                this.showModal = true;
            },
            closeModal() {
                this.showModal = false;
            }
        }
    }
</script>
<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.5s ease;
    }

    .fade-enter-from, .fade-leave-to {
        opacity: 0;
    }
</style>
