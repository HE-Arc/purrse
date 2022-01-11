<template>
    <li class="p-4 m-3 flex justify-between items-center bg-yellow-200 shadow rounded-lg cursor-pointer">
        <div class="flex flex-row">
            <BreezeInput id="space_name" type="text" class="block w-40" v-model="space_name" required autofocus/>
            <div class="ml-2 mt-2 w-6 h-6">
                <img src="../Icons/close.png" alt="Annuler l'ajout d'espace" @click="close">
            </div>
        </div>
    </li>
</template>
<script>
import BreezeInput from '@/Components/Input.vue'

export default {
    components : {
        BreezeInput,
    },
    data() {
        return {
            space_name : ''
        }
    },
    methods : {
        close() {
            this.$emit('customClose');
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
