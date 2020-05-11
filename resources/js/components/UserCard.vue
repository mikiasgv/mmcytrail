<template>
  <div v-if="record.length" class="col-md-6 col-lg-3 single-card mb-4" :data-rank="rank[0].rank_Id"
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

            <div class="d-flex justify-content-center my-4 flex-wrap">
                <div class="d-flex flex-column mx-2 my-2">
                    <i class="fas fa-star text-primary text-md"></i>
                    <h5 class="text-sm mt-2">Rank</h5>
                    <div class="badge badge-success p-2" v-text="rank[0].rank"></div>
                </div>
                <div class="d-flex flex-column mx-2 my-2">
                    <i class="fas fa-credit-card text-primary text-md"></i>
                    <h5 class="text-sm mt-2">Points</h5>
                    <div class="badge badge-success p-2" v-text="record[0].point"></div>
                </div>
                <div class="d-flex flex-column mx-2 my-2">
                    <i class="fas fa-certificate text-primary text-md"></i>
                    <h5 class="text-sm mt-2">Badges</h5>
                    <div class="badge badge-success p-2"  v-text="badge.length"></div>
                </div>
                <div class="d-flex flex-column mx-2 my-2">
                    <i class="fas fa-puzzle-piece text-primary text-md"></i>
                    <h5 class="text-sm mt-2">Skills</h5>
                    <div class="badge badge-success p-2" v-text="skill.length"></div>
                </div>
            </div>
            <!-- <p class="card-description" v-if="skill.length">
                <span v-for="s in skill" :key="s.skill" v-text="s.skill"></span>
            </p>
            <p class="card-description" v-else>
                <span>General</span>
            </p> -->
            <a href="javascript:;" class="btn btn-primary btn-round">Learn More</a>
        </div>
    </div>
  </div>
</template>

<script>
import gsap from 'gsap';

export default {
    props: ['trainee', 'ranks', 'records', 'skills', 'badges', 'badgerecords', 'skillrecords'],
    data() {
        return {
        }
    },
    mounted() {
        gsap.from('.single-card', {
            duration: 0.5,
            opacity: 0,
            scale: 0,
            y:  100,
            ease: 'power1',
            stagger: {
                each: 0.1,
                from: 'edges'
            }
        });

        gsap.to('.single-card', {
            duration: 0.5,
            opacity: 1,
            scale: 1,
            y:  0,
            ease: 'power1',
            stagger: {
                each: 0.1,
                from: 'edges'
            }
        });
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
</style>
