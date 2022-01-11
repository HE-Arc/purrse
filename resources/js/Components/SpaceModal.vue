<template>
    <!-- Black background -->
    <div class="fixed table top-0 left-0 z-50 w-full h-full bg-black bg-opacity-50">
        <!-- Align the modal in the center of the screen -->
        <div class="table-cell align-middle">
            <!-- Definition of the modal -->
            <div class="flex items-center flex-col w-3/4 h-4/5 lg:w-2/4 lg:h-3/5 my-0 mx-auto py-2 px-2 bg-gray-700 text-yellow-200 rounded-md shadow-2xl" v-clickoutside="close">
                <!-- Confirmation modal for the deletion -->
                <transition name="fade">
                    <ConfirmModal v-if="isDeleting" @close="stopDeleting" @click.stop @yes="deleteSpace"/>
                </transition>

                <!-- Title of the space and editing button -->
                <div class="flex flex-row justify-around">
                    <!-- Title of the space -->
                    <p v-if="!isEditing" class="m-5 lg:my-5 text-lg lg:text-3xl font-semibold font-sans tracking-wide">
                        {{name}}
                    </p>
                    <!-- Input to modify the title of the space -->
                    <div v-if="isEditing" class="flex flex-row m-5 lg:my-5 lg:mx-2">
                        <BreezeInput id="space_name" type="text" class="block w-32 h-5 mt-1 lg:w-44 lg:h-7 lg:m-1.5 lg:ml-12" v-model="space_name" required autofocus autocomplete="space_name" />
                    </div>
                    <!-- Edit button -->
                    <div class="w-5 h-5 my-6 lg:w-6 lg:h-6 lg:my-7" v-if="!isEditing">
                        <img src="../Icons/edit_space.png"  alt="Modifier le nom de l'espace" @click.stop="startEditingSpaceName">
                    </div>
                    <!-- If the user is editing -->
                    <div class="w-5 h-5 my-6 lg:w-6 lg:h-6 lg:my-7" v-if="isEditing">
                        <img src="../Icons/close_space.png"  alt="Annuler l'ajout de liste" @click.stop="stopEditingSpaceName">
                    </div>
                    <!-- Confirm the changes -->
                    <div class="w-5 h-5 my-6 lg:w-6 lg:h-6 lg:my-7" v-if="isEditing">
                        <img src="../Icons/check_space.png"  alt="Supprimer l'espace" @click.stop="startDeleting">
                    </div>
                    <!-- Cancel the changes -->
                    <div class="w-5 h-5 my-6 lg:w-6 lg:h-6 lg:my-7">
                        <img src="../Icons/delete_space.png"  alt="Supprimer l'espace" @click.stop="startDeleting">
                    </div>
                </div>
                <!-- Description of the space -->
                <div>
                    <p v-if="!isEditing" class="text-sm lg:text-lg">
                        {{description}}
                    </p>
                    <!-- Input to modify the description of the space -->
                    <textarea v-if="isEditing" id="space_description" class="block resize-none w-40 h-12 lg:w-64 lg:h-16 bg-gray-400 border-gray-100 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" v-model="space_description"/>
                </div>
                <!-- Important integer data of the space -->
                <div class="flex flex-row w-full justify-evenly text-sm lg:text-xl m-4">
                    <!-- Budget -->
                    <div class="flex flex-col justify-between">
                        <!-- Title -->
                        <div class="text-center">
                            Budget
                        </div>
                        <!-- Value -->
                        <div class="text-center" v-if="!isEditing">
                            10'000 CHF
                        </div>
                        <!-- Input used to modify the data -->
                        <div class="text-center" v-if="isEditing">
                            <BreezeInput @keyup.enter="updateSpace" id="space_budget" type="number" class="block h-4 w-20 lg:w-28 lg:h-7" v-model="space_budget"/>
                        </div>
                    </div>
                    <!-- Transactions -->
                    <div class="flex flex-col justify-between">
                        <!-- Title -->
                        <div class="text-center">
                            Transactions
                        </div>
                        <!-- Value -->
                        <div class="text-center">
                            {{totalTransactions}} CHF
                        </div>
                    </div>
                    <!-- Left to pay -->
                    <div class="flex flex-col justify-between">
                        <!-- Title -->
                        <div class="text-center">
                            À payer
                        </div>
                        <!-- Value -->
                        <div class="text-center">
                            {{totalToPay}} CHF
                        </div>
                    </div>
                </div>
                <!-- Input to create another expense -->
                <div class="flex flex-col my-0 lg:flex-row lg:my-3">
                    <!-- Input for the name of the expense -->
                    <div class="mt-2 lg:mt-0 lg:mx-5">
                        <BreezeLabel for="expenseName" value="Nom de la dépense" />
                        <BreezeInput id="expenseName" type="text" class="w-40 md:w-16 lg:mt-1 lg:w-44" v-model="expenseName" required autofocus/>
                    </div>
                    <!-- Input for the amount of the expense -->
                    <div class="mt-2 lg:mt-0 lg:mx-5">
                        <BreezeLabel for="montant" value="Montant" />
                        <BreezeInput id="montant" type="number" class="w-40 md:w-16 lg:mt-1 lg:w-44" v-model="montant" required autofocus/>
                    </div>
                    <!-- Input for the date of the expense -->
                    <div class="mt-2 lg:mt-0 lg:mx-5">
                        <BreezeLabel for="date" value="Date" />
                        <BreezeInput id="date" type="date" class="w-40 md:w-16 lg:mt-1 lg:w-44" v-model="date" required autofocus/>
                    </div>
                    <!-- Button to register the expense -->
                    <div class="mt-4 lg:mx-5 lg:mt-7 text-center">
                        <BreezeButton @click="newExpense">
                            Entrer
                        </BreezeButton>
                    </div>
                </div>
                <!-- Title to the expenses tab -->
                <div class="m-2 text-lg lg:m-5 lg:text-xl font-semibold font-sans tracking-wide">
                    Entrées
                </div>
                <!-- Header of the tab -->
                <div class="w-full grid grid-cols-6 gap-1 text-xs lg:text-base lg:gap-4 text-center">
                    <!-- Add 3 dots whenever the text cannot be displayed -->
                    <div class="overflow-hidden overflow-ellipsis whitespace-nowrap">
                        Payeur
                    </div>
                    <div class="overflow-hidden overflow-ellipsis whitespace-nowrap">
                        Description
                    </div>
                    <div class="overflow-hidden overflow-ellipsis whitespace-nowrap">
                        À rembourser
                    </div>
                    <div class="overflow-hidden overflow-ellipsis whitespace-nowrap">
                        Date
                    </div>
                    <div class="overflow-hidden overflow-ellipsis whitespace-nowrap">
                        Remboursé
                    </div>
                </div>
                <!-- Content of the tab -->
                <div class="w-full h-56 border-t-2 border-yellow-200 overflow-y-scroll">
                    <Entry v-for="expense in expenses" :key="expense.id" :payer="Yo" :title="expense.name" :price="expense.cost" :date="expense.date" :isPaid="false"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// Imports
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import Entry from '@/Components/Entry.vue';
import ConfirmModal from '@/Components/ConfirmModal.vue';
import axios from 'axios';

export default {
    props: {
            description: String,
            name: String,
            budget: Number,
            total: Number,
            to_pay: Number,
            expenses: Array,
            space_id: Number
        },
    components : {
        BreezeInput,
        BreezeLabel,
        BreezeButton,
        Entry,
        ConfirmModal
    },
    data() {
        return {
            expenseName: '',
            montant: 0,
            date: '',
            isEditing : false,
            isDeleting : false,
            space_name : this.name,
            space_budget : this.budget,
            space_description : this.description
        }
    },
    computed: {
        totalTransactions(){
            let sum = 0;
            this.expenses.forEach(expense =>{
                sum += expense.cost;
            });
            return sum;
        },
        totalToPay(){
            let sum = 0;
            this.expenses.forEach(expense =>{
                if(!expense.is_paid){
                    sum += expense.cost;
                }
            });
            return sum;
        }
    },
    methods : {
        // Methods used to close the component
        close() {
            this.$emit('close');
        },
        // Add a new expense
        newExpense(){
            let data = {
                space_id: this.space_id,
                name: this.expenseName,
                montant: this.montant,
                date: this.date
            }
            if(this.expenseName != ''){//Create the expense only when the name is not empty
                axios.post('/newExpense', data)
                    .then(res => {
                        console.log(res);
                        this.expenses.push(res.data);
                    }).catch(err => {
                    console.log(err);
                })
            }
        },
        deleteExpense(expense_id){
            let data = { id: expense_id }
            let idArray = null;
            axios.post('/deleteExpense', data)
                .then(res => {
                    if(res.data){
                        this.expenses.forEach(expense => {
                            if(expense.id == expense_id){ //Find the position of the list in the array to delete
                                idArray = this.expenses.indexOf(expense);
                            }
                        });
                        this.expenses.splice(idArray,1);//Remove the list in array
                    }
                }).catch(err => {
                console.log(err);
            })
        },
        updateSpace(){
            let data = {
                space_id: this.space_id,
                name: this.space_name,
                description: this.space_description,
                budget: this.space_budget
            }
            this.isEditing = false;
            this.$emit('updateSpace', data);
        },
        deleteSpace(){
            this.$emit('deleteSpace');
        },
        // Show the input to rename the name of the space
        startEditingSpaceName(){
            this.isEditing=true;
        },
        // Hide the input to rename the name of the space
        stopEditingSpaceName(){
            this.isEditing=false;
        },
        // Open the modal used to confirm the deletion
        startDeleting(){
            this.isDeleting=true;
        },
        // Hide the modal used to confirm the deletion
        stopDeleting(){
            this.isDeleting=false;
        }
    },
    // Directive used to detect click oustide of the component
    directives : {
        clickoutside : {
            beforeMount(el, binding, vnode) {
                el.clickOutsideEvent = function (event) {
                    if (!(el === event.target || el.contains(event.target))) {
                        binding.value(event, el);
                    }
                };
                document.body.addEventListener('click', el.clickOutsideEvent);
            },
            unmounted(el) {
                document.body.removeEventListener('click', el.clickOutsideEvent);
            }
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
