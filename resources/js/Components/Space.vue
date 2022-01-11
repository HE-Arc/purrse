<!-- Component used for spaces -->
<template>
    <!-- Name of the space -->
    <li class="p-4 m-3 flex justify-between items-center bg-yellow-200 shadow rounded-lg cursor-pointer" @click.stop="openModal">
        {{space.name}}
    </li>
    <!-- Modal which contains all the informations of the space -->
    <transition name="fade">
        <SpaceModal v-if="showModal" @close="closeModal" @updateSpace="updateSpace" @deleteSpace="deleteSpace" :description="space.description" :budget="space.budget" :total="space.total" :to_pay="space.to_pay" :expenses="space.expenses" :space_id="space.id" :name="space.name"/>
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
            space: Object
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
            },
            updateSpace(data){
                axios.post('/updateSpace', data)
                    .then(res => {
                        let space = res.data;
                        this.space.name = space['name'];
                        this.space.description = space['description'];
                        this.space.budget = space['budget'];
                    }).catch(err => {
                    console.log(err);
                })
            },
            deleteSpace(){
                this.$emit('deleteSpaceInList', this.space.id);
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
