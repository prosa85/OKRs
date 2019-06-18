<template>
    <div>
        <div v-if="okr.user">
            <div>
                <h3 v-text="'OKR '+ okr.id"></h3>
                <div class="text-right">
                    <b-button @click="updateOKR" :enabled="needsUpdate" variant="success">Update OKR</b-button>
                </div>
            </div>
            <span class="float-right" v-text="'Target Date: ' + okr.target_date"></span>
            <p> Created By: {{okr.user.first_name + " " + okr.user.last_name }}</p>

        </div>
        <b-container fluid>
            <b-form-row>
                <b-col cols="8">
                    <b-form @submit="" @reset="" v-if="okr">
                        <b-form-group
                            id="input-group-1"
                            label="OKR Title:"
                            description=""
                        >
                            <b-form-textarea
                                v-model="formData.OKRs_title"
                                type="text"
                                required
                                rows="4"
                                placeholder="Title"
                            ></b-form-textarea>

                        </b-form-group>
                        <b-form-group
                            label="Description:"
                        >
                            <b-form-textarea
                                v-model="formData.description"
                                type="text"
                                rows="5"
                                required
                                placeholder="description"
                            ></b-form-textarea>
                        </b-form-group>
                        <h3>Notes</h3>
                        <b-form inline class="offset-md-8 col-md-4">
                            <b-input-group class="mb-2 mr-2">
                                <b-input
                                    type="text"
                                    required
                                    placeholder="New Note"
                                    v-model="newNote"
                                ></b-input>
                            </b-input-group>
                            <b-button class="mb-2" @click="addNote" variant="outline-primary">Save</b-button>
                        </b-form>

                        <ul>
                            <li class="bg-light text-info" v-for="note in okr.comments">
                                <b-form inline class="float-right">
                                    <label v-text="note.created_at" class="mr-2"
                                    ></label>
                                    <b-button size="sm" title="Delete Note" @click="deleteNote(note.id)"
                                              variant="outline-danger">x
                                    </b-button>

                                </b-form>
                                <p v-text="note.body"></p>
                            </li>
                        </ul>
                    </b-form>
                </b-col>
                <b-col>
                    <b-form-group label="Status:">
                        <b-form-select v-model="formData.status"
                                       :options="$store.getters.globalValues.status"></b-form-select>
                    </b-form-group>
                    <b-form-group label="Categories:">
                        <b-form-select multiple v-model="formData.categoriesArray"
                                       :options="$store.getters.globalValues.categories"></b-form-select>
                    </b-form-group>
                    <b-form-group label="Impact Groups:">
                        <b-form-select multiple v-model="formData.impactGroupsArray"
                                       :options="$store.getters.globalValues.impact_groups"></b-form-select>
                    </b-form-group>
                    <b-form-group label="Contributors">
                        <b-form-select multiple v-model="formData.contributorsArray"
                                       :options="$store.getters.globalValues.contributors"></b-form-select>
                    </b-form-group>
                </b-col>
            </b-form-row>
        </b-container>
        <div>
            <hr>
            <h2>KRs</h2>
            <b-card-group columns>
                <b-card
                    v-for="kr in okr.krs"
                    :title="'KR '+kr.id+' '+kr.title"
                    :key="kr.id"
                    class="pre-line"
                    :sub-title="addBr(kr.description)"
                >
                    <b-card-text>
                        <div class="float-right" :class="getStyle(kr.status)"><strong>KR status: <span v-text="kr.status" ></span></strong></div>
                        <div><strong>Completion Date: <span v-text="kr.completion_date"></span></strong></div>
                        <div><strong>Target Date: <span v-text="kr.target_date"></span></strong></div>
                        <div><strong>VX Impact: <span v-text="kr.vx_impact"></span></strong></div>
                        <div v-if="kr.tasks.length">
                            <hr>
                            <h4>Tasks</h4>
                            <ul v-for="task in kr.tasks" class="list-group">
                                <li class="list-group-item mt-1">
                                    <div>
                                        <strong>Task: </strong> <span v-text="task.id"></span>
                                        <span class="float-right" :class="getStyle(task.status)" v-text="'Status: ' + task.status"></span>

                                    </div>
                                    <div><span v-text="task.title"></span></div>
                                    <p v-text="task.description"></p>
                                    <div>Assigned to: <span class="text-success" v-text="task.user.first_name+ '  ' +task.user.last_name"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </b-card-text>
                </b-card>
            </b-card-group>
        </div>
    </div>
</template>

<script>
    export default {
        name: "okrView",
        data() {
            return {
                newNote: "",
                formData: {
                    categoriesArray: [],
                    impactGroupsArray: [],
                    contributorsArray: [],
                    OKRs_title: "",
                    description: "",
                    created_by: 0,
                    status: "",
                    categories: "",
                    impact_groups: "",
                    contributors: "",
                    target_date: "",
                    completion_date: ""
                }
            };
        },
        mounted() {
            this.getData(routes.api.okrs.show(this.$route.params.id), "Okr", "fetchOkr");
        },
        computed: {
            okr() {
                return this.$store.getters.getOkr;
            },
            needsUpdate() {
                return this.okr != this.formData
            },
        },
        watch: {
            okr: function() {
                this.formData = this.okr;
            }
        },
        methods: {
            addNote() {
                let newNote = {
                    id: this.okr.id,
                    text: this.newNote,
                    model: "App\\Okr"
                };
                this.postData("/api/comments", newNote);
            },
            deleteNote(id) {
                this.deleteData("/api/comments/" + id, id);
            },
            getStyle(status){
                return 'status-' +  status.toLowerCase()
            },
            updateOKR() {
                this.putData("/api/okrs/"+this.okr.id, this.formData);
                window.alert('OKR changes stored');

            }
        }


    };
</script>

<style>
    .status-completed {
        color: #53a317;
    }
    .status-active{
        color: #31b2f0;
    }
    .status-hold {
        color: #ee0a0a;
    }
    .status-proposed{
        color: #8e8f90;
    }
</style>
