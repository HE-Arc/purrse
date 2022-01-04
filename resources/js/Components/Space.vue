<template>
    <li class="p-4 m-3 flex justify-between items-center bg-yellow-200 shadow rounded-lg cursor-pointer"
        @click="onSelect(user)">
        {{user.name}}
        <div id="sortDiv" class="hidden">
            <object data="../icons/chevron-up-solid.svg" type="image/svg+xml" height="10px" width="10px">
                <img src="../icons/chevron-up-solid.svg" alt="Sort Up" class="chevron"/>
            </object>
            <object data="../icons/chevron-down-solid.svg" type="image/svg+xml" height="10px" width="10px">
                <img src="../icons/chevron-down-solid.svg" alt="Sort Down" class="chevron"/>
            </object>
        </div>
    </li>
</template>

<script>
    export default {
        props: ['user'],
        methods: {
            onSelect(user) {
                alert(`Clicking on ${user.name}`);
            },
            show() {

            }
        }
    }
</script>
