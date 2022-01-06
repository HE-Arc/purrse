<template>
    <div class="flex items-center justify-center flex-col mr-10 bg-gray-300 rounded-lg">
        <ConfirmModal v-if="isDeleting" @no="stopDeleting"/>

        <div class="flex flex-row">
            <p v-if="!isEditingListName" class="m-5 text-grey-500 font-semibold font-sans tracking-wide"> {{name}} </p>
            <div v-if="isEditingListName" class="flex flex-row m-5">
                <BreezeInput id="list_name" type="text" class="block w-40" v-model="list_name" required autofocus autocomplete="list_name" />
                <div class="ml-3 mt-2 w-6 h-6">
                    <img src="../Icons/close.png"  alt="Annuler l'ajout de liste" @click="stopEditingListName">
                </div>
            </div>
            <BreezeDropdown>
                <template #trigger>
                    <div class="w-8 h-8 mt-4 ml-5">
                        <img src="../Icons/dots.png"  alt="Plus ...">
                    </div>
                </template>

                <template #content>
                    <BreezeDropdownLink @click="startAddingSpace">
                        <div class="flex flex-row">
                            <div class="w-6 h-6 mr-1">
                                <img src="../Icons/add.png"  alt="Ajouter un espace">
                            </div>
                            <div class="mt-1">
                                Ajouter un espace
                            </div>
                        </div>
                    </BreezeDropdownLink>
                    <BreezeDropdownLink @click="share">
                        <div class="flex flex-row">
                            <div class="w-6 h-6 mr-1">
                                <img src="../Icons/share.png"  alt="Partager une liste">
                            </div>
                            <div class="mt-1">
                                Partager la liste
                            </div>
                        </div>
                    </BreezeDropdownLink>
                    <BreezeDropdownLink @click="startEditingListName">
                        <div class="flex flex-row">
                            <div class="w-6 h-6 mr-1">
                                <img src="../Icons/edit.png"  alt="Renommer la liste">
                            </div>
                            <div class="mt-1">
                                Renommer la liste
                            </div>
                        </div>
                    </BreezeDropdownLink>
                    <BreezeDropdownLink @click.stop="startDeleting">
                        <div class="flex flex-row">
                            <div class="w-6 h-6 mr-1">
                                <img src="../Icons/delete.png"  alt="Effacer la liste">
                            </div>
                            <div class="mt-1">
                                Supprimer la liste
                            </div>
                        </div>
                    </BreezeDropdownLink>
                </template>
            </BreezeDropdown>
        </div>

        <ul class="w-60 max-w-sm h-full overflow-y-auto">
            <Space v-for="user in users" :key="user.id" :user="user"/>
            <AddedTempSpace v-if="isAddingNewSpace" @close="stopAddingSpace"/>
        </ul>
    </div>
</template>
<script>
    import Space from '@/Components/Space.vue';
    import ConfirmModal from '@/Components/ConfirmModal.vue';
    import AddedTempSpace from '@/Components/AddedTempSpace.vue';
    import BreezeDropdown from '@/Components/Dropdown.vue';
    import BreezeDropdownLink from '@/Components/DropdownLink.vue';
    import BreezeInput from '@/Components/Input.vue';

    export default {
        components: {
            Space,
            ConfirmModal,
            AddedTempSpace,
            BreezeDropdown,
            BreezeDropdownLink,
            BreezeInput,
        },
        props: {
            users: Array,
            name: String,
        },
        data() {
            return {
                isAddingNewSpace: false,
                isEditingListName : false,
                isDeleting : false,
                list_name : '',
            };
        },
        methods:{
            share() {
                /* Get the token from the list */
                var shareToken = "Salut comment ça va";

                /* Copy the token inside the clipboard */
                navigator.clipboard.writeText(shareToken);
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
