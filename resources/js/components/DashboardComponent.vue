<template>
    <div>
        <indicator :userscount="dashboardData.userscount"
                    :records="dashboardData.records"
                    :todayrecord="dashboardData.todayRecord"
        ></indicator>
        <div class="row">
            <weekly-chart :weeklydata="dashboardData.recordsWeek"></weekly-chart>
            <weekly-chart :weeklydata="dashboardData.recordsWeek"></weekly-chart>
        </div>
        <weekly-leader-board
            :allrecords="dashboardData.records"
            :trainees="dashboardData.trainees"
            :weeklydata="dashboardData.recordsWeek"
            :paths="dashboardData.paths"
        ></weekly-leader-board>
    </div>
</template>

<script>

import Indicator from './IndicatorComponent';
import WeeklyChart from './WeeklyChartComponent';
import WeeklyLeaderBoard from './WeeklyLeaderBoardComponent';

export default {
    components: { Indicator, WeeklyChart, WeeklyLeaderBoard },

    data() {
        return {
            dashboardData: {
                userscount: null,
                records: null,
                todayRecord: null,
                recordsWeek: null,
                recordsMonth: null,
                trainees: null,
                paths: null,
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
.card-chart [class*=card-header-] {
    margin: 0px 32px 0 !important;
    margin-top: -20px !important;
}
.card-chart [class*=card-header-]:not(.card-header-icon):not(.card-header-text):not(.card-header-image) {
    padding: 0px !important;
}
[v-cloak] > * { display:none }
[v-cloak]::before { content: "loading…" }
</style>
