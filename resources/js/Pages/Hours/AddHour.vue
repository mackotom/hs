<script>

    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import Select from '@/Components/Select.vue';
    import dayjs from 'dayjs'
    import HourStatus from '@/Services/HourStatus';
    import { Breadcrumb, BreadcrumbItem } from 'flowbite-vue';


    export default {

        setup () {

            const form = useForm({
                reason: '',
                hours: 1,
                status: 1,
                date: dayjs().format('YYYY-MM-DD'),
            })


            function submit() {
                form.post(route('hours.store'))
            }


            return {form, submit}

        },

        props: {
            statuses: Array
        },

        components: {
            Head,
            AuthenticatedLayout,
            Link,
            InputError,
            InputLabel,
            PrimaryButton,
            TextInput,
            Select,
            Breadcrumb,
            BreadcrumbItem
        },

        computed: {
            statusesOptions() {
                return new HourStatus().getStatusesOptions(this.statuses)
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
                    Add
                </BreadcrumbItem>
            </Breadcrumb>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Additional Hour Information</h2>

                        <p class="mt-1 text-sm text-gray-600">
                            Create new additional hour.
                        </p>
                    </header>

                    <form @submit.prevent="submit" class="mt-4">
                        <div>
                            <InputLabel for="reason" value="Reason" />

                            <TextInput
                                id="reason"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.reason"
                                autofocus
                                autocomplete="reason"
                            />

                            <InputError class="mt-2" :message="form.errors.reason" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="email" value="Number of hours" />

                            <TextInput
                                id="hours"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.hours"
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.hours" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="date" value="Date" />

                            <TextInput
                                id="date"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.date"
                                autocomplete="new-date"
                            />

                            <InputError class="mt-2" :message="form.errors.date" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="status" value="Status" />
                            <Select id="status" class="mt-1 block w-full" v-model="form.status" :options="statusesOptions"></Select>
                            <InputError class="mt-2" :message="form.errors.status" />
                        </div>

                        <div class="flex items-center mt-4">
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Add
                            </PrimaryButton>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>

</template>