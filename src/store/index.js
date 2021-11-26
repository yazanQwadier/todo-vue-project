import { createStore } from "vuex";

let auth = {
  namespaced: true,
  state: {
    user: null,
  },
  mutations: {
      setUserObject(state, user){
          state.user = user;
      },
      clearUser(state){
          state.user = null;
      }
  },
  actions: {},
};

let categories = {
  namespaced: true,
  state: {
    activeCategory: null,
  },
  action: {},
  mutations: {
    setGlobalCategory(state, category){
      state.activeCategory = category;
    }
  },
}

// add / edit / delete tasks from store
let tasks = {
  namespaced: true,
  state: {
    tasksList: null
  },
  mutations: {
    setTasksList(state, data){
      state.tasksList = data;
    },
    addNewCategoryTasks(state, data){
      if( state.tasksList != null ){
        state.tasksList[data.category_id] = data.tasks;
      }
      else{
        state.tasksList = {};
        state.tasksList[data.category_id] = data.tasks;
      }
    },
    addNewCategoryTaskItem(state, data){
      if( state.tasksList != null){
        if( state.tasksList[data.category_id] != undefined )
          state.tasksList[data.category_id].push(data.task);
        else
          state.tasksList[data.category_id] = [data.task];
      }
      else{
        state.tasksList = {};
        state.tasksList[data.category_id] = [data.task];
      }
    },
    updateTaskItem(state, data){
      let arr = state.tasksList[data.category_id];
      let index = arr.findIndex((item) => item.id == data.task.id);
      state.tasksList[data.category_id][index] = data.task;
    },
    deleteTaskItem(state, data){
      let arr = Array.from(state.tasksList[data.task.category_id]);
      let index = arr.findIndex((item) => item.id == data.task.id);
      arr.splice(index, 1);
      state.tasksList[data.task.category_id] = arr;
    }
  },
  actions: {}
}


let priorities = {
  namespaced: true,
  state: {
    prioritiesList: [],
  },
  mutations: {
    setPrioritiesList(state, data){
      state.prioritiesList = data;
    }
  },
  actions:{}
};

export default createStore({
  state: {},
  mutations: {},
  actions: {},
  modules: {
    auth,
    categories,
    tasks,
    priorities
  },
});
