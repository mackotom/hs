<script>

    import { useForm } from '@inertiajs/inertia-vue3'
    import { Badge } from 'flowbite-vue'
    import dayjs from 'dayjs'

    export default {


        setup() {

            const form = useForm({})

            function deleteHour(id) {
                form.delete(route('hours.delete', {additional_hour: id}))
            }

            function editHour() {

            }
            
            return { form, deleteHour, editHour }

        }, 

        props: {
            hour: Object
        },


        components: {
            Badge
        },


        computed: {
            createdAtToString () {
                return dayjs(this.hour.date).format('DD/MM/YYYY')
            }
        }

    }


</script>



<template>

    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ hour.id }}
        </th>
        <td class="py-4 px-6">
            {{ hour.reason }}
        </td>
        <td class="py-4 px-6">
            {{ hour.hours }}
        </td>
        <td class="py-4 px-6">
            <Badge :type="hour.status.color">{{ hour.status.code }}</Badge>
        </td>
        <td class="py-4 px-6">
            {{ createdAtToString }}
        </td>
        <td class="py-4 px-6 text-right">
            <form @submit.prevent="deleteHour(hour.id)">
                <button class="font-medium text-red-600 dark:text-red-500 hover:underline" :disabled="form.processing" >
                    Delete
                </button>
            </form>
        </td>
    </tr>

</template>