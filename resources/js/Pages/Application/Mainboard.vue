<!-- Main Page component -->
<template>
    <!-- Head title -->
    <Head title="Mainboard"/>
    <!-- Application's content -->
    <div class="bg-gray-700 min-h-screen h-full">
        <!-- Header of the page -->
        <LogoutMenu/>
        <!-- Div which contains all the lists -->
        <div id="lists" class="flex justify-start pl-32 overflow-x-auto mainBoard">
            <!-- All the lists => use of v-for -->
            <List @deleteList="deleteList" @updateList="updateList" v-for="list in lists_arr" :key="list.id" :spaces="list.spaces" :id="list.id" :name="list.name" :token="list.token"/>
            <!-- Temp list used to add a new list -->
            <AddedTempList v-if="addingList" @newList="newList" @close="closeNewList"/>
            <!-- Button used to add a new list -->
            <AddList @new-list="openNewList" @click.stop="openNewList"/>
        </div>
    </div>
</template>

<script>
// Imports
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
        // Show the new list temp component
        openNewList() {
            this.addingList = true;
        },
        // Hide the new list temp component
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
                        let list = res.data;
                        list.spaces = [];
                        this.lists_arr.push(list);
                    }).catch(err => {
                        console.log(err);
                    })
                this.closeNewList(); //Close the modal
            }
        },
        //Update a specific list
        updateList(args){
            let data = {
                id: args[0],
                name: args[1]
            };
            let idArray = null;
            axios.post('/updateList', data) //Rename the list in th database
                .then(res =>{
                    if(res.data != 'false'){
                        this.lists_arr.forEach(list => {
                            if(list.id == data.id){ //Find the position of the list in the array to replace
                                idArray = this.lists_arr.indexOf(list);
                            }
                        });
                        this.lists_arr.splice(idArray, 1, res.data); //Replace the old list
                    }
                }).catch(err => {
                    console.log(err);
                });
        },
        //Delete a specific list with the id
        deleteList(listId){
            let data = {
                id: listId
            }
            let idArray = null;
            axios.post('/deleteList', data) //Remove the list in the database
                .then(res =>{
                    console.log(res.data);
                    if(res.data == 1){
                        this.lists_arr.forEach(list => {
                            if(list.id == listId){ //Find the position of the list in the array to delete
                                idArray = this.lists_arr.indexOf(list);
                            }
                        });
                        this.lists_arr.splice(idArray,1);//Remove the list in array
                    }
                }).catch(err => {
                    console.log(err);
                });
        }
    }
}
</script>
<style>
    /* Style used for the sizing of the of the application */
    .mainBoard {
        box-sizing: border-box;
        height: calc(100vh - 72px);
        padding: 20px;
        margin-left: 20px;
    }

    /* Styles used to change the scrollbar */
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
