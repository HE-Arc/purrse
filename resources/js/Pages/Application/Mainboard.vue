<template>
    <Head title="Mainboard"/>

    <LogoutMenu>
    <div>
        Liste
    </div>
    <div>
        Liste
    </div>
    <div>
        Liste
    </div>
    </LogoutMenu>
</template>

<script>
import LogoutMenu from '@/Layouts/Logout.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
      LogoutMenu,
      Head,
      Link,
    },
}
</script>
