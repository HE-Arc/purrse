<template>
    <div class="flex items-center justify-center flex-col mr-10 bg-gray-300 rounded-lg" v-clickoutside="close">
        <div class="flex flex-row m-5">
            <BreezeInput id="list_name" type="text" class="block w-40" v-model="list_name" required autofocus autocomplete="list_name" />
            <div class="ml-3 mt-2 w-6 h-6">
                <img src="../Icons/close.png"  alt="Annuler l'ajout de liste" @click="close">
            </div>
        </div>
        <ul class="w-60 max-w-sm h-full overflow-y-auto">
        </ul>
    </div>
</template>
<script>
import BreezeInput from '@/Components/Input.vue'

export default {
    components : {
        BreezeInput,
    },
    data() {
        return {
            form: this.$inertia.form({
                list_name: '',
            })
        }
    },
    methods : {
        close() {
            this.$emit('close');
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
