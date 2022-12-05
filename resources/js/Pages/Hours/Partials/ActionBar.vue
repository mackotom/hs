<script>
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import { Link } from '@inertiajs/inertia-vue3';
    import Select from '@/Components/Select.vue'
    import {ref} from 'vue'
 
    export default {

        props: {
            statuses: Array,
            filters: Object
        },

        components: {
            PrimaryButton,
            Link,
            Select
        },

        setup() {

            let url = new URL(window.location.href)

            const statusFilter = ref(url.searchParams.has('status') ? url.searchParams.get('status') : 'placeholder') 

            return {statusFilter}
        },


        methods: {
            
            handleFilterStatusChange () {

                const req = `${route('hours.index')}`

                if(this.statusFilter == 'all') {
                    return this.$inertia.get(req)
                }

                return this.$inertia.get(`${req}?status=${this.statusFilter}`)
            }

        },

    }

</script>


<template>

    <div class="flex flex-row justify-between my-4">
        <div>
            <Select :options="statuses" v-model="statusFilter" placeholder="Status Filter" @change="handleFilterStatusChange" />
        </div>
        <div>
            <Link :href="route('hours.create')">
                <PrimaryButton type="button">
                    Add Hour
                </PrimaryButton>
            </Link>
        </div>
    </div>

</template>