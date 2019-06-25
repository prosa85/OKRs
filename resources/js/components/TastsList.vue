<template>
    <div>
        <div class="d-flex justify-content-between">
            <h4>Tasks</h4>
            <b-button @click="activateTaskCreateMode" variant="link" pill size="md"> <i class="fas fa-plus-circle"></i></b-button>
        </div>
        <div class="text-right">Pending: {{kr.pendingTasks}}</div>
        <ul v-for="task in kr.tasks" class="list-group">
            <li class="list-group-item mt-1">
                <kr-task :task="task"></kr-task>
            </li>
        </ul>
        <div id="task-modal">
            <b-modal v-model="showModal">
                <div slot="modal-title">
                    <div v-if="createTaskMode">Create New Task</div>
                    <div v-else>Task Id {{ selectedTask.id }}</div>
                </div>

                <div>
                    <b-form>
                        <b-form-group label="Status:">
                            <b-form-select v-model="selectTask.status"
                                           :options="$store.getters.globalValues.status">
                            </b-form-select>
                        </b-form-group>
                        <b-form-group label="Title:">
                            <b-form-input v-model="selectTask.title">
                            </b-form-input>
                        </b-form-group>
                        <b-form-group
                            label="Description:"
                        >
                            <b-form-textarea
                                v-model="selectTask.description"
                                type="text"
                                required
                                rows="2"
                                placeholder="Description"
                            ></b-form-textarea>
                        </b-form-group>
                        <b-form-group
                            label="Assigned to:"
                        >
                            <b-form-select v-model="selectedTask.user_id"
                                           :options="users">
                            </b-form-select>
                        </b-form-group>

                    </b-form>
                </div>
            </b-modal>
        </div>
    </div>
</template>
<script>
  import KrTask from "./krTask.vue";

  export default {
    name: "tasts-list",
    components: { KrTask },
    props: {
      kr: {}
    },
      data(){
        return{
            selectedTask:{},
            showModal:false,
            createTaskMode:false,
        }
      },
      methods:{
        selectTask(task){
            this.selectedTask= task;
            this.showModal = true;
        },
        activateTaskCreateMode(){
            this.createTaskMode = true
            this.showModal = true
        },
      },
      computed:{
        users(){
            if(this.$store.getters.getUsers.length > 0){

                return this.$store.getters.getUsers.map(function(item){
                    let user = {
                            text: item.first_name+ ' ' + item.last_name,
                            value:item.id
                        }
                    return user
                })
                }
        }
      }
  };
</script>
