<template>
    <div>
        <div>
            <strong>Task: </strong> <span v-text="task.id"></span>
            <span class="float-right" :class="getStyle(task.status)" v-text="'Status: ' + task.status"></span>
        </div>
        <div><span v-text="task.title"></span></div>
        <p v-text="task.description"></p>
        <div>Assigned to:
            <span class="text-success"
                  v-text="task.user.first_name+ '  ' +task.user.last_name"></span>
        </div>
        <div>
        </div>
    </div>
</template>
    <script>
        export default {
            name: "task",
            props: {
                task: {}
            }
        };
    </script>
