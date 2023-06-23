<template>


    <div class="border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
            <SwitchTab link="profile.edit" :icon="iconProfile" :active="activeTab === 'profile'">
                Profile
            </SwitchTab>
            <SwitchTab link="profile.contact.edit" :icon="iconContact" :active="activeTab === 'contact'">
                Contact
            </SwitchTab>
        </ul>
    </div>

  </template>

<script>
import SwitchTab from './SwitchTab.vue';



export default {

    components: { SwitchTab },

    props: {
        activeTab: {
            type: String,
            default: 'profile'
        }
    },

    data () {
        return {}
    },

    computed: {
        iconProfile() {
            return '<svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>'
        },
        iconContact() {
            return '<svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0120.25 6v12A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V6A2.25 2.25 0 016 3.75h1.5m9 0h-9"></path></svg>'
        }
    }


}

</script>

