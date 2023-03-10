<script>

    export default {

        props: {
            type: {
                type: String,
                default: 'info',
            },
            message: {
                type: String,
            }
        },

        computed : {

            alertData () {

                switch (this.type) {

                    case 'success': 
                        return {
                            label: 'Success',
                            color: 'emerald',
                            message: this.message
                        }
                    case 'error':
                        return {
                            label: 'Error',
                            color: 'red',
                            message: this.message
                        }
                    default:
                        return {
                            label: 'Info',
                            color: 'indigo',
                            message: this.message
                        }
                }

            } 

        }

    }

</script>

<template>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex text-center py-4">
        <div :class="`grow p-2 bg-${alertData.color}-800 items-center text-${alertData.color}-100 leading-none lg:rounded-full flex lg:inline-flex`" role="alert">
            <span :class="`flex rounded-full bg-${alertData.color}-500 uppercase px-2 py-1 text-xs font-bold mr-3`">{{ alertData.label }}</span>
            <span class="font-semibold mr-2 text-left flex-auto">{{ alertData.message }}</span>
        </div>
    </div>


</template>


