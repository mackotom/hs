import Trans from '@/Services/Trans';

export default class HourStatus {

    /**
     * Convert Statuses in Filter Options for Select
     * 
     * @param {Array} statuses 
     * @returns 
     */
    getStatusesFilterOptions(statuses) {

        const filters = statuses.map(function(el) { 
            return {
                value: el.code,
                label: new Trans().getTypes()[el.code],
                selected: el.code === 'requested' ? true : false
            }
        })

        filters.unshift({
            value: 'all',
            label: 'All'
        })

        return filters

    }

    /**
     * Convert Statuses into select options
     * 
     * @param {Array} statuses 
     * @returns 
     */
    getStatusesOptions(statuses) {
        return statuses.map(function(el) { 
            return {
                value: el.id,
                label: new Trans().getTypes()[el.code],
                selected: el.code === 'requested' ? true : false
            }
        })
    }



}