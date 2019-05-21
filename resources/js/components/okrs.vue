<template>
    <div>
        <div class="row justify-content-left">
            <div class="col-md-4" v-for="okr in okrs">
                <div class="card user-card">
                    <div
                        class="card-header"
                        v-text="okr.OKRs_title"
                    ></div>
                    <div class="card-body">
                        <div>Description: {{ okr.description }}</div>
                        <ul>
                            <li v-for="kr in okr.krs">

                                <span :class="kr.status" v-text="kr.title"></span>
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
        }
  };
</script>

<style scoped>
.Active {color:green;}
.Hold {color:red;}
</style>
