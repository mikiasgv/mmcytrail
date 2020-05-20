<template>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li :class="classes('dashboard')">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-layer-group text-sm"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li :class="classes('trailblazer')">
                <a class="nav-link" href="/trailblazer">
                    <i class="fas fa-user text-sm"></i>
                    <p>Trailblazers</p>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            url: []
        }
    },
    created() {
        this.url = window.location.pathname.split('/');
    },
    methods: {
        classes(val) {
            if(this.url.length) {
                return val == this.url[1] ? 'nav-item active' : 'nav-item';

            }

            return 'nav-item';
        }
    }
}
</script>

<style>

</style>
