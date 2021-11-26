<template>
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <!-- Edit Task Section -->
            <div v-if="editingTask != null && editingTask.content == task.content" class="d-flex align-items-center w-75">
                <input type="text" class="task-content" v-model="editingTask.content" placeholder="تعديل المهمة">
                <select class="priority-select shadow-sm" v-model="editingTask.priority_id">
                    <option value="">الاولوية</option>
                    <option :value="priority.id" v-for="priority in priorities" :key="priority.id">
                        {{ priority.name }}
                    </option>
                </select>

                <button class="btn btn-success btn-sm rounded-pill" title="تعديل" @click.prevent="editTask">
                    <fa icon="edit" />
                </button>
            </div>
            <!-- End Edit Task Section -->

            <!-- Preview Task Section -->
            <div class="d-flex justify-content-start align-items-center" v-else>
                <button @click.prevent="taskDone" class="has-done-btn" :class="(task.has_done == 1)?'checked-done-btn': ''">
                    <template v-if="task.has_done == 1">
                        <fa icon="check" class="check-icon" />
                    </template>
                </button>
                <p @click.prevent="editingTask = task">
                    <span class="priority" :style="'background:' +  task.color">أولوية {{ task.priority_name }}</span>
                    {{ task.content }}
                </p>
            </div>               
            <!-- End Preview Task Section -->

            <!-- Delete Task Section -->
            <div>
                <button class="btn btn-danger btn-sm rounded-pill" title="حذف" @click.prevent="deleteTask">
                    <fa icon="trash-alt" />
                </button>
            </div>
            <!-- End Delete Task Section -->
        </div>
    </div>
</template>


<script>
import axios from 'axios';
import config from '../../../public/config';

export default {
    name: "EditTask",
    props: ["task"],
    data(){
        return {
            letEditingVisible: false,
            editingTask: null,
        }
    },
    computed: {
        user: function(){
            return this.$store.state.auth.user;
        },
        priorities: function(){
            let list = this.$store.state.priorities.prioritiesList;
            list = list.sort(function(item1, item2){ return (item1.priority > item2.priority)? 1 : -1});
            return list;
        },
    },
    methods: {
        editTask: function(){
            let formData = new FormData();
            formData.append('content', this.editingTask.content);
            formData.append('user_id', this.user.id);
            formData.append('task_id', this.editingTask.id);
            formData.append('priority_id', this.editingTask.priority_id);

            axios.post(config.api_url() + '/tasks/update', formData, {})
                .then(response => {
                    // console.log(response);
                    if(response.data.status){
                        let taskUpdated = response.data.task;
                        this.$store.commit('tasks/updateTaskItem', {category_id: this.task.category_id, task: taskUpdated});

                        this.clearFormData();
                    }
                });
        },
        deleteTask: function(){
            this.$swal.fire({
                title: 'هل انت متأكد من الحذف ؟',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'نعم',
                denyButtonText: `تراجع`,
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append('task_id', this.task.id);

                    axios.post(config.api_url() + '/tasks/delete', formData, {})
                        .then(response => {
                            // console.log(response);
                            if(response.data.status){
                                this.$store.commit('tasks/deleteTaskItem', {task: this.task});
                                this.$swal.fire('تم الحذف', '', 'success')
                            }
                        });
                }
            });
        },
        taskDone(){
            let formData = new FormData();
            formData.append('task_id', this.task.id);
            let has_done = (this.task.has_done == 0)? 1 : 0;
            formData.append('has_done', has_done);

            axios.post(config.api_url() + '/tasks/change-task-done', formData, {})
                .then(response => {
                    // console.log(response);
                    if(response.data.status){
                        let taskUpdated = response.data.task;
                        this.$store.commit('tasks/updateTaskItem', {category_id: this.task.category_id, task: taskUpdated});
                    }
                });
        },
        clearFormData: function(){
            this.editingTask = null;
        }
    },
}
</script>