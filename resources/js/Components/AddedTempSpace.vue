<!-- Component used to host an input to create a new space -->
<template>
    <!-- New space -->
    <li class="p-4 m-3 flex justify-between items-center bg-yellow-200 shadow rounded-lg cursor-pointer">
        <!-- Input -->
        <div class="flex flex-row">
            <!-- Text input -->
            <BreezeInput id="space_name" type="text" class="block h-8 w-40" v-model="space_name" required autofocus/>
            <!-- Close icon -->
            <div class="ml-2 mt-1 w-6 h-6">
                <img src="../Icons/close.png" alt="Annuler l'ajout d'espace" @click="close">
            </div>
        </div>
    </li>
</template>
<script>
// Imports
import BreezeInput from '@/Components/Input.vue'

export default {
    components : {
        BreezeInput,
    },
    data() {
        return {
            // Name of the space
            space_name : ''
        }
    },
    methods : {
        // Method used to emit a close event, used to close the new space
        close() {
            this.$emit('customClose');
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
