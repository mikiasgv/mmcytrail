<template>
    <div class="col-md-12 col-lg-12 col-xl-12 col-2xl-6">
        <div class="card card-chart">
            <div class="card-header card-header-warning">
                <div class="choose-charts">
                   <div class="d-flex flex-row justify-content-center w-100 bg-white px-2 py-2">
                       <button class="btn btn-sm btn-dark-500 mx-1" @click="changeChartType('AreaChart')">
                           <span>Area</span>
                       </button>
                       <button class="btn btn-sm btn-dark-500 mx-1" @click="changeChartType('LineChart')">
                           <span>Line</span>
                        </button>
                        <button class="btn btn-sm btn-dark-500 mx-1" @click="changeChartType('BarChart')">
                           <span>Bar</span>
                        </button>
                   </div>
               </div>
                <div class="d-flex flex-wrap w-100" v-cloak>
                    <div class="flex-sm-fill w-100 p-h">
                        <GChart class="flex-fill"
                            :type="chartTypeChoice"
                            :data="pointsData"
                            :options="chartOptions"
                            :resizeDebounce="200"
                        />
                    </div>
                    <div class="flex-sm-fill w-50 p-h">
                        <GChart
                            :type="chartTypeChoice"
                            :data="badgesData"
                            :options="chartOptions"
                        />
                    </div>
                    <div class="flex-sm-fill w-50 p-h">
                        <GChart
                            :settings="{ packages: ['corechart'] }"
                            :type="chartTypeChoice"
                            :data="skillsData"
                            :options="chartOptions"
                        />
                    </div>
                </div>
            </div>
            <div class="card-body">
               <div class="total-stat">
                    <h4 class="card-title ml-2">Weekly Stats</h4>
                    <div class="d-flex flex-row flex-wrap w-100 mb-2">
                        <button class="btn btn-outline-primary btn-round border-0 btn-sm mr-1">
                            <span class="text-dark">Total Points:</span>
                            <span class="ml-2 text-bold text-sm text-muted">{{returnCommaSeparatedNumber(weekTotalPoint)}}</span>
                            <div class="ripple-container"></div>
                        </button>
                        <button class="btn btn-outline-primary btn-round border-0 btn-sm mr-1">
                            <span class="text-dark">Total Badges:</span>
                            <span class="ml-2 text-bold text-sm text-muted">{{returnCommaSeparatedNumber(weekTotalBadge)}}</span>
                            <div class="ripple-container"></div>
                        </button>
                        <button class="btn btn-outline-primary btn-round border-0 btn-sm">
                            <span class="text-dark">Total Skills:</span>
                            <span class="ml-2 text-bold text-sm text-muted">{{returnCommaSeparatedNumber(weekTotalSkill)}}</span>
                            <div class="ripple-container"></div>
                        </button>
                    </div>
               </div>
            </div>
            <div class="card-footer">
                <div class="stats d-flex flex-row flex-wrap w-100 mb-2">
                    <div v-for="(week, index) in generateweeklybutton" :key="index">
                        <button v-if="index==0" class="btn btn-sm btn-dark-600" @click="buildChart(week)">This Week</button>
                        <button v-else-if="index==1" class="btn btn-sm btn-dark-600" @click="buildChart(week)">Last Week</button>
                        <button v-else class="btn btn-sm btn-dark-600" @click="buildChart(week)">{{index}} Weeks Ago</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Utilities from '../helpers/utilities.js';

export default {
    props: ['weeklydata'],
    data () {
    return {
        weekdays: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      // Array will be automatically processed with visualization.arrayToDataTable function
      pointsData: [],

      skillsData: [],

      badgesData: [],

      chartOptions: {
        chart: {
          title: 'Trailhead Performance',
        },
        curveType: 'function',
        legend: {position: 'bottom', maxLines: 3},
      },
      weekTotalPoint: 0,
      weekTotalBadge: 0,
      weekTotalSkill: 0,

      chartTypeChoice: 'AreaChart'
    }
  },
  watch: {
        generateweeklybutton(newVal, oldVal) {
            if(newVal.length) {
                this.buildChart(newVal[0]);
            }
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
      }
  },

  methods: {
      changeChartType(type) {
          this.chartTypeChoice = type;
      },

      buildChart(week) {
          //console.log(week);
          this.resetChart();

          let points = 0;
          let badges = 0;
          let skills = 0;

          let sigleSkillsData = [];
          let siglePointssData = [];
          let sigleBadgesData = [];

          // mon, tue, wed....
          //[mon, 20, 30]
          this.weekdays.forEach(day => {
              sigleSkillsData.push(day);
              siglePointssData.push(day);
              sigleBadgesData.push(day);
              points = 0;
              badges = 0;
              skills = 0;

              for (let record in this.weeklydata) {
                if ( this.weeklydata.hasOwnProperty(record) && record == week ) {

                    this.weeklydata[record].forEach(trail => {
                        //Mon total, tue total..so on
                        if(trail.date_on == day) {
                            points += parseInt(trail.points);
                            badges += parseInt(trail.badges);
                            skills += parseInt(trail.skills);

                            //this week total including mon, tue, wed...
                            this.weekTotalPoint +=  parseInt(trail.points);
                            this.weekTotalBadge +=  parseInt(trail.badges);
                            this.weekTotalSkill +=  parseInt(trail.skills);
                        }
                    });
                }
              }

              siglePointssData.push(points);
              sigleBadgesData.push(badges);
              sigleSkillsData.push(skills);

              this.pointsData.push(siglePointssData);
              this.badgesData.push(sigleBadgesData);
              this.skillsData.push(sigleSkillsData);
              sigleSkillsData = [];
              siglePointssData = [];
              sigleBadgesData = [];

          })
      },

      resetChart() {
          // Empty array
          this.pointsData = [];
          this.badgesData = [];
          this.skillsData = [];

          this.pointsData.push(['Week', 'Points']);
          this.badgesData.push(['Week', 'Badges']);
          this.skillsData.push(['Week', 'Skills']);

          this.weekTotalPoint =  0;
          this.weekTotalBadge =  0;
          this.weekTotalSkill =  0;
      },

      isEmpty(obj) {
        for(var prop in obj) {
            if(obj.hasOwnProperty(prop)) {
            return false;
            }
        }

        return JSON.stringify(obj) === JSON.stringify({});
      },

      returnCommaSeparatedNumber(x) {
        return Utilities.numberWithCommas(x);
      }
  }
}
</script>

<style>
.p-h {
    padding: 0.1rem !important;
}
</style>
