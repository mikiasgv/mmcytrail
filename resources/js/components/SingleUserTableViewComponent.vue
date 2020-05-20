<template>
    <tbody>
        <tr>
            <td>
                <div class="card-avatar">
                    <a href="javascript:;">
                    <img class="img leaderboard" :src="trainee.photo">
                    </a>
                </div>
            </td>
            <th>{{trainee.position}}</th>
            <th>{{trainee.fullname}}</th>
            <th><span v-if="path.length">{{path[0].Path}}</span><span v-else>No path selected yet</span></th>
            <th>{{rank[0].rank}}</th>
            <th>{{record[0].point}}</th>
            <th>{{badge.length}}</th>
            <th>{{skill.length}}</th>
            <th><button class="btn btn-sm btn-primary">Learn more</button></th>
        </tr>
    </tbody>
</template>

<script>
export default {
    props: ['trainee', 'paths', 'ranks', 'records', 'skills', 'badges', 'badgerecords', 'skillrecords'],
    data() {
        return {

        }
    },
    mounted() {
        // gsap.from('.single-card', {
        //     duration: 0.5,
        //     opacity: 0,
        //     scale: 0,
        //     x:  -100,
        //     ease: 'power1',
        //     stagger: {
        //         each: 0.1,
        //         from: 'start'
        //     }
        // });

        // gsap.to('.single-card', {
        //     duration: 0.5,
        //     opacity: 1,
        //     scale: 1,
        //     x:  0,
        //     ease: 'power1',
        //     stagger: {
        //         each: 0.1,
        //         from: 'start'
        //     }
        // });
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
    width: 30%;
    border-radius: 50%;
    border: 2px solid orange;
}
</style>
