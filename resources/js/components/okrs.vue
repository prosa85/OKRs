<template>
    <div>
        <div v-if="okrs.length > 0" class="row justify-content-left">
            <div class="col-md-4" v-for="okr in okrs">
                <div class="card user-card border " :class="getOkrStatus(okr)">
                    <a :href="getOKRRoute(okr.id)">
                    <div
                        class="card-header"
                        v-text="okr.OKRs_title"
                    ></div>
                    </a>
                    <div class="card-body">
                        <div>Description: {{ okr.description }}</div>
                        <ul class="list-group list-group-flush">
                            <li v-for="kr in okr.krs" class="list-group-item">
                              <a :href="getKRRoute(kr.id)" :title = "'status: ' + kr.status ">
                                <span :class="kr.status" v-text="kr.title"></span>
                              </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
        name: "okrs",
        data() {
          return {
              test: 10
          };
        },
        mounted() {
          console.log("Component mounted.");
          this.getData(routes.okrs.index, "Okrs", "fetchOkrs");
        },
        computed: {
          okrs() {
              return this.$store.getters.getOkrs
                  ? this.$store.getters.getOkrs
                  : [];
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
</style>
