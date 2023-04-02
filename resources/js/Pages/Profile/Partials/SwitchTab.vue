<template>
    <li class="mr-2">
        <a :href="route(link)"  :class="tabClass" class="inline-flex p-4 border-b-2 rounded-t-lg group">
            <span :class="tabIconClass" v-html="icon"></span>
            <slot :class="tabItemClass"></slot>
        </a>
    </li>
</template>



<script>

    export default {

        props: {
            icon: {
                type: String
            },
            active: {
                type: Boolean,
                default: false  
            },
            link: {
                type: String,
                required: true
            }
        },


        computed: {
            tabClass() {
                return {
                    'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500': this.active,
                    'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300': !this.active
                }
            },

            tabItemClass() {
                return {
                    'text-blue-600 dark:text-blue-500': this.active,
                    'group-hover:text-gray-500 dark:group-hover:text-gray-300': !this.active
                }
            },

            tabIconClass() {
                return {
                    'w-5 h-5 mr-2 text-blue-600 dark:text-blue-500': this.active,
                    'w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300' : !this.active
                }
            }

        }



    }

</script>