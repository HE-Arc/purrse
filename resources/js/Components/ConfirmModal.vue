<!-- Component used to show a confirmation modal whenever someone wants to delete an element -->
<template>
    <!-- Background of the modal -->
    <div class="fixed table top-0 left-0 z-50 w-full h-full bg-gray-400 bg-opacity-20">
        <!-- Centering of the modal -->
        <div class="table-cell align-middle">
            <!-- Modal -->
            <div class="flex items-center flex-col w-3/4 h-1/5 lg:w-1/5 lg:h-1/5 my-0 mx-auto py-5 px-5 bg-gray-400 text-gray-700 rounded-md shadow-2xl" v-clickoutside="no">
                <div class="text-2xl">
                    Êtes-vous sûr(e) ?
                </div>
                <!-- Button used for the question -->
                <div class="flex flex-row justify-center text-xl m-16">
                    <button class="mx-10 hover:text-gray-200" @click.stop="yes">Oui</button>
                    <button class="mx-10 hover:text-gray-200" @click.stop="no">Non</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        methods : {
            // Method used when the user click on yes
            yes() {
                this.$emit('yes');
                this.$emit('close');
            },
            // Method used when the user click on no
            no() {
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

