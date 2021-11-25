<template>
    <Head title='Home' />
    <div class='flex flex-col justify-between h-screen pt-10 bg-gray-700 text-gray-50'>
        <main class='content px-48'>
            <div class='flex justify-end'>
                <Link :href="route('login')" class="text-sm underline">
                    Log in
                </Link>

                <Link :href="route('register')" class="ml-4 text-sm underline">
                    Register
                </Link>
            </div>
            <div class='h-full mt-36'>
                <h1 class='text-6xl font-normal leading-normal '>
                    Purrse
                </h1>
                <p class='mt-20'>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quam turpis, ullamcorper sit amet odio sit amet,
                    ltrices dictum elit. Nunc at enim a elit bibendum rhoncus eget sit amet risus. Suspendisse at ipsum sit amet ligula ullamcorper accumsan. Suspendisse gravida massa mi, et efficitur est ullamcorper porttitor. Fusce nulla metus, ultrices at condimentum a,
                    molestie mattis lacus. Quisque tincidunt ante non nisi pellentesque,
                    et scelerisque augue iaculis. Cras mi neque, condimentum eget dictum eget, rhoncus vitae dolor. Nam eu ante euismod nisi aliquam malesuada. Morbi mollis quis augue sit amet fringilla.
                </p>
            </div>
        </main>
        <footer class='bg-gray-800 py-20'>
            <p class='px-48'>
            He-arc Neuchâtel
            </p>
        </footer>
    </diV>

</template>

<style scoped>

</style>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
      Head,
      Link,
    },
}
</script>
