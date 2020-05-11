<template>
    <div>
        <indicator :userscount="dashboardData.userscount"
                    :records="dashboardData.records"
                    :todayrecord="dashboardData.todayRecord"
        ></indicator>
    </div>
</template>

<script>

import Indicator from './IndicatorComponent';

export default {
    components: { Indicator },

    data() {
        return {
            dashboardData: {
                userscount: null,
                records: null,
                todayRecord: null
            },

        }
    },

    created() {
        this.fetchRecords();
        setInterval(() => this.fetchRecords(), 180000);
    },

    methods: {
        fetchRecords() {
            axios.get('/progresses')
            .then(response => {
                this.dashboardData = response.data.data;
            })
            .catch(error => console.error(error));
        },
    }
}
</script>

<style>

</style>
