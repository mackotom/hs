<script>

    import { useForm, Link } from '@inertiajs/inertia-vue3'
    import { Badge } from 'flowbite-vue'
    import dayjs from 'dayjs'

    export default {


        setup() {

            const form = useForm({})

            function deleteHour(id) {
                form.delete(route('hours.delete', {additional_hour: id}))
            }
            
            return { form, deleteHour }

        },

        props: {
            hour: Object,
            checked: Boolean
        },


        components: {
            Badge,
            Link
        },

        data() {
            return {
                selectedHours: []
            }
        },


        computed: {
            createdAtToString () {
                return dayjs(this.hour.date).format('DD/MM/YYYY')
            }
        },


    }


</script>



<template>

    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <td scope="row" class="py-4 px-6">
            <input type="checkbox" :value="hour.id" name="table-checkbox" v-model="hour.selected"/>
        </td>
        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ hour.id }}
        </th>
        <td class="py-4 px-6">
            {{ hour.reason }}
        </td>
        <td class="py-4 px-6 text-center">
            {{ hour.hours }}
        </td>
        <td class="py-4 px-6 text-center">
            <Badge :type="hour.status.color">{{ hour.status.code }}</Badge>
        </td>
        <td class="py-4 px-6 text-center">
            {{ createdAtToString }}
        </td>
        <td class="py-4 px-6 h-0">
            <div class="flex justify-end space-x-4">
                <div>
                    <Link :href="route('hours.edit', hour.id)">Edit</Link>
                </div>

                <div>
                    <form @submit.prevent="deleteHour(hour.id)">
                        <button class="font-medium text-red-600 dark:text-red-500 hover:underline" :disabled="form.processing" >
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </td>
    </tr>

</template>