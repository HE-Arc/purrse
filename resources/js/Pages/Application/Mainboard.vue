<template>
    <Head title="Mainboard"/>
    <div class="bg-gray-700 min-h-screen h-full">
        <LogoutMenu/>
        <div id="lists" class="flex justify-start pl-32 overflow-x-auto mainBoard">
            <List v-for="list in lists_arr" :key="list.id" :spaces="list.spaces" :name="list.name" :token="list.token"/>
            <AddedTempList v-if="addingList" @close="closeNewList"/>
            <AddList @click="newList" @new-list="openNewList" @click.stop="openNewList"/>
        </div>
    </div>
</template>

<script>
import LogoutMenu from '@/Layouts/Logout.vue';
import List from '@/Components/List.vue';
import AddList from '@/Components/AddList.vue';
import AddedTempList from '@/Components/AddedTempList.vue'
import { Head } from '@inertiajs/inertia-vue3';
import axios from 'axios';

export default {
    components: {
        LogoutMenu,
        List,
        AddList,
        AddedTempList,
        Head,
    },
    props: {
        'lists_arr' : Array
    },
    methods : {
        openNewList() {
            this.addingList = true;
        },
        closeNewList() {
            this.addingList = false;
        },
        newList(){
            let data = {
                name: 'bob',
                image: 'bob.png'
            }
            axios.post('/newList', data)
                .then(res => {
                    this.lists_arr.push(res.data);
                    console.log(res.data);
                }).catch(err => {
                console.log(err.response);
            })
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
