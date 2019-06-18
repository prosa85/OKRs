<template>
    <div>
        <!--<input v-model="message">-->
        <div v-if="okrs.length > 0" class="row justify-content-left">
            <div class="col-md-12 okr-block" v-for="okr in okrs">
                <div class="card border-okr-card border" :class="getOkrStatus(okr)">

                        <div
                        class="card-header">
                        <router-link :to="{ name: 'okrs.show', params: { id: okr.id }}" ><span v-text="okr.OKRs_title"></span></router-link>
                      </div>

                    <div class="card-body">
                        <div v-if="!okr.completion_date" class="float-right text-primary" v-text="'Target: ' + okr.target_date" :title="countDays(okr.target_date)"></div>
                        <div v-else class="float-right text-success" v-text="'Completion Date: ' + okr.completion_date"></div>
                        <div><strong>Description:</strong> <br> <span v-html="okr.description"></span> </div>
                        <div class="row" style="margin-top:20px; white-space: pre-line;">
                            <div class="col-md-4">
                                <div><strong>Categories:</strong></div>
                                <span v-html="addBr(okr.categories)"> </span>
                            </div>
                            <div class="col-md-4">
                                <div><strong>Contributors:</strong></div>
                                <span v-html="addBr(okr.contributors)"></span>
                            </div>
                            <div class="col-md-4">
                                <div><strong>Impact Groups:</strong></div>
                                <span v-html="addBr(okr.impact_groups)"></span>
                            </div>
                        </div>
                        <div class="collapse mt-3" :id="'okr-'+ okr.id">
                            <h4>KRs</h4>
                            <ul class="list-group list-group-flush" style="white-space: pre-line;">
                                <li v-for="kr in okr.krs" class="list-group-item">
                                    <a :href="getKRRoute(kr.id)" :title = "'status: ' + kr.status " class="row">
                                        <span :class="kr.status" class="col-md-1" v-text="'KR-'+kr.id"></span>
                                        <span :class="kr.status" class="col-md-11" v-text="kr.title"></span>
                                        <!--<router-link :to="{ name: 'okr', params: { id:  }}">User</router-link>-->
                                    </a>
                                    <div v-html="addBr(kr.description)">

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span style="font-size: 20px"> OKR {{okr.id}}</span>
                        <button class="btn float-right btn-outline-primary" type="button" data-toggle="collapse" :data-target="'#okr-'+ okr.id" aria-expanded="false" aria-controls="collapseExample">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
        name: "Okrs",
        data() {
          return {
              test: 10,
              message:''
          };
        },
        mounted() {
          console.log("Component mounted.");
          this.getData(routes.api.okrs.index, "Okrs", "fetchOkrs");
        },
        computed: {
          okrs() {
              return this.$store.getters.getOkrs
                  ? this.$store.getters.getOkrs
                  : [];
          },
            doubleit(){
              return this.message + '  ' +this.message
            }
        },
      methods:{
          getOKRRoute(id){
              return routes.ui.okrs.index + id
          },
          getKRRoute(id) {
            return routes.ui.krs.show(id)
          },
          getOkrStatus(okr){
            let total = okr.krs.length
            let hold = okr.krs.filter(function(item ){ return item.status =="Hold"}).length;

            let level = hold * 100 / total 
            let css_class = 'border-success'
            if(level>50){
              css_class = 'border-danger'
            } else if(level>30){
              css_class = 'border-warning'
            }
            return css_class;
          },
          countDays(date){
              let today = moment();
              let target = moment(date)
              let days = target.diff(today, 'days')
              if (days)
                  return days + ' Remaining days';
              else
                  return "Missing date"

          }
      }
  };
</script>

<style scoped>
.Proposed{ color: #737373 }
.Active {color:blue;}
.Completed { color:green;  }
.Hold {color:red;}
    a:hover .card > *{ text-decoration:unset; border-color:red }
    .border { border-width : 2px !important }
    .okr-block { margin-top: 20px;}
</style>
