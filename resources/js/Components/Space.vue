<!-- Component used for spaces -->
<template>
    <!-- Name of the space -->
    <li class="p-4 m-3 flex justify-between items-center bg-yellow-200 shadow rounded-lg cursor-pointer" @click.stop="openModal">
        {{name}}
    </li>
    <!-- Modal which contains all the informations of the space -->
    <transition name="fade">
        <SpaceModal v-if="showModal" @close="closeModal" :description="description" :budget="budget" :total="total" :to_pay="to_pay" :expenses="expenses" :space_id="space_id"/>
    </transition>
</template>
<script>
    // Imports
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
                // State of the modal
                showModal: false,
            };
        },
        methods : {
            // Show modal
            openModal() {
                this.showModal = true;
            },
            // Hide modal
            closeModal() {
                this.showModal = false;
            }
        }
    }
</script>
<style>
    /* Styles used to create a fade animation when the modal is opened */
    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.5s ease;
    }

    .fade-enter-from, .fade-leave-to {
        opacity: 0;
    }
</style>
