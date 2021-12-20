<template>
    <div>
        <form>
            <div class="form-inline my-4 my-md-2">
                <input type="text" class="task-content shadow-sm my-2 my-md-1" v-model="taskContent" :placeholder="'إضافة مهمة جديدة ('+ activeCategory.title + ')' ">

                <select class="priority-select shadow-sm" v-model="taskPriority">
                    <option value="">الاولوية</option>
                    <option :value="priority.id" v-for="priority in priorities" :key="priority.id">
                        {{ priority.name }}
                    </option>
                </select>
                <button class="btn btn-sm btn-success rounded-pill shadow" @click.prevent="addNewTask">إضافة <fa icon="plus" /></button>
            </div>
        </form>
    </div>
</template>

<style scoped>
    .task-content{
        border: 1px solid #f3f3f3b8; 
        box-shadow: 1px 1px 4px #f3f3f370;
        width: 65%;
        padding: 6px 10px;
        border-radius: 15px;
        margin: 0px 4px;
    }
    .task-content:focus{
        outline: 1px dashed darkgrey;
    }
    .priority-select{
        border: 1px solid #e5e5e5;
        padding: 4px;
        border-radius: 5px;
        margin: 0px 4px;
    }
    .priority-select:focus{
        outline: 1px dashed darkgrey;
    }

    @media (max-width: 500px) {
        .task-content {
            width: 99%;
            padding: 6px 6px;
            margin: 0px 3px;
            font-size: 14px;
        }
    }
</style>

<script>
import axios from 'axios';
import config from '../../../public/config';

export default {
    name: "AddNewTaskTemplate",
    data(){
        return {
            taskContent: null,
            taskPriority: "",
        }
    },
    computed: {
        activeCategory: function(){
            return this.$store.state.categories.activeCategory;
        },
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
        addNewTask: function(){
            if( this.taskContent != null && this.taskContent != "" && this.taskPriority != "" ){
                let formData = new FormData();
                formData.append('content', this.taskContent);
                formData.append('category_id', this.activeCategory.id);
                formData.append('user_id', this.user.id);
                formData.append('priority_id', this.taskPriority);
              
                axios.post(config.api_url() + "/tasks/add", formData, {}).then(response => {
                    if(response.data.status){
                        let newTask = response.data.task;
                        this.$store.commit('tasks/addNewCategoryTaskItem', {category_id: this.activeCategory.id, task: newTask});
    
                        this.clearFormData();
                    }
                });
            }
        },
        clearFormData: function(){
            this.taskContent = null;
            this.taskPriority = "";
        }
    },
}
</script>