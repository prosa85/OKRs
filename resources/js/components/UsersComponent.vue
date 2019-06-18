<template>
    <div class="">
        <div class="row justify-content-left">
            <div class="col-md-4" v-for="user in users">
                <div class="card user-card">
                    <div
                        class="card-header"
                        v-text="user.first_name + ' ' + user.last_name"
                    ></div>
                    <div class="card-body">
                        <div>Position: {{ user.title }}</div>
                        <div>email: {{ user.email }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name:'UsersComponent',
    data() {
        return {
            test: 10
        };
    },
    mounted() {
        console.log("Component mounted.");
        this.users = this.getData(routes.users.index, "Users", "fetchUsers");
    },
    computed: {
        users() {
            return this.$store.getters.getUsers
                ? this.$store.getters.getUsers
                : [];
        }
    }
};
</script>
<style>
.user-card {
    margin-top: 10px;
}
</style>
