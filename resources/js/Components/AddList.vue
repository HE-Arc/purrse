<!-- Component used as a button to add a new list -->
<template>
    <!-- Button -->
    <div class="min-w-min flex items-center justify-center mr-10">
        <p @click.stop="newList" class="m-5 p-7 border-2 border-yellow-200 border-dashed rounded-lg font-semibold text-yellow-200 font-sans tracking-wide">+</p>
    </div>
</template>
<script>
    export default {
        methods :{
            // Method which will emit an event to add a new list
            newList() {
                this.$emit('new-list');
            }
        }
    }
</script>
