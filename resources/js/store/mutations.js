import * as types from './mutation-types'

const mutations = {
  [types.SET_USERS](state,data){
  console.log('SET_USERS', data)
    state.users = data
  },
  [types.SET_ITEMS](state, items) {
    console.log('SET_ITEMS', items)
    state.items = items
  },
  [types.ADD_ITEM](state, item) {
    console.log('ADD_ITEM', item)
    state.items.push(item)
  },
  [types.UPDATE_ITEM](state, item) {
    console.log('UPDATE_ITEM', item)
    let itemToUpdate = state.items.find(i => i.id == item.id)
    Object.assign(itemToUpdate,item)
  },
  [types.DELETE_ITEM](state, item) {
    console.log('DELETE_ITEM', item)
    state.items.splice(state.items.findIndex(i => i.id == item.id), 1)
  },

  [types.ADD_PROCESSING_TASK](state, task) {
    console.log('ADD_PROCESSING_TASK', task)
    state.processingTasks.push(task)
  },
  [types.REMOVE_PROCESSING_TASK](state, task) {
    console.log('REMOVE_PROCESSING_TASK', task)
    state.processingTasks.splice(state.processingTasks.indexOf(task), 1)
  },
    [types.SET_OKRS](state, okrs) {
        console.log('GETTING OKRS', okrs)
        state.okrs = okrs
    },
    [types.SET_OKR_COMMENTS](state, comment) {
        state.okr.comments.push(comment)
    },
    [types.SET_OKR](state, okr) {
        console.log('GETTING OKR', okr)
        state.okr = okr
    },
    [types.SET_OKR_KR_STATUSES](state, statuses) {
        console.log('GETTING statuses', statuses)
        state.okrs_statuses = statuses
    },
    [types.EXPANDED_VIEW](state) {
        state.expanded.view = !state.expanded.view
    },
    [types.EXPANDED_TASKS](state) {
        state.expanded.tasks = !state.expanded.tasks
    },
}

export default mutations;
