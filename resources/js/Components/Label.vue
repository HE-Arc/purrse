<template>
    <label class="block font-medium text-sm text-gray-700">
        <span class="text-yellow-400" v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>

<script>
export default {
    props: ['value']
}
</script>
