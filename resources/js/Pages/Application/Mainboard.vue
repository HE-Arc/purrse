<template>
    <Head title="Mainboard"/>
    <div class="bg-gray-700 min-h-screen h-full">
        <LogoutMenu/>

        <div id="lists" class="flex justify-start pl-32 overflow-x-auto mainBoard">
            <List :users=users :name="'Collocation'" />
            <List :users=users2 :name="'Appartement'" />
            <List :users=users :name="'Collocation'" />
            <List :users=users2 :name="'Appartement'" />
            <List :users=users :name="'Collocation'" />
            <List :users=users2 :name="'Appartement'" />
            <List :users=users :name="'Collocation'" />
            <List :users=users2 :name="'Appartement'" />
            <List :users=users :name="'Collocation'" />
            <List :users=users2 :name="'Appartement'" />
            <AddList />
        </div>
    </div>
</template>

<script>
import LogoutMenu from '@/Layouts/Logout.vue';
import List from '@/Components/List.vue';
import AddList from '@/Components/AddList.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        LogoutMenu,
        List,
        AddList,
        Head,
        Link,
    },
    data() {
        return {
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
                {
                    id: 4,
                    name: "Queue"
                },
                {
                    id: 5,
                    name: "Queue"
                },
                {
                    id: 6,
                    name: "Queue"
                },
                {
                    id: 7,
                    name: "Queue"
                },
                {
                    id: 8,
                    name: "Queue"
                },
                {
                    id: 9,
                    name: "Queue"
                },
                {
                    id: 10,
                    name: "Queue"
                },
                {
                    id: 11,
                    name: "Queue"
                },
                {
                    id: 12,
                    name: "Queue"
                },
                {
                    id: 13,
                    name: "Queue"
                },
                {
                    id: 14,
                    name: "Queue"
                },
                {
                    id: 15,
                    name: "Queue"
                },
                {
                    id: 16,
                    name: "Queue"
                },
                {
                    id: 17,
                    name: "Queue"
                },
                {
                    id: 18,
                    name: "Queue"
                },
            ]
        }
    },
}
</script>
<style>
    .mainBoard {
        box-sizing: border-box;
        height: calc(100vh - 60px);
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
