<template>
    <div>
        <div v-if="okr.user">
            <div>
                <span class="float-right" v-text="'Target Date: ' + okr.target_date"></span>
                <h3 v-text="'OKR '+ okr.id"></h3>
                <div class="text-right">
                    <b-button @click="updateOKR" variant="success">Update OKR</b-button>
                    <b-button @click="expandView" v-text="$store.getters.getExpandedView? 'Expanded Yes':'Expanded No' "></b-button>
                    <b-button @click="expandTasks()" v-text="$store.getters.getExpandedTasks? 'Show Tasks: Yes':'Show Tasks: No' "></b-button>
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
                                rows="2"
                                placeholder="Title"
                            ></b-form-textarea>

                        </b-form-group>
                        <b-form-group
                            v-if="$store.getters.getExpandedView"
                            label="Description:"
                        >
                            <b-form-textarea
                                v-model="formData.description"
                                type="text"
                                rows="3"
                                required
                                placeholder="description"
                            ></b-form-textarea>
                        </b-form-group>
                        <notes :comments="okr.comments" bo="Okr" :bo_id="okr.id"></notes>
                    </b-form>
                </b-col>
                <b-col>
                    <b-form-group label="Status:">
                        <b-form-select v-model="formData.status"
                                       :options="$store.getters.globalValues.status">

                        </b-form-select>
                    </b-form-group>
                    <div role="tablist">
                        <b-card no-body class="mb-1">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-button block href="#" v-b-toggle.accordion-1 variant="light" class="text-left" v-text="'Categories: ' +formData.categories"></b-button>
                            </b-card-header>
                            <b-collapse id="accordion-1" accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                    <b-form-select :select-size="4" multiple v-model="formData.categoriesArray"
                                                   :options="$store.getters.globalValues.categories"></b-form-select>
                                </b-card-body>
                            </b-collapse>
                        </b-card>

                        <b-card no-body class="mb-1">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-button block href="#" v-b-toggle.accordion-2 variant="light" class="text-left" v-text="'Impact Groups: '+formData.impact_groups"></b-button>
                            </b-card-header>
                            <b-collapse id="accordion-2" accordion="my-accordion" role="tabpanel">
                                <b-form-select :select-size="4" multiple v-model="formData.impactGroupsArray"
                                               :options="$store.getters.globalValues.impact_groups"></b-form-select>
                            </b-collapse>
                        </b-card>

                        <b-card no-body class="mb-1">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-button block href="#" v-b-toggle.accordion-3 variant="light" class="text-left" v-text="'Contributors: ' + formData.contributors"></b-button>
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
                <div
                    v-for="kr in okr.krs"
                    :key="kr.id"
                    class="pre-line"
                >
                    <kr-card :get-style="getStyle(kr.status)" :kr="kr"/>
                </div>
            </b-card-group>
        </div>
    </div>
</template>

<script>
    import KrCard from "./KrCard";
    import notes from "./notesList"
    export default {
        name: "okrView",
        components: { KrCard, notes},
        data() {
            return {
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
            this.getData(routes.users.index, "Users", "fetchUsers");
        },
        computed: {
            okr() {
                return this.$store.getters.getOkr;
            },
        },
        watch: {
            okr: function() {
                this.formData = this.okr;
            }
        },
        methods: {
            updateOKR() {
                this.putData("/api/okrs/"+this.okr.id, this.formData);
                window.alert('OKR changes stored');
                this.getData(routes.api.okrs.show(this.$route.params.id), "Okr", "fetchOkr");

            },
            expandView(){
                this.$store.commit('EXPANDED_VIEW')
            },
            expandTasks(){
                this.$store.commit('EXPANDED_TASKS')
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
