<template>
    <div class="fixed table top-0 left-0 z-50 w-full h-full bg-black bg-opacity-50">
        <div class="table-cell align-middle">
            <div class="flex items-center flex-col w-2/4 h-3/5 my-0 mx-auto py-5 px-5 bg-gray-700 text-yellow-200 rounded-md shadow-2xl" v-clickoutside="close">
                <div class="flex flex-row justify-around">
                    <p class="m-5 text-3xl font-semibold font-sans tracking-wide">
                        {{this.user.name}}
                    </p>
                    <div class="w-6 h-6 my-6">
                        <img src="../Icons/edit_space.png"  alt="Ajouter un espace">
                    </div>
                    <div class="w-6 h-6 my-6">
                        <img src="../Icons/delete_space.png"  alt="Ajouter un espace">
                    </div>
                </div>
                <div class="flex flex-row text-xl m-4">
                    <div class="px-7">
                        Budget : 10'000 CHF
                    </div>
                    <div class="px-7">
                        Transactions : 2'000 CHF
                    </div>
                    <div class="px-7">
                        À payer : 2'000 CHF
                    </div>
                </div>
                <form class="flex flex-row my-3">
                    <div class="mx-5">
                        <BreezeLabel for="description" value="Description" />
                        <BreezeInput id="description" type="text" class="mt-1 block w-full" v-model="form.description" required autofocus autocomplete="description" />
                    </div>
                    <div class="mx-5">
                        <BreezeLabel for="montant" value="Montant" />
                        <BreezeInput id="montant" type="text" class="mt-1 block w-full" v-model="form.montant" required autofocus autocomplete="montant" />
                    </div>
                    <div class="mx-5">
                        <BreezeLabel for="date" value="Date" />
                        <BreezeInput id="date" type="text" class="mt-1 block w-full" v-model="form.date" required autofocus autocomplete="date" />
                    </div>
                    <div class="mx-5 mt-7">
                        <BreezeButton>
                            Register
                        </BreezeButton>
                    </div>
                </form>
                <div class="m-5 text-xl font-semibold font-sans tracking-wide">
                    Entrées
                </div>
                <div class="w-full border-t-2 border-yellow-200 overflow-y-auto">
                    <Entry/>
                    <Entry/>
                    <Entry/>
                    <Entry/>
                    <Entry/>
                    <Entry/>
                    <Entry/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeButton from '@/Components/Button.vue'
import Entry from '@/Components/Entry.vue'

export default {
    components : {
        BreezeInput,
        BreezeLabel,
        BreezeButton,
        Entry
    },
    methods : {
        close() {
            this.$emit('close');
        }
    },
    props: ['user'],
    data() {
        return {
            form: this.$inertia.form({
                description: '',
                montant: '',
                date: ''
            })
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
