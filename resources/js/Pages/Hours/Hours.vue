<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import TrHour from './Partials/TrHour.vue';
    import WorkSvg from '@/Components/Svgs/WorkSvg.vue';
    import ActionBar from './Partials/ActionBar.vue'
    import Trans from '@/Services/Trans';


    export default {

        props: {
            hours: Array,
            statuses: Array
        },

        components: {
            Head,
            TrHour,
            AuthenticatedLayout,
            WorkSvg,
            ActionBar
        },

        methods : {
            hoursIsEmpty () {
                return this.hours.length <= 0
            }
        },


        computed : {
            statusesOptions() {
                const filters = this.statuses.map(function(el) { 
                    return {
                        value: el.code,
                        label: new Trans().getTypes()[el.code],
                        selected: el.code === 'requested' ? true : false
                    }
                })

                filters.unshift({
                    value: 'all',
                    label: 'All'
                })

                return filters

            }
        }

    }
    


</script>


<template>

    <Head title="Hours" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Hours</h2>
        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <ActionBar :statuses="statusesOptions" />

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg" v-if="!hoursIsEmpty()">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        #
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        <div class="flex items-center">
                                            Reason
                                        </div>
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        <div class="flex items-center">
                                            Hours
                                        </div>
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        <div class="flex items-center">
                                            Status
                                        </div>
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        <div class="flex items-center">
                                            Date
                                        </div>
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <TrHour v-for="hour in hours" :hour="hour"/>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-col m-4" v-else>
                        <div class="flex justify-center"><WorkSvg class="max-w-xs h-auto"/></div>
                        <div class="flex justify-center mt-4">No Additional Hour Found</div>
                    </div>


                </div>
            </div>
        </div>




    </AuthenticatedLayout>

</template>