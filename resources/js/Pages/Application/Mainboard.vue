<template>
    <Head title="Mainboard"/>
    <div class="bg-gray-700 min-h-screen h-full">
        <LogoutMenu/>
        <div id="lists" class="flex justify-start pl-32 overflow-x-auto mainBoard">
            <List @deleteList="deleteList" v-for="list in lists_arr" :key="list.id" :spaces="list.spaces" :id="list.id" :name="list.name" :token="list.token"/>
            <AddedTempList v-if="addingList" @close="closeNewList"/>
            <AddList @new-list="openNewList"/>
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
    data(){
        return{
            addingList : false,
        };
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
        //Send to the controller the new list to create
        newList(listName){
            let data = {
                name: listName,
                image: listName+'.png'
            }

            if(listName != ''){//Create the list only when the name is not empty
                axios.post('/newList', data)
                    .then(res => {
                        this.lists_arr.push(res.data);
                    }).catch(err => {
                        console.log(err);
                    })
                this.closeNewList(); //Close the modal
            }
        },
        //Delete a specific list with the id
        deleteList(listId){
            let data = {
                id: listId
            }
            let idArray = null;
            axios.post('/deleteList', data) //Remove the list in the database
                .then(res =>{
                    this.lists_arr.forEach(list => {
                        if(list.id == listId){ //Find the position of the list in the array to delete
                            idArray = this.lists_arr.indexOf(list);
                        }
                    });
                    this.lists_arr.splice(idArray,1);//Remove the list in array
                }).catch(err => {
                    console.log(err);
                });

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
