<script>

    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';

    export default {

        components : {
            TextInput,
            InputLabel,
            PrimaryButton,
            InputError
        },

    
        setup(props) {

            const form = useForm({
                firstname: props.additionalHourContact.firstname,
                lastname: props.additionalHourContact.lastname,
                email: props.additionalHourContact.email,
                send_at: props.additionalHourContact.send_at,
            })

            function submit() {
                form.post(route('profile.contact.store'))
            }

            return {form, submit}

        },

        
        props: {
            additionalHourContact: Object,
        },


    }


</script>


<template>

    <header>
        <h2 class="text-lg font-medium text-gray-900">Edit Contact</h2>

        <p class="mt-1 text-sm text-gray-600">
            Contact reference for sending monthly summary email.
        </p>
    </header>

    <form @submit.prevent="submit" class="mt-4">
        <div>
            <InputLabel for="firstname" value="Firstname" />

            <TextInput
                id="firstname"
                type="text"
                class="mt-1 block w-full"
                v-model="form.firstname"
                autofocus
                autocomplete="firstname"
            />

            <InputError class="mt-2" :message="form.errors.firstname" />
        </div>

        <div class="mt-4">
            <InputLabel for="lastname" value="Lastname" />

            <TextInput
                id="lastname"
                type="text"
                class="mt-1 block w-full"
                v-model="form.lastname"
                autofocus
                autocomplete="lastname"
            />

            <InputError class="mt-2" :message="form.errors.lastname" />
        </div>

        <div class="mt-4">
            <InputLabel for="email" value="Contact Email" />

            <TextInput
                id="email"
                type="text"
                class="mt-1 block w-full"
                v-model="form.email"
                autocomplete="contact@example.com"
            />

            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">
            <InputLabel for="send_at" value="Send At" />
            <p class="mt-1 text-sm text-gray-600">
                Day of the month, when the summary mail is send. Between 1 and 28.
            </p>
            <TextInput
                id="send_at"
                type="number"
                class="mt-1 block w-full"
                v-model="form.send_at"
            />

            <InputError class="mt-2" :message="form.errors.send_at" />
        </div>

        

        <div class="flex flex-row mt-4">
            <div>
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Edit
                </PrimaryButton>
            </div>
        </div>

    </form>


</template>