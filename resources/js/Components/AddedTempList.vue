<!-- Component used to host an input to create a new list -->
<template>
    <!-- New List -->
    <div class="flex items-center justify-center flex-col mr-10 bg-gray-300 rounded-lg" v-clickoutside="close">
        <!-- Input -->
        <div class="flex flex-row m-5">
            <!-- Text input -->
            <BreezeInput @keyup.enter="this.$emit('newList', list_name)" id="list_name" type="text" class="block mt-1 h-9 w-40" v-model="list_name" required autofocus autocomplete="list_name" />
            <!-- Close icon -->
            <div class="ml-3 mt-2 w-6 h-6">
                <img src="../Icons/close.png"  alt="Annuler l'ajout de liste" @click="close">
            </div>
        </div>
        <!-- Empty part to put the input at the top -->
        <ul class="w-60 max-w-sm h-full overflow-y-auto">
        </ul>
    </div>
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
            // Name of the list
            list_name: ''
        }
    },
    methods : {
        // Method used to emit a close event, used to close the new list
        close() {
            this.$emit('close');
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
