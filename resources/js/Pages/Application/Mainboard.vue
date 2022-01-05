<template>
    <Head title="Mainboard"/>
    <div class="bg-gray-700 min-h-screen h-full">
        <LogoutMenu/>

        <div id="lists" class="flex justify-start pl-32 overflow-x-auto mainBoard">
            <List :users=users :name="'Collocation'" />
            <List :users=users2 :name="'Appartement'" />
            <AddedTempList v-if="addingList" @close="closeNewList"/>
            <AddList @new-list="openNewList" @click.stop="openNewList"/>
        </div>
    </div>
</template>

<script>
import LogoutMenu from '@/Layouts/Logout.vue';
import List from '@/Components/List.vue';
import AddList from '@/Components/AddList.vue';
import AddedTempList from '@/Components/AddedTempList.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        LogoutMenu,
        List,
        AddList,
        AddedTempList,
        Head,
    },
    data() {
        return {
            addingList : false,
            users: [
            {
                id: 1,
                name: "Adrian Schubert"
            },
            ],
            users2: [
                {
                    id: 1,
                    name: "Johnny Schubert"
                },
                {
                    id: 2,
                    name: "Suce"
                },
                {
                    id: 3,
                    name: "Ma Grosse"
                },
            ]
        }
    },
    methods : {
        openNewList() {
            this.addingList = true;
        },
        closeNewList() {
            this.addingList = false;
        }
    }
}
</script>
<style>
    .mainBoard {
        box-sizing: border-box;
        height: calc(100vh - 72px);
        padding: 20px;
        margin-left: 20px;
    }


    /* width */
    ::-webkit-scrollbar {
    width: 8px;
    height: 16px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
    background: #a0aec0;
    border-radius: 80vh;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: #434C5E;
    }
</style>
