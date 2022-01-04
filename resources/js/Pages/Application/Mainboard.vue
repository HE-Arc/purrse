<template>
    <Head title="Mainboard"/>
    <div class="bg-gray-700 min-h-screen h-full">
        <LogoutMenu/>
        <div id="lists" class="flex justify-start pl-32 overflow-x-auto mainBoard">
            <List v-for="list in lists_arr" :key="list.id" :spaces="list.spaces" :name="list.name"/>
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
    props: {
        'lists_arr' : Array
    }
    // data() {
    //     return {
    //         users: [
    //         {
    //             id: 1,
    //             name: "Adrian Schubert"
    //         },
    //         ],
    //         users2: [
    //             {
    //                 id: 1,
    //                 name: "Johnny Schubert"
    //             },
    //             {
    //                 id: 2,
    //                 name: "Suce"
    //             },
    //             {
    //                 id: 3,
    //                 name: "Ma Grosse"
    //             },
    //         ]
    //     }
    // },
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
