<template>
    <div class="card col-md-12 px-3">
        <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
                <i class="fas fa-medal text-md"></i>
            </div>
            <h4 class="card-title">Weekly Leaderboard</h4>
        </div>
        <div class="card-body tbl-leaders">
            <leader-board-table v-on:get-weekly-leader-board="getWeeklyLeaderBoard"
                :allrecords="allrecords"
                :paths="paths"
                :weeklydata="weeklydata"
                :leaderBoardWeeklyDataIncludingSatSun="leaderBoardWeeklyDataIncludingSatSun"
                :weeklyDataDesc="weeklyDataDesc"
            ></leader-board-table>
        </div>
    </div>
</template>
<script>
import LeaderBoardTable from './LeaderBoardTableComponent';
import gsap from 'gsap';


export default {
    components: { LeaderBoardTable },

    props: ['trainees', 'weeklydata', 'allrecords', 'paths'],

    data() {
        return {
            leaderBoardWeeklyDataIncludingSatSun: [],
            //weekdays: ['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
            weekdays: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        }
    },

    computed: {
        generateweeklybutton() {
            let ordered = [];
            for (let record in this.weeklydata) {
                if ( this.weeklydata.hasOwnProperty(record) ) {
                    ordered.push(parseInt(record));
                }
            }

            ordered.reverse();

            return ordered;
        },
        weeklyDataDesc() {
            //this will return an arry of orderd week numbers like 19, 29 ,21 => 21, 20 , 19
            for (let record in this.weeklydata) {
                if ( this.weeklydata.hasOwnProperty(record) ) {
                    return  Object.keys(this.weeklydata).sort().reverse();
                }
            }

        }
    },

    watch: {
        // weeklyDataDesc(newVal, oldVal) {
        //     if(newVal.length) {
        //         //this function will return the top six leaders data
        //         //organized by date starting from sat

        //         //let prevWeekDays = ['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'];

        //         //if there are previous weeks
        //         let tempWeeklyRecord = {};
        //         let allWeeklyOrganizedData = [];
        //         let weekTotalPoints = 0;

        //         if(this.weeklyDataDesc.length >= 2) {
        //             let currentWeek = this.weeklyDataDesc[0];
        //             let prevweek = this.weeklyDataDesc[1];

        //             this.trainees.forEach(blazer => {
        //                 weekTotalPoints = 0;
        //                 this.weekdays.forEach(day => {
        //                     if(day == "Sat" || day == "Sun") {
        //                         //previous week points only for sat and sun
        //                         this.weeklydata[prevweek].forEach(weekrecord => {
        //                             if(blazer.trainee_Id == weekrecord.trainee_Id && weekrecord.date_on == day) {
        //                                 tempWeeklyRecord[day] = weekrecord.points;
        //                                 weekTotalPoints += parseInt(weekrecord.points);
        //                             }
        //                         });
        //                     }else {
        //                         //current week points per day mon, tue , wed
        //                         this.weeklydata[currentWeek].forEach(weekrecord => {
        //                             if(blazer.trainee_Id == weekrecord.trainee_Id && weekrecord.date_on == day) {
        //                                 tempWeeklyRecord[day] = weekrecord.points;
        //                                 weekTotalPoints += parseInt(weekrecord.points);
        //                             }
        //                         });
        //                     }
        //                 });

        //                 tempWeeklyRecord["trainee"] = blazer;
        //                 tempWeeklyRecord["weekTotalPoints"] = weekTotalPoints;

        //                 allWeeklyOrganizedData.push(tempWeeklyRecord);
        //                 tempWeeklyRecord = {};

        //             });


        //         } else {
        //             //means it is the first week of the year
        //             let currentWeek = this.weeklyDataDesc[0];

        //             this.trainees.forEach(blazer => {
        //                 weekTotalPoints = 0;
        //                 this.weekdays.forEach(day => {
        //                     if(day == "Sat" || day == "Sun") {
        //                     }else {
        //                         //current week points per day mon, tue , wed
        //                         this.weeklydata[currentWeek].forEach(weekrecord => {
        //                             if(blazer.trainee_Id == weekrecord.trainee_Id && weekrecord.date_on == day) {
        //                                 tempWeeklyRecord[day] = weekrecord.points;
        //                                 weekTotalPoints += parseInt(weekrecord.points);
        //                             }
        //                         });
        //                     }
        //                 });

        //                 tempWeeklyRecord["trainee"] = blazer;
        //                 tempWeeklyRecord["weekTotalPoints"] = weekTotalPoints;

        //                 allWeeklyOrganizedData.push(tempWeeklyRecord);
        //                 tempWeeklyRecord = {};

        //             });
        //         }

        //         this.leaderBoardWeeklyDataIncludingSatSun = allWeeklyOrganizedData;

        //     }
        // },

        weeklyDataDesc(newVal, oldVal) {
            if(newVal.length) {
                //this function will return the top six leaders data
                //organized by date starting from sat

                //let prevWeekDays = ['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'];

                //if there are previous weeks
                let tempWeeklyRecord = {};
                let allWeeklyOrganizedData = [];
                let weekTotalPoints = 0;

                let currentWeek = this.weeklyDataDesc[0];
                    let prevweek = this.weeklyDataDesc[1];

                    this.trainees.forEach(blazer => {
                        weekTotalPoints = 0;
                        this.weekdays.forEach(day => {
                            //current week points per day mon, tue , wed
                            this.weeklydata[currentWeek].forEach(weekrecord => {
                                if(blazer.trainee_Id == weekrecord.trainee_Id && weekrecord.date_on == day) {
                                    tempWeeklyRecord[day] = weekrecord.points;
                                    weekTotalPoints += parseInt(weekrecord.points);
                                }
                            });
                        });

                        tempWeeklyRecord["trainee"] = blazer;
                        tempWeeklyRecord["weekTotalPoints"] = weekTotalPoints;

                        allWeeklyOrganizedData.push(tempWeeklyRecord);
                        tempWeeklyRecord = {};

                    });

                this.leaderBoardWeeklyDataIncludingSatSun = allWeeklyOrganizedData;

            }
        }
    },

    methods: {
        isEmpty(obj) {
            for(var prop in obj) {
                if(obj.hasOwnProperty(prop)) {
                return false;
                }
            }

            return JSON.stringify(obj) === JSON.stringify({});
        },

        getWeeklyLeaderBoard(week) {
            let tempWeeklyRecord = {};
            let allWeeklyOrganizedData = [];
            let weekTotalPoints = 0;

            let currentWeek = week;

            this.trainees.forEach(blazer => {
                weekTotalPoints = 0;
                this.weekdays.forEach(day => {
                    //current week points per day mon, tue , wed
                    this.weeklydata[currentWeek].forEach(weekrecord => {
                        if(blazer.trainee_Id == weekrecord.trainee_Id && weekrecord.date_on == day) {
                            tempWeeklyRecord[day] = weekrecord.points;
                            weekTotalPoints += parseInt(weekrecord.points);
                        }
                    });
                });

                tempWeeklyRecord["trainee"] = blazer;
                tempWeeklyRecord["weekTotalPoints"] = weekTotalPoints;

                allWeeklyOrganizedData.push(tempWeeklyRecord);
                tempWeeklyRecord = {};

            });

            this.leaderBoardWeeklyDataIncludingSatSun = allWeeklyOrganizedData;
            this.animateTable();
        },

        animateTable() {
            gsap.from('.tr-leaders', {
                duration: 0.5,
                opacity: 0,
                scale: 0,
                x:  -100,
                ease: 'power1',
                stagger: {
                    each: 0.1,
                    from: 'start'
                }
            });

            gsap.to('.tr-leaders', {
                duration: 0.5,
                opacity: 1,
                scale: 1,
                x:  0,
                ease: 'power1',
                stagger: {
                    each: 0.1,
                    from: 'start'
                }
            });
        }
    }
}
</script>

<style>

</style>
