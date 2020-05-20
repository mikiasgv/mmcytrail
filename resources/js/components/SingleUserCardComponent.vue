<template>
    <!--grid-view starts here-->
        <div v-if="record.length" class="col-md-6 col-lg-4 col-xl-4 col-2xl-3 single-card mb-4" :data-rank="rank[0].rank_Id"
                                    :data-point="record[0].point"
                                    :data-badge="badge.length">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="javascript:;">
                    <img class="img" :src="trainee.photo" />
                    </a>
                </div>
                <div class="card-body" style="height:50%">
                    <h6 class="card-category text-gray" v-text="trainee.position"></h6>
                    <h4 class="card-title text-sm" v-text="trainee.fullname">Daniel Getahun</h4>
                    <h6 class="card-category text-primary text-bold text-xs" v-if="path.length" v-text="path[0].Path"></h6>

                    <div class="d-flex justify-content-center my-4 flex-wrap">
                        <div class="d-flex flex-column mx-2 my-2">
                            <i class="fas fa-star text-primary text-md"></i>
                            <h5 class="text-sm mt-2">Rank</h5>
                            <div class="badge badge-success badge-sm p-2" v-text="rank[0].rank"></div>
                        </div>
                        <div class="d-flex flex-column mx-2 my-2">
                            <i class="fas fa-credit-card text-primary text-md"></i>
                            <h5 class="text-sm mt-2">Points</h5>
                            <div class="badge badge-success badge-sm p-2" v-text="record[0].point"></div>
                        </div>
                        <div class="d-flex flex-column mx-2 my-2">
                            <i class="fas fa-certificate text-primary text-md"></i>
                            <h5 class="text-sm mt-2">Badges</h5>
                            <div class="badge badge-success badge-sm p-2"  v-text="badge.length"></div>
                        </div>
                        <div class="d-flex flex-column mx-2 my-2">
                            <i class="fas fa-puzzle-piece text-primary text-md"></i>
                            <h5 class="text-sm mt-2">Skills</h5>
                            <div class="badge badge-success badge-sm p-2" v-text="skill.length"></div>
                        </div>
                    </div>
                    <!-- <p class="card-description" v-if="skill.length">
                        <span v-for="s in skill" :key="s.skill" v-text="s.skill"></span>
                    </p>
                    <p class="card-description" v-else>
                        <span>General</span>
                    </p> -->
                    <a href="javascript:;" class="btn btn-primary btn-sm btn-round">Learn More</a>
                    <div class="w-100 bar learning">
                        <div class="progress" :style="this.animatewidth"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--grid view ends here -->

</template>

<script>
import gsap from 'gsap';

export default {
    props: ['trainee', 'paths', 'ranks', 'records', 'skills', 'badges', 'badgerecords', 'skillrecords', 'showGridView'],
    data() {
        return {

        }
    },
    mounted() {
        if(this.showGridView) {
            gsap.from('.single-card', {
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

            gsap.to('.single-card', {
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

    },

    computed: {
        record() {
            return this.records.filter(record => record.trainee_Id == this.trainee.trainee_Id);
        },
        rank() {
            if(this.record.length) {
                return this.ranks.filter(rank => rank.rank_Id == this.record[0].rank_Id)
            }
        },
        badge() {
            if(this.record.length) {
                return this.badgerecords.filter(badge => {
                     return this.record.some(record => record.record_Id == badge.record_Id);
                });
            }
        },
        skill() {
            if(this.record.length) {
                return this.skillrecords.filter(skill => {
                     return this.record.some(record => record.record_Id == skill.record_Id);
                });
            }
        },
        path() {
            if(this.paths.length) {
                return this.paths.filter(path => path.Path_Id == this.trainee.path_Id);
            }
        },
        animatewidth() {
            let progressWidth = (((parseInt(this.record[0].point) * 100) / 30000) - 10);

            if(progressWidth > 0) {
                return  `width: ${(((parseInt(this.record[0].point) * 100) / 30000) - 10)}%`;
            }

            return  `width: ${1}%`;
        }

    }
}
</script>

<style scoped>
p.card-description span {
    display: inline-block;
    border: 2px solid #dfdfdf;
    padding: 2px 4px;
    margin: 2px;
}

@keyframes load{
  from {
    width: 0%
  }
}
@-webkit-keyframes load{
  from {
    width: 0%
  }
}
@-moz-keyframes load{
  from {
    width: 0%
  }
}
@-o-keyframes load{
  from {
    width: 0%
  }
}

.bar{
  background-color: #EEE;
  padding: 2px;
  border-radius: 15px;
  margin-bottom: 5px;
  margin-top: 18px;
  font-size: 0px;
  color: #FFF;
  font-weight: bold;
  text-shadow: 1px 1px 1px rgba(0,0,0,0.5);
}
.progress{
  background-color: #4caf50;
  display: block;
  padding: 2px 0 2px 0px;
  border-radius: inherit;
  animation: load 2s 0s;
  -webkit-animation: load 2s 0s;
  -moz-animation: load 2s 0s;
  -o-animation: load 2s 0s;
  left: 0px;
  position: relative;
  top: 0px;
  height: 4px;
}

img.leaderboard {
    width: 15%;
    border-radius: 50%;
    border: 2px solid orange;
}
</style>
