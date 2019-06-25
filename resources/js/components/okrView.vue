<template>
    <div>
        <div v-if="okr.user">
            <div>
                <span class="float-right" v-text="'Target Date: ' + okr.target_date"></span>
                <h3 v-text="'OKR '+ okr.id"></h3>
                <div class="text-right">
                    <b-button @click="updateOKR" :enabled="needsUpdate" variant="success">Update OKR</b-button>
                </div>
            </div>
            <p> Created By: {{okr.user.first_name + " " + okr.user.last_name }}</p>

        </div>
        <b-container fluid>
            <b-form-row>
                <b-col md="8">
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
                        <ul>
                            <li class="bg-light text-info" v-for="note in okr.comments">
                                <b-form inline class="float-right">
                                    <label v-text="note.created_at" class="mr-2"
                                    ></label>
                                    <b-button size="sm"
                                              title="Delete Note"
                                              @click="deleteNote(note)"
                                              variant="link"
                                              class="text-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </b-button>

                                </b-form>
                                <p v-text="note.body"></p>
                            </li>
                        </ul>
                        <b-form inline class="">
                            <b-input-group class="mb-2 mr-2 form-note">
                                <b-input
                                    type="text"
                                    required
                                    placeholder="New Note"
                                    v-model="newNote"
                                ></b-input>
                            </b-input-group>
                            <b-button class="mb-2" @click="addNote" variant="outline-primary">Save</b-button>
                        </b-form>
                    </b-form>
                </b-col>
                <b-col>
                    <b-form-group label="Status:">
                        <b-form-select v-model="formData.status"
                                       :options="$store.getters.globalValues.status">

                        </b-form-select>
                    </b-form-group>
<!--                    <b-form-group label="Categories:">-->
<!--                        <b-form-select :select-size="6" multiple v-model="formData.categoriesArray"-->
<!--                                       :options="$store.getters.globalValues.categories"></b-form-select>-->
<!--                    </b-form-group>-->
<!--                    <b-form-group label="Impact Groups:">-->
<!--                        <b-form-select :select-size="6" multiple v-model="formData.impactGroupsArray"-->
<!--                                       :options="$store.getters.globalValues.impact_groups"></b-form-select>-->
<!--                    </b-form-group>-->
<!--                    <b-form-group label="Contributors">-->
<!--                        <b-form-select :select-size="6" multiple v-model="formData.contributorsArray"-->
<!--                                       :options="$store.getters.globalValues.contributors"></b-form-select>-->
<!--                    </b-form-group>-->

                    <div role="tablist">
                        <b-card no-body class="mb-1">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-button block href="#" v-b-toggle.accordion-1 variant="info" class="text-left text-light" v-text="'Categories: ' +formData.categories"></b-button>
                            </b-card-header>
                            <b-collapse id="accordion-1" visible accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <b-form-select :select-size="4" multiple v-model="formData.categoriesArray"
                                                   :options="$store.getters.globalValues.categories"></b-form-select>
                                </b-card-body>
                            </b-collapse>
                        </b-card>

                        <b-card no-body class="mb-1">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-button block href="#" v-b-toggle.accordion-2 variant="info" class="text-left text-light" v-text="'Impact Groups: '+formData.impact_groups"></b-button>
                            </b-card-header>
                            <b-collapse id="accordion-2" accordion="my-accordion" role="tabpanel">
                                <b-form-select :select-size="4" multiple v-model="formData.impactGroupsArray"
                                               :options="$store.getters.globalValues.impact_groups"></b-form-select>
                            </b-collapse>
                        </b-card>

                        <b-card no-body class="mb-1">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-button block href="#" v-b-toggle.accordion-3 variant="info" class="text-left text-light" v-text="'Contributors: ' + formData.contributors"></b-button>
                            </b-card-header>
                            <b-collapse id="accordion-3" accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <b-form-select :select-size="8" multiple v-model="formData.contributorsArray"
                                                   :options="$store.getters.globalValues.contributors"></b-form-select>
                                </b-card-body>
                            </b-collapse>
                        </b-card>
                    </div>



                </b-col>
            </b-form-row>
        </b-container>
        <div>
            <hr>

            <h2>KRs</h2>
            <div  class="row">
                <p class="col">
                    <strong>KR Status Counts:</strong>
                </p>
                <p v-for="st in $store.getters.getOkrStatuses" class="col" :class="getStyle(st.type)">{{st.type}}: {{ st.count }}</p>
            </div>

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
            this.getData(routes.api.okrs.show(this.$route.params.id), "Okr", "fetchOkr")
            this.getData(routes.api.okrs.status(this.$route.params.id), "Okr", "setOkrStatuses")


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
            deleteNote(note) {
                this.deleteData("/api/comments/" + note.id, note.id);
                this.formData.comments = this.formData.comments.filter(function(item){
                    return item != note
                })
            },
            getStyle(status){
                return 'status-' +  status.toLowerCase()
            },
            updateOKR() {
                this.putData("/api/okrs/"+this.okr.id, this.formData);
                window.alert('OKR changes stored');
                this.getData(routes.api.okrs.show(this.$route.params.id), "Okr", "fetchOkr");

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
    .form-note {
        width: 90% !important;
    }
</style>
