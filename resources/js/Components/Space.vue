<template>
    <li class="p-4 m-3 flex justify-between items-center bg-yellow-200 shadow rounded-lg cursor-pointer" @click.stop="openModal">
        {{name}}
        <div id="sortDiv">
            <object data="../icons/chevron-up-solid.svg" type="image/svg+xml" height="10px" width="10px">
                <img src="../icons/chevron-up-solid.svg" alt="Sort Up" class="chevron"/>
            </object>
            <object data="../icons/chevron-down-solid.svg" type="image/svg+xml" height="10px" width="10px">
                <img src="../icons/chevron-down-solid.svg" alt="Sort Down" class="chevron"/>
            </object>
        </div>
        -->
    </li>
    <transition name="fade">
        <SpaceModal v-if="showModal" @close="closeModal" :description="description" :budget="budget" :total="total" :to_pay="to_pay"/>
    </transition>
</template>
<script>
    import SpaceModal from '@/Components/SpaceModal.vue';

    export default {
        components: {
            SpaceModal,
        },
        props: {
            name: String,
            description: String,
            budget: Number,
            total: Number,
            to_pay: Number
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
