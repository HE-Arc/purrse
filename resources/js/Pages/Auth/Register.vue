<template>
    <Head title="Register" />

    <BreezeValidationErrors class="mb-4" />

    <form class="text-white" @submit.prevent="submit">
        <div>
            <BreezeLabel for="username" value="Pseudo" />
            <BreezeInput id="username" type="text" class="mt-1 block w-full" v-model="form.username" required autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="firstname" value="Prénom" />
            <BreezeInput id="firstname" type="text" class="mt-1 block w-full" v-model="form.firstname" required autocomplete="firstname" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="lastname" value="Nom de famille" />
            <BreezeInput id="lastname" type="text" class="mt-1 block w-full" v-model="form.lastname" required autocomplete="lastname" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password" value="Mot de passe" />
            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password_confirmation" value="Confirmer le mot de passe" />
            <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full bg-gray-400" v-model="form.password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <Link :href="route('login')" class="underline text-sm text-gray-100 hover:text-gray-300">
                Déjà enregistré ?
            </Link>

            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                S'enregistrer
            </BreezeButton>
        </div>
    </form>
</template>

<style scoped>

</style>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },

    data() {
        return {
            form: this.$inertia.form({
                username: '',
                email: '',
                firstname: '',
                lastname: '',
                password: '',
                password_confirmation: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    },
}
</script>
