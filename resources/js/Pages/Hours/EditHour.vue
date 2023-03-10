<script>

    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import Select from '@/Components/Select.vue';
    import Trans from '@/Services/Trans';


    export default {

        setup (props) {

            const form = useForm({
                reason: props.additionalHour.reason,
                hours: props.additionalHour.hours,
                status: props.additionalHour.status_id,
                date: props.additionalHour.date,
            })

            function submit() {
                form.put(route('hours.update', props.additionalHour.id))
            }

            return {form, submit}

        },

        props: {
            statuses: Array,
            additionalHour: Object,
        },

        components: {
            Head,
            AuthenticatedLayout,
            Link,
            InputError,
            InputLabel,
            PrimaryButton,
            TextInput,
            Select
        },

        computed: {
            statusesOptions() {
                return this.statuses.map(function(el) { 
                    return {
                        value: el.id,
                        label: new Trans().getTypes()[el.code],
                        selected: el.code === 'requested' ? true : false
                    }
                } )
            }
        }

    }

</script>


<template>

    <Head title="Hours" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link :href="route('hours.index')">Hours</Link> / #{{ additionalHour.id }} / Edit 
            </h2>
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
                                Edit
                            </PrimaryButton>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>

</template>