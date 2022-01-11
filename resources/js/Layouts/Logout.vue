<!-- Modified component of the header, where the disconnect button is -->
<template>
    <div>
        <nav>
            <!-- Header menu -->
            <div class="max-w-7xl mx-auto flex justify-between header">
                <!-- Content title -->
                <div class="flex flex-row items-center">
                    <div class="w-9 h-9 mt-1 ml-5 lg:w-12 lg:h-12 lg:my-3">
                        <img src="../Icons/purrse.png"  alt="Purrse icône">
                    </div>
                    <!-- Name of the page -->
                    <div class="ml-5 mt-2 lg:ml-5 lg:mt-2 text-xl font-semibold text-yellow-200">
                        Mainboard
                    </div>
                </div>

                <!-- User menu -->
                <div class="mt-4 mr-2 sm:flex sm:items-center sm:ml-6 lg:mt-0">
                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <BreezeDropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-yellow-200 hover:text-gray-900 hover:bg-yellow-300 focus:outline-none transition ease-in-out duration-150">
                                        {{ $page.props.auth.user.username }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <!-- Logout -->
                            <template #content>
                                <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                    <div class="flex flex-row">
                                        <div class="w-6 h-6 mr-1">
                                            <img src="../Icons/logout.png"  alt="Ajouter un espace">
                                        </div>
                                        <div class="mt-1">
                                            Se déconnecter
                                        </div>
                                    </div>
                                </BreezeDropdownLink>
                            </template>
                        </BreezeDropdown>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white shadow" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <slot />
        </main>
    </div>
</template>

<script>
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
//import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeDropdown,
        BreezeDropdownLink,
        //Link,
    },
    data() {
        return {
            showingNavigationDropdown: false,
        }
    },
}
</script>
<style>
    .header {
        min-height : 60px;
    }
</style>
