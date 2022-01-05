<template>
    <div class="flex items-center justify-center flex-col mr-10 bg-gray-300 rounded-lg">
        <div class="flex flex-row">
            <p class="m-5 text-grey-500 font-semibold font-sans tracking-wide"> {{name}} </p>
            <BreezeDropdown>
                <template #trigger>
                    <div class="w-8 h-8 mt-4 ml-5">
                        <img src="../Icons/dots.png"  alt="Plus ...">
                    </div>
                </template>

                <template #content>
                    <BreezeDropdownLink @click.stop="openNewSpace">
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
                    <BreezeDropdownLink>
                        <div class="flex flex-row">
                            <div class="w-6 h-6 mr-1">
                                <img src="../Icons/edit.png"  alt="Renommer la liste">
                            </div>
                            <div class="mt-1">
                                Renommer la liste
                            </div>
                        </div>
                    </BreezeDropdownLink>
                    <BreezeDropdownLink>
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
            <Space v-for="space in spaces" :key="space.id" :description="space.description" :budget="space.budget" :total="space.total" :to_pay="space.to_pay" :name="space.name"/>
            <AddedTempSpace v-if="this.addingSpace" @close="closeNewSpace"/>
        </ul>
    </div>
</template>
<script>
    import Space from '@/Components/Space.vue';
    import AddedTempSpace from '@/Components/AddedTempSpace.vue';
    import BreezeDropdown from '@/Components/Dropdown.vue'
    import BreezeDropdownLink from '@/Components/DropdownLink.vue'

    export default {
        components: {
            Space,
            AddedTempSpace,
            BreezeDropdown,
            BreezeDropdownLink,
        },
        props: {
            spaces: Array,
            name: String
        },
        data() {
            return {
                addingSpace: false,
            };
        },
        methods:{
            share() {
                /* Get the token from the list */
                var shareToken = "Salut comment ça va";

                /* Copy the token inside the clipboard */
                navigator.clipboard.writeText(shareToken);
            },
            openNewSpace() {
                this.addingSpace = true;
            },
            closeNewSpace() {
                this.addingSpace = false;
            }
        }
    }
</script>
