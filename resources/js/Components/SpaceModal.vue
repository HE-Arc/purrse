<template>
    <div class="fixed table top-0 left-0 z-50 w-full h-full bg-black bg-opacity-50">
        <div class="table-cell align-middle">
            <div class="flex items-center flex-col w-2/4 h-3/5 my-0 mx-auto py-5 px-5 bg-gray-700 text-yellow-200 rounded-md shadow-2xl" v-clickoutside="close">
                <transition name="fade">
                    <ConfirmModal v-if="isDeleting" @close="stopDeleting" @click.stop/>
                </transition>

                <div class="flex flex-row justify-around">
                    <p v-if="!isEditing" class="m-5 text-3xl font-semibold font-sans tracking-wide">
                        {{description}}
                    </p>
                    <div v-if="isEditing" class="flex flex-row m-5">
                        <BreezeInput id="space_name" type="text" class="block w-40" v-model="space_name" required autofocus autocomplete="space_name" />
                    </div>
                    <div class="w-6 h-6 my-6" v-if="!isEditing">
                        <img src="../Icons/edit_space.png"  alt="Modifier le nom de l'espace" @click.stop="startEditingSpaceName">
                    </div>
                    <div class="w-6 h-6 my-6" v-if="isEditing">
                            <img src="../Icons/close_space.png"  alt="Annuler l'ajout de liste" @click.stop="stopEditingSpaceName">
                        </div>
                    <div class="w-6 h-6 my-6">
                        <img src="../Icons/delete_space.png"  alt="Supprimer l'espace" @click.stop="startDeleting">
                    </div>
                </div>
                <div>
                    <p v-if="!isEditing">
                        Description
                    </p>
                    <input v-if="isEditing" type="textarea">
                </div>
                <div class="flex flex-row text-xl m-4">
                    <div class="px-7" v-if="!isEditing">
                        Budget : 10'000 CHF
                    </div>
                    <div class="px-7" v-if="isEditing">
                        Budget : <BreezeInput id="space_budger" type="text" class="block w-40" v-model="space_budget" required autofocus autocomplete="space_budget" />
                    </div>
                    <div class="px-7">
                        Transactions : 2'000 CHF
                    </div>
                    <div class="px-7">
                        À payer : 2'000 CHF
                    </div>
                </div>
                <div class="flex flex-row my-3">
                    <div class="mx-5">
                        <BreezeLabel for="expenseName" value="Expense name" />
                        <BreezeInput id="expenseName" type="text" class="mt-1 block w-full" v-model="expenseName" required autofocus autocomplete="expenseName" />
                    </div>
                    <div class="mx-5">
                        <BreezeLabel for="montant" value="Montant" />
                        <BreezeInput id="montant" type="number" class="mt-1 block w-full" v-model="montant" required autofocus autocomplete="montant" />
                    </div>
                    <div class="mx-5">
                        <BreezeLabel for="date" value="Date" />
                        <BreezeInput id="date" type="date" class="mt-1 block w-full" v-model="date" required autofocus autocomplete="date" />
                    </div>
                    <div class="mx-5 mt-7">
                        <BreezeButton @click="newExpense">
                            Entrer
                        </BreezeButton>
                    </div>
                </div>
                <div class="m-5 text-xl font-semibold font-sans tracking-wide">
                    Entrées
                </div>
                <div class="flex flex-row w-full justify-between">
                    <div>
                        Payeur
                    </div>
                    <div>
                        Description
                    </div>
                    <div>
                        À rembourser
                    </div>
                    <div>
                        Date
                    </div>
                    <div>
                        Remboursé
                    </div>
                </div>
                <div class="w-full border-t-2 border-yellow-200 overflow-y-auto">
                    <Entry v-for="expense in expenses" :key="expense.id" :payer="Yo" :title="expense.name" :price="expense.cost" :date="expense.date" :isPaid="false"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import Entry from '@/Components/Entry.vue';
import ConfirmModal from '@/Components/ConfirmModal.vue';
import axios from 'axios';

export default {
    props: {
            description: String,
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
            date: ''
        }
    },
    methods : {
        close() {
            this.$emit('close');
        },
        newExpense(){
            let data = {
                space_id: this.space_id,
                name: this.expenseName,
                montant: this.montant,
                date: this.date
            }
            console.log("ouais");
            if(this.expenseName != ''){//Create the list only when the name is not empty
                console.log("ouais2");
                axios.post('/newExpense', data)
                    .then(res => {
                        console.log(res);
                        this.expenses.push(res.data);
                    }).catch(err => {
                    console.log("aa");
                    console.log(err);
                })
            }
            axios.post('/api/newList', data)
                .then(res => {
                    this.lists_arr.push(res.data);
                    console.log(res.data);
                }).catch(err => {
                console.log(err.response);
            })
        },
        startEditingSpaceName(){
            this.isEditing=true;
        },
        stopEditingSpaceName(){
            this.isEditing=false;
        },
        startDeleting(){
            this.isDeleting=true;
        },
        stopDeleting(){
            this.isDeleting=false;
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                description: '',
                montant: '',
                date: ''
            }),
            isEditing : false,
            isDeleting : false,
            space_name : '',
            space_budget : ''
        }
    },
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
    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.5s ease;
    }

    .fade-enter-from, .fade-leave-to {
        opacity: 0;
    }
</style>
