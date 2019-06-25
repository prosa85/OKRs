<template>
    <div>
    <b-card >
        <b-card-title>
            <b-button variant="success"
                      class="float-right"
                      v-if="kr.pendingTasks==0 && kr.status!='Completed'"
                      @click="completeKr"
            >Complete
            </b-button>
            {{'KR '+kr.id+' '+kr.title}}
        </b-card-title>
        <b-card-sub-title>{{addBr(kr.description)}}</b-card-sub-title>
        <b-card-text>
            <div class="float-right" :class="getStyle(kr.status)"><strong>KR status: <span v-text="kr.status"></span></strong>
            </div>
            <div><strong>Completion Date: <span v-text="kr.completion_date"></span></strong></div>
            <div><strong>Target Date: <span v-text="kr.target_date"></span></strong></div>
            <div><strong>VX Impact: <span v-text="kr.vx_impact"></span></strong></div>
            <div v-if="kr.tasks.length">
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
