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
export const fetchCurrentOkr = (context) => {
    let id = context.getters.getOkr.id
    axios.get('/api/okrs/'+id)
        .then(response => {
            context.commit(types.SET_OKR,response.data)
        })
        .catch(response => {console.log('there was an error',response) })
}

export const setOkrComment = (context, data) => {
    context.commit(types.SET_OKR_COMMENTS, data)
}
export const setOkrStatuses = (context, data) => {
    context.commit(types.SET_OKR_KR_STATUSES, data)
}

