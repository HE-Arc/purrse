<template>
    <div class="fixed table top-0 left-0 z-50 w-full h-full">
        <div class="table-cell align-middle">
            <div class="flex items-center flex-col w-1/5 h-1/5 my-0 mx-auto py-5 px-5 bg-gray-400 text-gray-700 rounded-md shadow-2xl" v-clickoutside="no">
                <div class="text-2xl">
                    Êtes-vous sûr(e) ?
                </div>
                <div class="flex flex-row justify-center text-xl m-14">
                    <button class="mx-10" @click="yes">Oui</button>
                    <button class="mx-10" @click="no">Non</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        methods : {
            yes() {
                this.$emit('yes');
                this.$emit('close');
            },
            no() {
                this.$emit('no');
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

