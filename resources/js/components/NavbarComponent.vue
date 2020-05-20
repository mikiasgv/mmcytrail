<template>
    <div class="navbar-wrapper">
        <div class="navbar-minimize">
            <!-- <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round btn-md">
            <i class="fas fa-ellipsis-v text_align-center visible-on-sidebar-regular"></i>
            <i class="fas fa-border-none design_bullet-list-67 visible-on-sidebar-mini"></i>
            <div class="ripple-container"></div></button> -->
        </div>
        <a class="navbar-brand" href="javascript:;">{{title}}</a>
    </div>
</template>

<script>
export default {
    mounted() {
        // const body = document.querySelector('body');
        // let sidebarIcon = document.getElementById('minimizeSidebar');

        // sidebarIcon.addEventListener('click', function() {

        //     if(body.classList.contains('sidebar-mini')) {
        //         body.classList.remove('sidebar-mini');
        //     }else {
        //         body.classList.add('sidebar-mini');
        //     }
        // });

    },
    data() {
        return {
            url: []
        }
    },
    created() {
        this.url = window.location.pathname.split('/');
    },

    computed: {
        title() {
            if(this.url) {
                let s = (this.url[1]);
                return s.charAt(0).toUpperCase() + s.slice(1);
            }
        }
    }
}
</script>

<style>

</style>
