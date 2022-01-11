<!-- Component list used to host the different spaces -->
<template>
    <!-- Vertical list -->
    <div class="flex items-center justify-center flex-col mr-10 bg-gray-300 rounded-lg">
        <!-- Confirmation modal -->
        <transition name="fade">
            <ConfirmModal v-if="isDeleting" @close="stopDeleting"/>
        </transition>

        <!-- Header and Dropdown menu -->
        <div class="flex flex-row">
            <!-- Header -->
            <p v-if="!isEditingListName" class="m-5 text-grey-500 font-semibold font-sans tracking-wide"> {{name}} </p>
            <!-- Input to rename the list -->
            <div v-if="isEditingListName" class="flex flex-row m-3">
                <BreezeInput id="list_name" type="text" class="block w-32" v-model="list_name" required autocomplete="list_name" />
                <div class="ml-3 mt-2 w-6 h-6">
                    <img src="../Icons/close.png"  alt="Annuler l'ajout de liste" @click="stopEditingListName">
                </div>
            </div>
            <!-- Three dots used to show a sub-menu -->
            <BreezeDropdown>
                <template #trigger>
                    <div class="w-8 h-8 mt-4 mr-3">
                        <img src="../Icons/dots.png"  alt="Plus ...">
                    </div>
                </template>

                <template #content>
                    <!-- Add a space -->
                    <ListDropdownAction @click="startAddingSpace">
                        <div class="flex flex-row">
                            <div class="w-6 h-6 mr-1">
                                <img src="../Icons/add.png"  alt="Ajouter un espace">
                            </div>
                            <div class="mt-1">
                                Ajouter un espace
                            </div>
                        </div>
                    </ListDropdownAction>
                    <!-- Share the list -->
                    <ListDropdownAction @click="share">
                        <div class="flex flex-row">
                            <div class="w-6 h-6 mr-1">
                                <img src="../Icons/share.png"  alt="Partager une liste">
                            </div>
                            <div class="mt-1">
                                Partager la liste
                            </div>
                        </div>
                    </ListDropdownAction>
                    <!-- Rename the list -->
                    <ListDropdownAction @click="startEditingListName">
                        <div class="flex flex-row">
                            <div class="w-6 h-6 mr-1">
                                <img src="../Icons/edit.png"  alt="Renommer la liste">
                            </div>
                            <div class="mt-1">
                                Renommer la liste
                            </div>
                        </div>
                    </ListDropdownAction>
                    <!-- Delete the list -->
                    <ListDropdownAction @click.stop="startDeleting">
                        <div class="flex flex-row">
                            <div class="w-6 h-6 mr-1">
                                <img src="../Icons/delete.png"  alt="Effacer la liste">
                            </div>
                            <div class="mt-1">
                                Supprimer la liste
                            </div>
                        </div>
                    </ListDropdownAction>
                </template>
            </BreezeDropdown>
        </div>
        <!-- All the spaces -->
        <ul class="w-60 max-w-sm h-full overflow-y-auto">
            <!-- For loop on the spaces => use of the v-for -->
            <Space v-for="space in spaces" :key="space.id" :description="space.description" :budget="space.budget" :total="space.total" :to_pay="space.to_pay" :name="space.name" :expenses="space.expenses" :space_id="space.id"/>
            <!-- Temp added space, used to create a new space -->
            <AddedTempSpace v-if="isAddingNewSpace" @customClose="stopAddingSpace"/>
        </ul>
    </div>
</template>
<script>
    // Imports
    import Space from '@/Components/Space.vue';
    import ConfirmModal from '@/Components/ConfirmModal.vue';
    import AddedTempSpace from '@/Components/AddedTempSpace.vue';
    import ListDropdownAction from '@/Components/ListDropdownAction.vue';
    import BreezeDropdown from '@/Components/Dropdown.vue';
    import BreezeInput from '@/Components/Input.vue';

    export default {
        components: {
            Space,
            ConfirmModal,
            AddedTempSpace,
            BreezeDropdown,
            ListDropdownAction,
            BreezeInput,
        },
        props: {
            spaces: Array,
            id: Number,
            name: String,
            token: String
        },
        data() {
            // Data used : boolean to show or not elements
            return {
                isAddingNewSpace: false,
                isEditingListName : false,
                isDeleting : false,
                list_name : '',
            }
        },
        methods:{
            //Paste the invitation link to the clipboard
            share() {
                navigator.clipboard.writeText(window.location.host + '/invite/' + this.token);
            },
            // Show the temp adding space
            startAddingSpace() {
                this.isAddingNewSpace = true;
            },
            // Hide the temp adding space
            stopAddingSpace() {
                this.isAddingNewSpace = false;
            },
            // Show the input to rename the list
            startEditingListName() {
                this.isEditingListName = true;
            },
            // Hide the input to rename the list
            stopEditingListName() {
                this.isEditingListName = false;
            },
            // Show the modal to confirm the deletion
            startDeleting() {
                this.isDeleting = true;
            },
            // Hide the modal to confirm the deletion
            stopDeleting() {
                this.isDeleting = false;
            }
        }
    }
</script>
<style>
    /* Style used to do a fade animation */
    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.5s ease;
    }
    .fade-enter-from, .fade-leave-to {
        opacity: 0;
    }
</style>
