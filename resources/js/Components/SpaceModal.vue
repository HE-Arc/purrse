<template>
    <div class="fixed table top-0 left-0 z-50 w-full h-full bg-black bg-opacity-50">
        <div class="table-cell align-middle">
            <div class="flex items-center w-2/4 h-3/5 my-0 mx-auto py-5 px-5 bg-gray-700 text-yellow-200 rounded-md shadow-2xl" v-clickoutside="close">
                <p class="m-5 text-grey-500 font-semibold font-sans tracking-wide">
                    {{description}}
                </p>
                <div>
                    <span>
                        Budget : {{budget}} CHF
                    </span>
                    <span>
                        Total : {{total}} CHF
                    </span>
                    <span>
                        À payer : {{to_pay}} CHF
                    </span>
                </div>
                <form>
                </form>
                <ul>
                    <li>Data</li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
            description: String,
            budget: Number,
            total: Number,
            to_pay: Number
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
