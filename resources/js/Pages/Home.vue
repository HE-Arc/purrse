<template>
    <Head title='Home' />
    <div class='flex flex-col justify-between h-screen pt-10 bg-gray-700 text-gray-50'>
        <main class='px-10 md:px-20 lg:px-30 xl:px-40'>
            <div class='flex justify-end text-yellow-200'>
                <Link :href="route('login')" class="text-2xl underline">
                    Log in
                </Link>

                <Link :href="route('register')" class="ml-4 text-2xl underline">
                    Register
                </Link>
            </div>
            <div class='h-full mt-36'>
                <h1 class='text-6xl font-normal leading-normal '>
                    Purrse
                </h1>
                <h3 class='text-4xl font-normal leading-normal mt-10'>
                    Phrase bateau avec Purrse et chat I guess
                </h3>
                <p class='mt-20 text-2xl'>
                   L'application Purrse vous permet de gérer vos dépenses avec vos amis, collègues, collocataires...
                </p>
            </div>
        </main>
        <footer class='bg-gray-800 px-10 md:px-20 lg:px-30 xl:px-40 py-56 relative'>
            <div class="wave">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
                </svg>
            </div>

            <p>
            © He-arc Neuchâtel 2021
            </p>
        </footer>
    </diV>

</template>

<style scoped>
.wave {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.wave svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 144px;
    transform: rotateY(180deg);
}

.wave .shape-fill {
    fill: #374151;
}
</style>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
      Head,
      Link,
    },
    beforeCreate: function() {
        document.body.className += ' overflow-x-hidden';
    }
}
</script>
