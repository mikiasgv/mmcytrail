<template>
    <div class="container-fluid">
        <div class="row mb-5 py-5">
            <div class="col-md-12 d-flex justify-content-center flex-wrap">
                <button type="button" class="btn btn-dark btn-sm p-2 mx-2" @click="sortByRank">
                    Sort by rank <span class="badge badge-light"><i class="fas fa-angle-up text-xs"></i></span>
                </button>
                <button type="button" class="btn btn-dark btn-sm p-2 mx-2" @click="sortByBadge">
                    Sort by badge <span class="badge badge-light"><i class="fas fa-angle-up text-xs"></i></span>
                </button>
                <button type="button" class="btn btn-dark btn-sm p-2 mx-2" @click="sortByPoint">
                    Sort by point <span class="badge badge-light"><i class="fas fa-angle-up text-xs"></i></span>
                </button>
            </div>
        </div>

        <!-- <div class="row sort-trial"> -->
        <div class="row sort-trial" >
            <user-card v-for="trainee in trails.trainees" :key="trainee.username"
                :trainee="trainee"
                :ranks="trails.ranks"
                :records="trails.records"
                :skills="trails.skills"
                :badges="trails.badges"
                :badgerecords="trails.badgerecords"
                :skillrecords="trails.skillrecords"
            ></user-card>
        </div>
    </div>
</template>

<script>
import gsap from 'gsap';
import UserCard from './UserCard';
import NProgress from 'nprogress';

export default {
    components: {UserCard},
    data() {
        return {
            trails : {
                trainees: null,
                ranks: null,
                records: null,
                skills: null,
                badges: null,
                badgerecords: null,
                skillrecords: null
            }
        }
    },
    created() {

        this.fetchRecords();
        setInterval(() => this.fetchRecords(), 180000);

    },
    updated() {
        this.$nextTick(function () {
            // Code that will run only after the
            // entire view has been re-rendered
            NProgress.done();
            this.sortByRank();
        });
    },

    methods: {
        fetchRecords() {
            NProgress.start();

            axios.get('/trainees')
            .then(response => {
                this.trails = response.data.data;
            })
            .catch(error => console.error(error));
        },

        animateDom() {
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

        sortByRank() {
            var $wrapper = $('.sort-trial');

            $wrapper.find('.single-card').sort(function (b, a) {
                return +a.dataset.badge - +b.dataset.badge;
            }).sort(function (b, a) {
                return +a.dataset.point - +b.dataset.point;
            }).sort(function (b, a) {
                return +a.dataset.rank - +b.dataset.rank;
            }).appendTo( $wrapper );

            this.animateDom();
        },

        sortByBadge() {
            var $wrapper = $('.sort-trial');

            $wrapper.find('.single-card').sort(function (b, a) {
                return +a.dataset.point - +b.dataset.point;
            }).sort(function (b, a) {
                return +a.dataset.rank - +b.dataset.rank;
            }).sort(function (b, a) {
                return +a.dataset.badge - +b.dataset.badge;
            }).appendTo( $wrapper );

            this.animateDom();
        },

        sortByPoint() {
            var $wrapper = $('.sort-trial');

            $wrapper.find('.single-card').sort(function (b, a) {
                return +a.dataset.badge - +b.dataset.badge;
            }).sort(function (b, a) {
                return +a.dataset.rank - +b.dataset.rank;
            }).sort(function (b, a) {
                return +a.dataset.point - +b.dataset.point;
            }).appendTo( $wrapper );

            this.animateDom();
        }
    }
}
</script>

<style scoped>
.hidden {
    display: none !important;
}
.row {
    transition: all 300ms ease-in;
}
.card-avatar img {
    transition: all 300ms ease-in;
}
.card-avatar:hover .card-avatar img {
    transform: scale(1.5);
}
</style>
