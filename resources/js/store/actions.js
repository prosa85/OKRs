import * as types from './mutation-types'
  console.log('action toggleDoneItem')


export const deleteItem = ({ commit }, item) => {
  const task = 'action deleteItem'
  console.log(task)
  commit(types.DELETE_ITEM, item)
}

export const fetchUsers = (context, data) => {
    context.commit(types.SET_USERS, data)
}
export const fetchOkrs = (context, data) => {
    context.commit(types.SET_OKRS, data)
}
export const fetchOkr = (context, data) => {
    context.commit(types.SET_OKR, data)
}
export const setOkrComment = (context, data) => {
    context.commit(types.SET_OKR_COMMENTS, data)
}

