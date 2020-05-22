<template>
    <div class="container-fluid">
        <div class="row mb-1 py-2">
            <!-- <div class="col-md-12 form-group bmd-form-group d-flex justify-content-center mb-5">
                <div class="d-flex justify-content-center align-items-center w-50">
                    <input type="text" class="form-control w-100" id="search-records" placeholder="Search skills, blazers, location ...">
                    <i class="fas fa-search tetx-xs text-primary bg-muted rounded-circle"></i>
                </div>
            </div> -->
            <div class="col-md-12 check-filters d-flex flex-row justify-content-center mb-3 w-100">
                <div class="form-check d-flex m-0 mr-2 py-3  px-4 btn btn-primary border-bottom border-white-400 menu-btn">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" v-model="skillCheckbox">
                        <span class="form-check-sign">
                            <span class="check custom-check"></span>
                        </span>
                    </label>
                    <span class="text-dark">Skill</span>
                </div>
                <div class="form-check d-flex m-0 mr-2 py-3  px-4 btn btn-primary border-bottom border-white-400 menu-btn">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" v-model="rankCheckbox">
                        <span class="form-check-sign">
                            <span class="check custom-check"></span>
                        </span>
                    </label>
                    <span class="text-dark">Rank</span>
                </div>
                <div class="form-check d-flex m-0 mr-2 py-3  px-4 btn btn-primary border-bottom border-white-400 menu-btn">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" v-model="pathCheckbox">
                        <span class="form-check-sign">
                            <span class="check custom-check"></span>
                        </span>
                    </label>
                    <span class="text-dark">Path</span>
                </div>
                <!-- <div class="form-check d-flex m-0 mr-2 py-3  px-4 btn btn-primary border-bottom border-white-400 menu-btn">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="location">
                        <span class="form-check-sign">
                            <span class="check custom-check"></span>
                        </span>
                    </label>
                    <span class="text-dark">Location</span>
                </div> -->

            </div>

            <div class="col-md-12 bg-white p-2 filter-menu"
                        :style="anyFilterSelected ? 'visibility: visible' : 'visibility:hidden'">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end w-100" @click="closeMenu()">
                        <i class="fas fa-times-circle close-btn text-dark text-xl"></i>
                    </div>
                    <div class="col-md-12 col-lg-3" v-if="skillCheckbox">
                        <div class="d-flex flex-column">
                            <h3 class="align-self-center text-md">Skills</h3>
                            <div class="card-body d-flex flex-row flex-wrap border-right border-success-100">
                                <div class="form-check d-flex px-2 w-50 py-1" v-for="skill in trails.skills" :key="skill.skill">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox"
                                                :name="skill.skill" :value="skill.skill" v-model="checkedSkills">
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                    <span class="text-dark text-xs">{{skill.skill}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3" v-if="rankCheckbox">
                        <div class="d-flex flex-column">
                            <h3 class="align-self-center text-md">Ranks</h3>
                            <div class="card-body d-flex flex-row flex-wrap border-right border-success-100">
                                <div class="form-check d-flex px-2 w-50 py-1" v-for="rank in trails.ranks" :key="rank.rank">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox"
                                                :name="rank.rank" :value="rank.rank_Id" v-model="checkedRanks">
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                    <span class="text-dark text-xs">{{rank.rank}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3" v-if="pathCheckbox">
                        <div class="d-flex flex-column">
                            <h3 class="align-self-center text-md">Paths</h3>
                            <div class="card-body d-flex flex-row flex-wrap border-right border-success-100">
                                <div class="form-check d-flex px-2 w-50 py-1" v-for="path in trails.paths" :key="path.path">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox"
                                                :name="path.Path" :value="path.Path_Id" v-model="checkedPaths">
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                    <span class="text-dark text-xs">{{path.Path}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <!-- <div class="col-md-12 d-flex justify-content-center flex-wrap">
                <button class="btn btn-primary btn-round btn-sm mr-1" @click="sortByRank">
                    <i class="fas fa-star tetx-xs text-primary bg-white rounded-circle p-1"></i> Sort by rank
                    <div class="ripple-container"></div>
                </button>
                <button class="btn btn-primary btn-round btn-sm mr-1" @click="sortByBadge">
                    <i class="fas fa-certificate tetx-xs text-primary bg-white rounded-circle p-1"></i> Sort by badge
                    <div class="ripple-container"></div>
                </button>
                <button class="btn btn-primary btn-round btn-sm" @click="sortByPoint">
                    <i class="fas fa-credit-card tetx-xs text-primary bg-white rounded-circle p-1"></i> Sort by point
                    <div class="ripple-container"></div>
                </button>

            </div> -->
        </div>

        <div class="row mt-2 mb-4 mb-5">
            <div class="col-md-12 d-flex flex-row justify-content-end py-3 w-100">
                <i class="view-changer fas fa-th text-xl px-2"
                    :class="showGridView ? 'text-primary' : 'text-dark'"
                    @click="changeView('grid')"
                ></i>
                <i class="view-changer fas fa-list-alt text-xl"
                    :class="showGridView ? 'text-dark' : 'text-primary'"
                    @click="changeView('table')"
                ></i>
            </div>
        </div>

        <!-- Grid view starts here-->
        <div class="row sort-trial" v-show="showGridView">
            <single-user-card  v-for="trainee in traineesRecords" :key="trainee.username"
                :trainee="trainee"
                :paths="trails.paths"
                :ranks="trails.ranks"
                :records="trails.records"
                :skills="trails.skills"
                :badges="trails.badges"
                :badgerecords="trails.badgerecords"
                :skillrecords="trails.skillrecords"
                :showGridView="showGridView"
            ></single-user-card>
        </div>
        <!--grid view ends here-->

        <!--table view starts here-->
        <div class="row card card-trails" v-show="!showGridView">
            <div class="card-header card-header-warning card-header-icon">
                <h4 class="card-title">Trailblazers</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Position</th>
                                <th>Name</th>
                                <th>Path</th>
                                <th>Rank</th>
                                <th>Points</th>
                                <th>Badges</th>
                                <th>Skills</th>
                                <th>Learn more</th>
                            </tr>
                        </thead>
                        <tbody class="trainees-table-view">
                        <single-user-table-view  v-for="trainee in traineesRecords" :key="trainee.trainee_Id"
                            :trainee="trainee"
                            :paths="trails.paths"
                            :ranks="trails.ranks"
                            :records="trails.records"
                            :skills="trails.skills"
                            :badges="trails.badges"
                            :badgerecords="trails.badgerecords"
                            :skillrecords="trails.skillrecords"
                        ></single-user-table-view>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import gsap from 'gsap';
import SingleUserCard from './SingleUserCardComponent';
import SingleUserTableView from './SingleUserTableViewComponent';
import NProgress from 'nprogress';

export default {
    components: {SingleUserCard, SingleUserTableView},
    computed: {
        anyFilterSelected() {
            if(this.pathCheckbox || this.rankCheckbox || this.skillCheckbox) {
                return true;
            }

            return false;
        }
    },
    data() {
        return {
            //what returned from the DB
            trails : {
                trainees: null,
                ranks: null,
                //records and latest_records
                //return the same data I will remove one later
                records: null,
                latest_records: null,
                skills: null,
                paths: null,
                badges: null,
                badgerecords: null,
                skillrecords: null
            },

            //this will hold the records after the filters
            //it is exact replica of the traninees in the trails
            //it is duplicated for manipulation
            traineesRecords: [],
            //this is also replica of latest_record
            //however after running the trails watch
            //I removed the duplication
            //I will optimimize later
            latestRecordsBuild: [],

            selectedSkillsFilter: [],
            skillCheckbox: false,
            checkedSkills: [],

            selectedRanksFilter: [],
            rankCheckbox: false,
            checkedRanks: [],

            selectedRPathsFilter: [],
            pathCheckbox: false,
            checkedPaths: [],

            //showTableView: null,
            showGridView: true
        }
    },
    watch: {
        anyFilterSelected(newVal, oldVal) {
            if(newVal) {
                this.animateMenu();
            }
        },

        trails(newVal, oldVal) {
            let latestRecords = [];

            //Get the latest records only
            newVal.trainees.forEach(trainee => {
                let flag = 1;
                newVal.latest_records.forEach(record => {
                    if(record.trainee_Id == trainee.trainee_Id && flag == 1) {
                        latestRecords.push(record);
                        flag = 0;
                    }
                });
            });

            this.latestRecordsBuild = [];
            this.latestRecordsBuild = latestRecords;
        },

        checkedSkills(newVal, oldVal) {

            if(newVal.length) {
                if(this.checkedRanks.length || this.checkedPaths.length) {
                    this.filterRecordsBySkill(newVal, this.traineesRecords);
                }else {
                    this.filterRecordsBySkill(newVal, this.trails.trainees);
                }

            } else {
                if(this.checkedRanks.length && this.checkedPaths.length) {
                    this.filterRecordsByRank(this.checkedRanks, this.trails.trainees);
                    this.filterRecordsByPath(this.checkedPaths, this.traineesRecords);
                }else if(this.checkedRanks.length) {
                    this.filterRecordsByRank(this.checkedRanks, this.trails.trainees);
                }else if(this.checkedPaths.length) {
                    this.filterRecordsByPath(this.checkedPaths, this.trails.trainees);
                } else {
                    this.traineesRecords = this.trails.trainees;
                }
            }

        },

        checkedRanks(newVal, oldVal) {
            if(newVal.length) {
                if(this.checkedSkills.length || this.checkedPaths.length) {
                    this.filterRecordsByRank(newVal, this.traineesRecords);
                }else {
                    this.filterRecordsByRank(newVal, this.trails.trainees);
                }

            } else {
                if(this.checkedSkills.length && this.checkedPaths.length) {
                    this.filterRecordsBySkill(this.checkedSkills, this.trails.trainees);
                    this.filterRecordsByPath(this.checkedPaths, this.traineesRecords);
                } else if(this.checkedSkills.length){
                    this.filterRecordsBySkill(this.checkedSkills, this.trails.trainees);
                } else if(this.checkedPaths.length) {
                    this.filterRecordsByPath(this.checkedPaths, this.trails.trainees);
                } else {
                    this.traineesRecords = this.trails.trainees;
                }
            }
        },

        checkedPaths(newVal, oldVal) {
            if(newVal.length) {
                if(this.checkedSkills.length || this.checkedRanks.length) {
                    this.filterRecordsByPath(newVal, this.traineesRecords);
                }else {
                    this.filterRecordsByPath(newVal, this.trails.trainees);
                }

            } else {
                if(this.checkedSkills.length && this.checkedRanks.length) {
                    this.filterRecordsBySkill(this.checkedSkills, this.trails.trainees);
                    this.filterRecordsByRank(this.checkedRanks, this.traineesRecords);
                } else if(this.checkedSkills.length) {
                    this.filterRecordsBySkill(this.checkedSkills, this.trails.trainees);
                } else if(this.checkedRanks.length) {
                    this.filterRecordsByRank(this.checkedRanks, this.trails.trainees);
                } else {
                    this.traineesRecords = this.trails.trainees;
                }
            }
        }
    },
    created() {

        //False means the page loads the first time
        this.fetchRecords(false);

        setInterval(() => {
            //True means the page loads after 3min by itself
            this.fetchRecords(true);
        }, 180000);

    },
    updated() {
        this.$nextTick(function () {
            // Code that will run only after the
            // entire view has been re-rendered
            // NProgress.done();
            if(this.showGridView) {
                this.sortByRank();
            }else {
                this.sortTableByRank();
            }

        });
    },

    methods: {
        fetchRecords(status) {
            // NProgress.start();

            axios.get('/trainees')
            .then(response => {

                this.trails = response.data.data;
                this.traineesRecords = response.data.data.trainees;

                if(status) {
                    //Check if there are filters
                    //when the page reloads without refreshing
                    if(this.checkedSkills.length || this.checkedRanks.length || this.checkedPaths.length) {
                        if(this.checkedSkills.length && this.checkedRanks.length && this.checkedPaths.length) {
                            this.filterRecordsBySkill(this.checkedSkills, this.trails.trainees);

                            //call the secon filter with this.traineesRecords
                            this.filterRecordsByRank(this.checkedRanks, this.traineesRecords);

                            //call the third filter with this.traineesRecords
                            this.filterRecordsByPath(this.checkedPaths, this.traineesRecords);
                        }else if(this.checkedSkills.length && this.checkedRanks.length) {
                            this.filterRecordsBySkill(this.checkedSkills, this.trails.trainees);
                            //call the secon filter with this.traineesRecords
                            this.filterRecordsByRank(this.checkedRanks, this.traineesRecords);
                        }else if(this.checkedSkills.length && this.checkedPaths.length) {
                            this.filterRecordsBySkill(this.checkedSkills, this.trails.trainees);
                            //call the third filter with this.traineesRecords
                            this.filterRecordsByPath(this.checkedPaths, this.traineesRecords);
                        }else if(this.checkedRanks.length && this.checkedPaths.length) {
                            this.filterRecordsByRank(this.checkedRanks, this.trails.trainees);
                            //call the third filter with this.traineesRecords
                            this.filterRecordsByPath(this.checkedPaths, this.traineesRecords);
                        }else if(this.checkedRanks.length) {
                            this.filterRecordsByRank(this.checkedRanks, this.trails.trainees);
                        }else if(this.checkedPaths.length) {
                            this.filterRecordsByPath(this.checkedPaths, this.trails.trainees);
                        }else if(this.checkedSkills.length) {
                            this.filterRecordsBySkill(this.checkedSkills, this.trails.trainees);
                        }

                    }
                }
            })
            .catch(error => console.error(error));
        },

        animateDom() {
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

        },

        animateMenu() {
            gsap.from('.filter-menu', {
                duration: 1,
                opacity: 0,
                scale: 0,
                y:  -50,
                ease: 'back',
            });

            gsap.to('.filter-menu', {
                duration: 1,
                opacity: 1,
                scale: 1,
                y:  0,
                ease: 'back',
            });
        },

        closeAnimateMenu() {
            gsap.from('.filter-menu', {
                duration: 1,
                opacity: 0,
                scale: 0,
                y:  0,
                ease: 'back',
            });

            gsap.to('.filter-menu', {
                duration: 1,
                opacity: 1,
                scale: 1,
                y:  -100,
                ease: 'back',
            });
        },

        sortByRank() {
            if(this.showGridView) {
                var $wrapper = $('.sort-trial');

                $wrapper.find('.single-card').sort(function (b, a) {
                    return +a.dataset.badge - +b.dataset.badge;
                }).sort(function (b, a) {
                    return +a.dataset.point - +b.dataset.point;
                }).sort(function (b, a) {
                    return +a.dataset.rank - +b.dataset.rank;
                }).appendTo( $wrapper );

                this.animateDom();
            }

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
        },

        filterRecordsByPath(newVal, recordToFilterFrom) {
            let filteredTrainees = [];

            recordToFilterFrom.forEach(trainee => {
                newVal.forEach(path => {
                    if(path == trainee.path_Id) {
                        filteredTrainees.push(trainee);
                    }
                });
            });

            this.traineesRecords = recordToFilterFrom.filter(original => {
                return filteredTrainees.indexOf(original) !== -1;
            });
        },

        filterRecordsByRank(newVal, recordToFilterFrom) {
            let filteredTrainees = [];

            recordToFilterFrom.forEach(trainee => {
                this.latestRecordsBuild.forEach(latestrecord => {
                    if(latestrecord.trainee_Id == trainee.trainee_Id) {
                        newVal.forEach(rank => {
                            if(rank == latestrecord.rank_Id) {
                                filteredTrainees.push(trainee);
                            }
                        });
                    }
                });
            });

            this.traineesRecords = recordToFilterFrom.filter(original => {
                return filteredTrainees.indexOf(original) !== -1;
            });
        },

        filterRecordsBySkill(newVal, recordToFilterFrom) {
            let filteredTrainees = [];

            recordToFilterFrom.forEach(trainee => {
                this.latestRecordsBuild.forEach(latestrecord => {
                    if(latestrecord.trainee_Id == trainee.trainee_Id) {
                        this.trails.skillrecords.forEach(skillrecord => {
                            if(skillrecord.trainee_Id == latestrecord.trainee_Id) {
                                newVal.forEach(skill => {
                                    if(skill == skillrecord.skill) {
                                        filteredTrainees.push(trainee);
                                    }
                                });
                            }
                        });
                    }
                });
            });

            this.traineesRecords = recordToFilterFrom.filter(original => {
                return filteredTrainees.indexOf(original) !== -1;
            });
            //this.traineesRecords = filteredTrainees;
        },

        closeMenu() {
            this.closeAnimateMenu();

            this.selectedSkillsFilter = [];
            this.skillCheckbox = false;
            this.checkedSkills = [];

            this.selectedRanksFilter = [];
            this.rankCheckbox = false;
            this.checkedRanks = [];

            this.selectedRPathsFilter = [];
            this.pathCheckbox = false;
            this.checkedPaths = [];

            this.traineesRecords = this.trails.trainees;

        },

        changeView(type) {
            if(type == "grid") {
                this.showGridView = true;
            }else if(type == "table") {
                this.showGridView = false;
                //this.sortTableByRank();
                //this.animateTable();
            }
        },
        sortTableByRank() {
            var $wrapperTable = $('.trainees-table-view');

            $wrapperTable.find('.single-table-view').sort(function (b, a) {
                return +a.dataset.badge - +b.dataset.badge;
            }).sort(function (b, a) {
                return +a.dataset.point - +b.dataset.point;
            }).sort(function (b, a) {
                return +a.dataset.rank - +b.dataset.rank;
            }).appendTo( $wrapperTable );

            this.animateTable();
        },
        animateTable() {
            gsap.from('.single-table-view', {
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

            gsap.to('.single-table-view', {
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
        },
    }
}
</script>

<style scoped>
.hidden {
    display: none !important;
}
.filt {
    background: #f2f2f2;
    padding: 7px 12px;
    margin-right: 4px;
    border-radius: 6px;
    border: 1px solid #dfdfdf;
}
.form-check.d-flex.filt > * {
    color: #444 !important;
    border-color: #fff !important;
    font-size: 12px;
}
.filter-menu {
    border-top: 1px solid #ddd;
    background: #f1f1f1 !important;
    box-shadow: 0 10px 20px -10px #b3b3b3;
}
.menu-btn > * {
    color: #fff !important;
}
.menu-btn .custom-check {
    border: 2px solid #fff !important;
}
.close-btn {
    cursor: pointer;
    transition: transform 0.5s ease-out;
}
.close-btn:hover {
    transform: rotate(45deg);
}
.view-changer {
    cursor: pointer;
}
.card-trails {
    overflow-x: scroll;
}
</style>
