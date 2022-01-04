<template>
    <li class="p-4 m-3 flex justify-between items-center bg-yellow-200 shadow rounded-lg cursor-pointer" @click.stop="openModal">
        {{user.name}}
        <div id="sortDiv">
            <object data="../icons/chevron-up-solid.svg" type="image/svg+xml" height="10px" width="10px">
                <img src="../icons/chevron-up-solid.svg" alt="Sort Up" class="chevron"/>
            </object>
            <object data="../icons/chevron-down-solid.svg" type="image/svg+xml" height="10px" width="10px">
                <img src="../icons/chevron-down-solid.svg" alt="Sort Down" class="chevron"/>
            </object>
        </div>
    </li>
    <SpaceModal v-if="showModal" @close="closeModal" :user="user"/>
</template>
<script>
    import SpaceModal from '@/Components/SpaceModal.vue';

    export default {
        components: {
            SpaceModal,
        },
        props: ['user'],
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
