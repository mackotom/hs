<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import TrHour from './Partials/TrHour.vue';
    import WorkSvg from '@/Components/Svgs/WorkSvg.vue';
    import ActionBar from './Partials/ActionBar.vue'
    import { Breadcrumb, BreadcrumbItem } from 'flowbite-vue';
    import ActionBarMulti from './Partials/ActionBarMulti.vue';
    import HourStatus from '@/Services/HourStatus';


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
            ActionBar,
            Breadcrumb,
            BreadcrumbItem,
            ActionBarMulti
        },

        data() {
            return {}
        },


        methods : {

            /**
             * Determine if have hours or not
             */
            hoursIsEmpty () {
                return this.hours.length <= 0
            },

            /**
             * Handle select all checkbox
             */
            selectAll() {
                const is_selected = this.allSelected
                this.hours.forEach(hour => hour.selected = !is_selected)

            }

        },


        computed : {

            /**
             * Get Select options for filter bar
             */
            statusesFilterOptions() {
                return new HourStatus().getStatusesFilterOptions(this.statuses);
            },

            /**
             * Determine if all entries are selected
             */
            allSelected() {
                return this.hours.every(hour => hour.selected)
            },

            /**
             * Return only selected hours
             */
            hoursSelected() {
                return this.hours.filter(hour => hour.selected)
            }

        }

    }
    


</script>


<template>

    <Head title="Hours" />

    <AuthenticatedLayout>

        <template #header>
            <Breadcrumb>
                <BreadcrumbItem :href="route('hours.index')" home >
                    Hours
                </BreadcrumbItem>
                <BreadcrumbItem>
                    List
                </BreadcrumbItem>
            </Breadcrumb>
        </template>

        <div class="py-2">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <ActionBar :statuses="statusesFilterOptions" />

                <ActionBarMulti :show="true" :statuses="statuses" :hours-selected="hoursSelected"/>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg" v-if="!hoursIsEmpty()">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        <input type="checkbox" value="checkall" name="tablecheckall" :checked="allSelected" @click="selectAll"/>
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        #
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        <div class="flex items-center">
                                            Reason
                                        </div>
                                    </th>
                                    <th scope="col" class="py-3 px-6 text-center">
                                        Hours
                                    </th>
                                    <th scope="col" class="py-3 px-6 text-center">
                                        Status
                                    </th>
                                    <th scope="col" class="py-3 px-6 text-center">
                                        Date
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <TrHour v-for="hour in hours" :hour="hour" :checked="allSelected"/>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-col m-4" v-else>
                        <div class="flex justify-center"><WorkSvg class="max-w-xs h-auto"/></div>
                        <div class="flex justify-center mt-4">
                            <h2>No Additional Hour Found</h2>
                        </div>
                    </div>


                </div>
            </div>
        </div>




    </AuthenticatedLayout>

</template>