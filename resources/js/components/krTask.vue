<template>
    <div>
        <b-card class="task-card" :border-variant="getCardBorderStatus(task.status)">
<!--            <b-card-body>-->
            <div>
            <strong>Task: </strong> <span v-text="task.id"></span>
            <span class="float-right"
                  :class="getStyle(task.status)"
                  v-text="'Status: ' + task.status"></span>
        </div>
        <div><strong v-text="task.title"></strong></div>
        <p v-text="task.description" v-if="$store.getters.getExpandedView"></p>
        <div>Assigned to: <span class="text-success"
                  v-text="task.user.first_name+ '  ' +task.user.last_name"></span>
            <button class="btn btn-link stretched-link" title="Update Task" @click="selectTask">
                <i class="fa fa-edit"></i>
            </button>
        </div>

<!--            </b-card-body>-->
<!--            <b-card-footer footer-bg-varian="light">-->
<!--                <div class="float-right">-->

<!--                </div>-->
<!--            </b-card-footer>-->
        </b-card>
    </div>
</template>
<script>
    export default {
        name: "task",
        props: {
            task: {}
        },
        methods:{
            selectTask(){
                this.$emit('selected')
            }
        }
    };
</script>
<style>
    .task-card >.card-body{
        padding:8px;
    }
</style>
