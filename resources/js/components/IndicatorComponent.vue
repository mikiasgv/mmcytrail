<template>
    <div class="row">
        <single-indicator :stats="userscount"
                title="Trailblazers" icons="user-circle"
                :total="userscount" custom="c-user"
        ></single-indicator>
        <single-indicator :stats="todayspointcount"
                title="Points" icons="credit-card"
                :total="totalpointcount"
        ></single-indicator>
        <single-indicator :stats="todaysbadgecount"
                title="Badges" icons="certificate"
                :total="totalbadgecount"
        ></single-indicator>
        <single-indicator :stats="todaysskillcount"
                title="Skills" icons="puzzle-piece"
                :total="totalskillcount"
        ></single-indicator>
    </div>
</template>

<script>
import SingleIndicator from './SingleIndicatorComponent';

export default {
    components: { SingleIndicator },
    props: ['userscount', 'records', 'todayrecord'],

    computed: {
        todayspointcount() {
            let totalPoints = 0;

            for (let record in this.todayrecord) {
                if ( this.todayrecord.hasOwnProperty(record) ) {
                    totalPoints += parseInt(this.todayrecord[record].points);
                }
            }

            return totalPoints;
        },
        totalpointcount() {
            let totalPoints = 0;

            for (let record in this.records) {
                if ( this.records.hasOwnProperty(record) ) {
                    this.records[record].forEach(record => {
                        totalPoints += parseInt(record.points);
                    })
                }
            }

            return totalPoints;
        },
        todaysbadgecount() {
            let totalBadges = 0;

            for (let record in this.todayrecord) {
                if ( this.todayrecord.hasOwnProperty(record) ) {
                    totalBadges += parseInt(this.todayrecord[record].badges);
                }
            }

            return totalBadges;
        },
        totalbadgecount() {
            let totalBadges = 0;

            for (let record in this.records) {
                if ( this.records.hasOwnProperty(record) ) {
                    this.records[record].forEach(record => {
                        totalBadges += parseInt(record.badges);
                    })
                }
            }

            return totalBadges;
        },
        todaysskillcount() {
            let totalSkills = 0;

            for (let record in this.todayrecord) {
                if ( this.todayrecord.hasOwnProperty(record) ) {
                    totalSkills += parseInt(this.todayrecord[record].skills);
                }
            }

            return totalSkills;
        },
        totalskillcount() {
            let totalSkills = 0;

            for (let record in this.records) {
                if ( this.records.hasOwnProperty(record) ) {
                    this.records[record].forEach(record => {
                        totalSkills += parseInt(record.skills);
                    })
                }
            }

            return totalSkills;
        }
    },

    data() {
        return {
            test: this.totalbadgecount
        }
    }

}
</script>

<style scoped>

</style>
