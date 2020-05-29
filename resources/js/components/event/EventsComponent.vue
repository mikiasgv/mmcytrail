<template>
    <div>
        <ul class="list-group" v-for="event in events" :key="event.id">
            <li class="list-group-item w-100 border-dark d-flex flex-row"><span class="mr-5 font-weight-bold">Event Title</span><span>{{ event.title }}</span></li>
            <li class="list-group-item w-100 border-dark d-flex flex-row"><span class="mr-5 font-weight-bold">Category</span><span>{{ event.category.name }}</span></li>
            <li class="list-group-item w-100 border-dark d-flex flex-row"><span class="mr-5 font-weight-bold">Event Code</span><span>{{ event.code }}</span></li>
            <li class="list-group-item w-100 border-dark d-flex flex-row"><span class="mr-5 font-weight-bold">Lat</span><span>{{event.venues[0].address.latitude}}</span></li>
            <li class="list-group-item w-100 border-dark d-flex flex-row"><span class="mr-5 font-weight-bold">Long</span><span>{{event.venues[0].address.longitude}}</span></li>
        </ul>
    </div>
</template>

<script>
//import cventApi from '../../settings/cventApi.js';
import axios from 'axios';
export default {
    created() {
        axios
            .get('/events')
            .then(res => this.events = res.data)
            .catch(err => console.error(err));
    },
    data() {
        return {
            events: {}
        }
    }
};
</script>

<style lang="scss" scoped></style>
