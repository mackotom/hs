<script>

    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { Breadcrumb, BreadcrumbItem } from 'flowbite-vue';
    import SwitchTabs from '../Partials/SwitchTabs.vue';
    import ContactEdit from './Partials/ContactEdit.vue';


    export default {


        props: {
            additionalHourContact: Object,
        },

        components: {
            Head,
            AuthenticatedLayout,
            Breadcrumb,
            BreadcrumbItem,
            SwitchTabs,
            ContactEdit
        },

        methods: {

        },

        computed: {
            
        }

    }

</script>


<template>

    <Head title="Contact" />

    <AuthenticatedLayout>

        <template #header>
            <Breadcrumb>
                <BreadcrumbItem :href="route('profile.edit')" home >
                    Profile
                </BreadcrumbItem>
                <BreadcrumbItem>
                    Contact
                </BreadcrumbItem>
            </Breadcrumb>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <SwitchTabs activeTab="contact"/>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <ContactEdit :additionalHourContact="additionalHourContact"/>
                </div>

            </div>
        </div>


    </AuthenticatedLayout>

</template>