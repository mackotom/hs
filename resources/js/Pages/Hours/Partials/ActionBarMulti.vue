<script>

    import Select from '@/Components/Select.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import HourStatus from '@/Services/HourStatus';
    import TextInput from '@/Components/TextInput.vue';
    import ApplyButton from '@/Components/ApplyButton.vue';
    import { useForm } from '@inertiajs/inertia-vue3';

    export default {

        props : {   
            statuses: {
                type: Array,
                default: []
            },
            hoursSelected: {
                type: Array
            }
        },

        components: {
            Select,
            InputLabel,
            TextInput,
            ApplyButton
        },

        data () {
            return {
                form: useForm({
                    status: null,
                    date: null,
                    hours: null
                })
            }
        },

        methods: {

            submit() {
                this.form.hours = this.hoursSelected.map(hour => hour.id)
                this.form.post(route('hours.update.bulk'));
            }

        },


        computed: {

            /**
             * Return select options for status
             */
            statusesOptions() {
                return new HourStatus().getStatusesOptions(this.statuses)
            },
    
            /**
             * Count selected hours
             */
            countSelectedHours() {
                return this.hoursSelected.length
            }

        }


    }

</script>


<template>

    <nav class="bg-white dark:bg-gray-700 shadow sm:rounded-lg my-4" v-if="countSelectedHours > 0">
        <div class="max-w-screen-xl px-4 py-3 mx-auto md:px-6">
            <div class="flex flex-row items-center">
                <ul class="flex flex-row mt-0 mr-6 space-x-8 text-sm font-medium">
                    <li>
                        <InputLabel for="status" value="New Status" />
                        <Select placeholder="Don't change" v-model="form.status" id="status" class="mt-1 block w-full" :options="statusesOptions" />
                    </li>
                    <li>
                        <InputLabel for="date" value="New Date" />
                        <TextInput
                            id="date"
                            type="date"
                            class="mt-1 block w-full"
                            autocomplete="new-date"
                            v-model="form.date"
                        />
                    </li>
                </ul>
                <div class="flex flex-col flex-grow justify-end">
                    <div class="flex justify-end">
                        <ApplyButton @click.prevent="submit" :disabled="form.processing">
                            APPLY
                        </ApplyButton>
                    </div>
                    <div class="flex justify-end mt-1">
                        <p class="text-gray-600 text-xs italic">On {{ countSelectedHours }} selected hours</p>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</template>