<template>
    <div>
    <b-card >
        <b-card-title title-tag="h5">
            <div class="text-right" :class="getStyle(kr.status)">
                <strong>KR status: <span v-text="kr.status"></span></strong>
                <b-button variant="success"
                          class=""
                          v-if="kr.pendingTasks==0 && kr.status!='Completed'"
                          @click="completeKr"
                >Complete
                </b-button>
            </div>
                <span v-text="'KR '+kr.id+' '+kr.title"></span>


        </b-card-title>
        <b-card-text>
            <div v-if="kr.completion_date"><strong>Completion Date: <span v-text="kr.completion_date"></span></strong></div>
            <div v-if="kr.target_date"><strong>Target Date: </strong><span v-text="kr.target_date"></span></div>
            <div v-if="$store.getters.getExpandedView"><strong>VX Impact: <span v-text="kr.vx_impact"></span></strong></div>
            <div v-text="addBr(kr.description)" v-if="$store.getters.getExpandedView"></div>
            <div v-if="kr.tasks.length && $store.getters.getExpandedTasks">
                <hr>
                <tasts-list :kr="kr"/>
            </div>
        </b-card-text>
    </b-card>
    </div>
</template>
<script>
    import TastsList from "./TastsList";

    export default {
    name: "kr-card",
    components: { TastsList},
    props: {
        kr: {}
    },
    methods:{
        completeKr() {
            let form = this.kr
            form.status = 'Completed'
            this.putData("/api/krs/"+ this.kr.id, form);
            window.alert('Setting KR id ' + kr.id + ' Status to Completed');
            this.getData(routes.api.okrs.show(this.kr.OKR_id), "Okr", "fetchOkr");
        },

    }
  }
</script>
