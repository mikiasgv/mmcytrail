<template>
    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i :class="classes"></i>
                </div>
                <h3 class="card-title" :class="custom">Today</h3>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column justify-content-center align-items-center w-100">
                    <div>
                        <h2 v-if="stats" class="mb-0 text-3x font-weight-bold text-primary">{{ returnCommaSeparatedNumber(stats) }}</h2>
                        <h2 v-else class="mb-0 text-3x font-weight-bold text-primary">0</h2>
                    </div>
                    <h3 class="mt-n4 text-lg text-muted text-uppercase font-weight-bolder">{{ title }}</h3>
                </div>
            </div>
            <div class="card-footer m-0 py-2 px-3">
                <div class="stats d-flex align-items-center">
                    <h3 class="text-uppercase text-md text-dark my-2 mx-0" :class="custom">
                        Total: <span v-if="total" class="text-black text-lg font-weight-bolder ml-1">{{returnCommaSeparatedNumber(total)}}</span>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Utilities from '../helpers/utilities.js';

export default {
    props: ['stats', 'title', 'icons', 'total', 'custom'],

    computed: {
        classes() {
            return `fas fa-${this.icons} text-white text-md`;
        }
    },
    methods: {
        returnCommaSeparatedNumber(x) {
            return Utilities.numberWithCommas(x);
        }
    }
}
</script>

<style scoped>
.card-footer {
    border-top: 1px dotted #dfdfdf !important;
}

.card-title.c-user {
    display: none !important;
}
h3.c-user {
    color: transparent !important;
}
</style>
