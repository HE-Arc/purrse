<template>
    <Head title='Invitation' />
    <div class='flex flex-col justify-between h-screen pt-10 bg-gray-700 text-gray-50'>
        <main class='px-10 md:px-20 lg:px-30 xl:px-40'>
            <div class='h-full mt-36'>
                <h1 class='text-6xl font-normal leading-normal '>
                    Purrse
                </h1>
                <div v-if="!error && !listExist">
                    <p class='mt-20 text-2xl'>
                        Vous avez été invité à rejoindre la liste {{listName}}.
                    </p>
                    <br><br>
                    <button @click="accept" class='bg-yellow-200 hover:bg-yellow-400 text-gray-700 font-bold py-2 px-4 border border-black rounded mr-5'>Accepter</button>
                    <button @click="goBack" class='bg-yellow-400 hover:bg-yellow-500 text-gray-700 font-bold py-2 px-4 border border-black rounded'>Refuser</button>
                </div>
                <div v-else-if="listExist">
                    <p class='mt-20 text-2xl'>
                        Vous avez déjà la liste {{listName}} dans votre collection de liste !
                    </p>
                    <br><br>
                    <button @click="goBack" class='bg-yellow-200 hover:bg-yellow-400 text-gray-700 font-bold py-2 px-4 border border-black rounded'>Retour</button>
                </div>
                <div v-else>
                    <p class='mt-20 text-2xl'>
                        Ce lien d'invitation n'existe pas !
                    </p>
                    <br><br>
                    <button @click="goBack" class='bg-yellow-200 hover:bg-yellow-400 text-gray-700 font-bold py-2 px-4 border border-black rounded'>Retour</button>
                </div>
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
    height: 144;
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
    props: {
        listName: String,
        listToken: String,
        error: Boolean,
        listExist: Boolean
    },
    methods: {
        accept(){
            window.location.href='/accept/' + this.listToken;
        },
        goBack(){
            window.location.href='/';
        }
    }
}
</script>


