<template>
    <div class="fixed table top-0 left-0 z-50 w-full h-full bg-black bg-opacity-50">
        <div class="table-cell align-middle">
            <div class="flex items-center flex-col w-2/4 h-3/5 my-0 mx-auto py-5 px-5 bg-gray-700 text-yellow-200 rounded-md shadow-2xl" v-clickoutside="close">
                <p class="m-5 text-3xl text-grey-500 font-semibold font-sans tracking-wide">
                    Ménage
                </p>
                <div class="text-xl m-4">
                    <span class="px-7">
                        Budget : 10'000 CHF
                    </span>
                    <span class="px-7">
                        Transactions : 2'000 CHF
                    </span>
                    <span class="px-7">
                        À payer : 2'000 CHF
                    </span>
                </div>
                <form class="flex flex-row">
                    <span class="mx-5">
                        <BreezeLabel for="description" value="Description" />
                        <BreezeInput id="description" type="text" class="mt-1 block w-full" v-model="form.description" required autofocus autocomplete="description" />
                    </span>
                    <span class="mx-5">
                        <BreezeLabel for="montant" value="Montant" />
                        <BreezeInput id="montant" type="text" class="mt-1 block w-full" v-model="form.montant" required autofocus autocomplete="montant" />
                    </span>
                    <span class="mx-5">
                        <BreezeLabel for="date" value="Date" />
                        <BreezeInput id="date" type="text" class="mt-1 block w-full" v-model="form.date" required autofocus autocomplete="date" />
                    </span>
                    <span>
                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Register
                        </BreezeButton>
                    </span>
                </form>
                <div class="my-5">
                    Data
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeButton from '@/Components/Button.vue'

export default {
    components : {
        BreezeInput,
        BreezeLabel,
        BreezeButton,
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
