<template>
    <div class="flex items-center justify-center flex-col mr-10 bg-gray-300 rounded-lg">
        <transition name="fade">
            <ConfirmModal v-if="isDeleting" @no="stopDeleting"/>
        </transition>

        <div class="flex flex-row">
            <p v-if="!isEditingListName" class="m-5 text-grey-500 font-semibold font-sans tracking-wide"> {{name}} </p>
            <div v-if="isEditingListName" class="flex flex-row m-3">
                <BreezeInput id="list_name" type="text" class="block w-32" v-model="list_name" required autocomplete="list_name" />
                <div class="ml-3 mt-2 w-6 h-6">
                    <img src="../Icons/close.png"  alt="Annuler l'ajout de liste" @click="stopEditingListName">
                </div>
            </div>
            <BreezeDropdown>
                <template #trigger>
                    <div class="w-8 h-8 mt-4 mr-3">
                        <img src="../Icons/dots.png"  alt="Plus ...">
                    </div>
                </template>

                <template #content>
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
        <ul class="w-60 max-w-sm h-full overflow-y-auto">
            <Space v-for="space in spaces" :key="space.id" :description="space.description" :budget="space.budget" :total="space.total" :to_pay="space.to_pay" :name="space.name" :expenses="space.expenses" :space_id="space.id"/>
            <AddedTempSpace v-if="isAddingNewSpace" @customClose="stopAddingSpace"/>
        </ul>
    </div>
</template>
<script>
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
            return {
                isAddingNewSpace: false,
                isEditingListName : false,
                isDeleting : false,
                list_name : '',
            }
        },
        methods:{
            share() {
                //Paste to the clipboard the invitation link
                navigator.clipboard.writeText(window.location.host + '/invite/' + this.token);
            },
            startAddingSpace() {
                this.isAddingNewSpace = true;
            },
            stopAddingSpace() {
                this.isAddingNewSpace = false;
            },
            startEditingListName() {
                this.isEditingListName = true;
            },
            stopEditingListName() {
                this.isEditingListName = false;
            },
            startDeleting() {
                this.isDeleting = true;
            },
            stopDeleting() {
                this.isDeleting = false;
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
