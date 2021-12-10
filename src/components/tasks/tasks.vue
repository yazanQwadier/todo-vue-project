<template>
    <div>
        <template v-if="tasksList != null && tasksList.length + FinishedTasksList.length > 0">
            <div class="tasks-layout" v-if="tasksList.length > 0">
                <div v-for="task in tasksList" :key="'unfinished-' + task.id" class="task-item">
                    <TaskItem :task="task" />
                </div>
            </div>
            <div v-if="FinishedTasksList.length > 0">
                <div class="d-flex justify-content-around mt-2">
                    <h5>ما تم إنجازه  <fa icon="check-double" /></h5>
                    <button class="btn" @click="showFinishTasksList = !showFinishTasksList">
                        <fa icon="chevron-up" v-if="showFinishTasksList" />
                        <fa icon="chevron-down" v-else />
                    </button>
                </div>

                <template v-if="showFinishTasksList">
                    <div v-for="task in FinishedTasksList" :key="'finished-' + task.id" class="task-item">
                        <TaskItem :task="task" />
                    </div>
                </template>
            </div>
        </template>
        <div v-else>
            <span>لا يوجد مهام ...</span>
        </div>

        <AddNewTaskTemplate /> 
    </div>
</template>


<style >
    .tasks-layout{
        border: 1px solid #f7f7f7;
        border-radius: 40px;
        padding: 20px;
        max-height: 65vh;
        overflow: auto;
    }

    .task-item {
        border: 1px solid #e7e7e7;
        padding: 7px;
        border-radius: 10px;
        margin: 2px auto;
        width: 80%;
        transition: 0.2s;
    }

    .task-item p{
        font-size: 17px;
        padding: 0;
        margin: 0;
    }

    .task-item:hover {
        cursor: pointer;
        border: 1px solid #a7a7a7;
        box-shadow: 0px 0px 5px #dddddd;
        background: #f7f7f7;
    }

    .task-content{
        border: 1px solid #d5d5d5b8;
        padding: 5px;
        border-radius: 6px;
        width: 80%;
    }
    .task-content:focus{
        outline: 1px dashed darkgrey;
    }

    .priority{
        font-size: 13px;
        padding: 5px;
        border: 0px;
        border-radius: 8px;
        box-shadow: 0px 0px 3px #ddddddcf;
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

    .has-done-btn{
        width: 19px;
        height: 19px;
        border: 0.53px solid #8f8f8fd9;
        background: transparent;
        border-radius: 25px;
        margin: 0px 5px;
        overflow: hidden;
    }

    .checked-done-btn{
        background: #4e4e4e;
    }

    .has-done-btn > .check-icon{
        width: 11px;
        color: white;
    }
</style>

<script>
import axios from 'axios';
import AddNewTaskTemplate from '../tasks/addNewTask.vue';
import config from '../../../public/config';
import TaskItem from './taskItem.vue';

export default {
    name: "TasksTemplate",
    components: {
        AddNewTaskTemplate,
        TaskItem
    },
    data(){
        return {
            FinishedTasksList: [],
            showFinishTasksList: false,
        }
    },
    computed: {
        activeCategory: function(){
            return this.$store.state.categories.activeCategory;
        },
        user: function(){
            return this.$store.state.auth.user;
        },
        tasksList: function(){
            if( this.$store.state.tasks.tasksList != null ){
                let arr = this.$store.state.tasks.tasksList[this.activeCategory.id];
                if( arr != null && arr != undefined ){
                    this.FinishedTasksList = this.getFinishedTasks(arr);
                    return this.getUnFinishedTasks(arr);
                }
                this.FinishedTasksList = [];
                return [];
           }
            else {
                this.FinishedTasksList = [];
                return [];
            }
        },
    },
    methods: {
        getFinishedTasks(arr){
            return arr.filter(function(item){ return item.has_done == 1; });
        },
        getUnFinishedTasks(arr){
            return arr.filter(function(item){ return item.has_done != 1; });
        }
    },
    created: function(){
        let query = "?user_id="+this.user.id;
        axios.get( config.api_url() + "/tasks"+query)
            .then((response) => {
                // console.log(response);
                this.$store.commit('tasks/setTasksList', response.data);
            })
            .catch(error => {
                console.log(error);
            });
    }
}
</script>