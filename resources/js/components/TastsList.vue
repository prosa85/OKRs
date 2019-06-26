<template>
    <div>
        <div class="d-flex justify-content-between">
            <h4>Tasks</h4>
            <b-button @click="activateTaskCreateMode" variant="link" pill size="md"> <i class="fas fa-plus-circle"></i></b-button>
        </div>
        <div class="text-right">Pending: {{kr.pendingTasks}}</div>
        <ul v-for="task in kr.tasks" class="list-group">
            <li class="list-group-item mt-1">
                <kr-task :task="task" v-on:selected="selectTask(task)"></kr-task>
            </li>
        </ul>
        <div id="task-modal">
            <b-modal v-model="showModal">
                <div slot="modal-title">
                    <div v-if="createTaskMode">Create New Task for KR {{ kr.id }}</div>
                    <div v-else>Task Id {{ selectedTask.id }}</div>
                </div>

                <div>
                    <b-form>
                        <b-form-group label="Status:">
                            <b-form-select v-model="selectedTask.status"
                                           :options="$store.getters.globalValues.status">
                            </b-form-select>
                        </b-form-group>
                        <b-form-group label="Title:">
                            <b-form-input v-model="selectedTask.title">
                            </b-form-input>
                        </b-form-group>
                        <b-form-group
                            label="Description:"
                        >
                            <b-form-textarea
                                v-model="selectedTask.description"
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
                <template slot="modal-footer">
                    <b-button
                        variant="primary"
                        size="sm"
                        class="float-right"
                        @click="createTask"
                        v-if="createTaskMode"
                    >
                        Create
                    </b-button>
                    <b-button
                        variant="success"
                        size="sm"
                        class="float-right"
                        @click="updateTask"
                        v-if="updateTaskMode"
                    >
                        Update Task
                    </b-button>
                </template>
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
            updateTaskMode:false,

        }
      },
      methods:{
        selectTask(task){
            this.selectedTask= task;
            this.updateTaskMode = true;
            this.showModal = true;
        },
        activateTaskCreateMode(){
            this.createTaskMode = true
            this.showModal = true
            this.selectedTask = this.copyComputed(this.emptyBo)
        },
        createTask(){
            this.createTaskMode = false
            this.showModal = false
            this.postData('/api/kr-tasks', this.selectedTask).then(()=>{
                    this.$store.dispatch('fetchCurrentOkr')
                })
        },
        updateTask(){
            this.updateTaskMode = false
            this.showModal = false
            this.putData('/api/kr-tasks/'+this.selectedTask.id, this.selectedTask).then(() => {
                this.$store.dispatch('fetchCurrentOkr')
            });

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
        },
          emptyBo(){
            return {
                "title":"",
                "description":"",
                "status": "Proposed",
                "kr_id": this.kr.id,
                "user_id": currentUser.id
            }
          }
      }
  };
</script>
