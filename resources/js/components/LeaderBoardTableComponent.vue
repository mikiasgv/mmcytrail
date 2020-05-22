<template>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th></th>
                    <th>Name</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                    <th>Sun</th>
                    <th>Weekly Points</th>
                    <th>Over all Points</th>
                    <th>Path</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(record, index) in orderBlazersDataDesc" :key="index" class="tr-leaders">
                    <td>{{ index + 1 }}</td>
                    <td class="tbl-avatar">
                        <a class="btn-link text-dark" target="_blank" :href="getTrailHeadLink(record.trainee.username)">
                            <img class="img leaderboard" :src="record.trainee.photo" :alt="record.trainee.fullname">
                        </a>
                    </td>
                    <td class="tbl-name"><a class="btn-link text-dark" target="_blank" :href="getTrailHeadLink(record.trainee.username)">{{record.trainee.fullname}}</a></td>

                    <td><span v-if="isEmpty(record['Mon'])">0</span><span v-else>{{returnCommaSeparatedNumber(record["Mon"])}}</span></td>
                    <td><span v-if="isEmpty(record['Tue'])">0</span><span v-else>{{returnCommaSeparatedNumber(record["Tue"])}}</span></td>
                    <td><span v-if="isEmpty(record['Wed'])">0</span><span v-else>{{returnCommaSeparatedNumber(record["Wed"])}}</span></td>
                    <td><span v-if="isEmpty(record['Thu'])">0</span><span v-else>{{returnCommaSeparatedNumber(record["Thu"])}}</span></td>
                    <td><span v-if="isEmpty(record['Fri'])">0</span><span v-else>{{returnCommaSeparatedNumber(record["Fri"])}}</span></td>
                    <td><span v-if="isEmpty(record['Sat'])">0</span><span v-else>{{returnCommaSeparatedNumber(record["Sat"])}}</span></td>
                    <td><span v-if="isEmpty(record['Sun'])">0</span><span v-else>{{returnCommaSeparatedNumber(record["Sun"])}}</span></td>

                    <td class="text-center text-bold text-primary"><span>{{returnCommaSeparatedNumber(record.weekTotalPoints)}}</span></td>
                    <td class="text-center text-bold text-success">
                        {{getPersonalTotalPoints(record.trainee.trainee_Id)}}
                    </td>
                    <td>{{getPath(record.trainee.path_Id)}}</td>
                </tr>
            </tbody>
        </table>
        <div class="tbl-footer">
            <div class="stats d-flex flex-row flex-wrap w-100">
                <div v-for="(week, index) in weeklyDataDesc" :key="index">
                    <button v-if="index==0" class="btn btn-sm btn-dark-600" @click="getWeeklyLeaderBoard(week)">This Week</button>
                    <button v-else-if="index==1" class="btn btn-sm btn-dark-600" @click="getWeeklyLeaderBoard(week)">Last Week</button>
                    <button v-else class="btn btn-sm btn-dark-600" @click="getWeeklyLeaderBoard(week)">{{index}} Weeks Ago</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Utilities from '../helpers/utilities.js';

export default {
    props: ['allrecords', 'paths', 'weeklydata', 'leaderBoardWeeklyDataIncludingSatSun', 'weeklyDataDesc'],
    computed: {
        orderBlazersDataDesc() {
            if(this.leaderBoardWeeklyDataIncludingSatSun.length) {
                let allSortedBlazers = this.leaderBoardWeeklyDataIncludingSatSun.sort(function(a, b) {
                    return b.weekTotalPoints - a.weekTotalPoints;
                });

                // After sorting the item desc then take only the six of them
                return allSortedBlazers.slice(0, 6);
                //return allSortedBlazers;
            }
        },

        totalpersonalpointsfeed() {
            let totaloverallpoints = 0;
            let totalpointspername = [];

            this.orderBlazersDataDesc.forEach(leader => {
                totaloverallpoints = 0;
                for(let record in this.allrecords) {
                    if ( this.allrecords.hasOwnProperty(record) ) {
                        this.allrecords[record].forEach(recordperdayobj => {
                            if(leader.trainee.trainee_Id == recordperdayobj.trainee_Id) {
                                totaloverallpoints += parseInt(recordperdayobj.points);
                            }
                        });
                    }
                }

                totalpointspername.push({"trainee_Id": leader.trainee.trainee_Id, "total_points": totaloverallpoints});
            });

            return totalpointspername;
        }
    },

    data() {
        return {
            weekdays: ['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
            //weeklyOrganizedTrailBlazers: []
        }
    },

    methods: {
        getPersonalTotalPoints(trainee_Id) {
            let totalpoint = 0;
            this.totalpersonalpointsfeed.forEach(trainee => {
                if(trainee_Id == trainee.trainee_Id) {
                    totalpoint = trainee.total_points;
                }

            });

            return this.returnCommaSeparatedNumber(totalpoint);
            //return totalpoint;
        },

        getPath(pathID) {
            let pathNew = '';
            if(this.paths.length) {
                this.paths.forEach(path => {
                    if(path.Path_Id == pathID) {
                        pathNew = path.Path;
                    }
                });
            }

            return pathNew;
        },

        isEmpty(obj) {
            if(typeof obj !== 'undefined' && typeof obj !== 'object' && obj != null) {
                for(var prop in obj) {
                    if(obj.hasOwnProperty(prop)) {
                        return false;
                    }
                }

                return JSON.stringify(obj) === JSON.stringify({});
            }else {
                return true;
            }

        },

        returnCommaSeparatedNumber(x) {
            return Utilities.numberWithCommas(x);
        },

        getTrailHeadLink(username) {
            return `https://trailblazer.me/id/${username}`;
        },

        getWeeklyLeaderBoard(week) {
            this.$emit('get-weekly-leader-board', week);
        }
    }
}
</script>

<style>
td.tbl-avatar {
    width: 8% !important;
}
td.tbl-name {
    width: 12% !important;
}
img.leaderboard {
    width: 50%;
    border-radius: 50%;
    border: 2px solid orange;
}
</style>
