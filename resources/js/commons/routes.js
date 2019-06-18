export default {
  ui:{
    okrs:{
        index:'okrs/'
    },
    krs:{
      index:'krs/',
        show(id){ return 'krs/' + id }
    }
  },
    users:{
    index:'api/users',
    current:'api/users/current'
  },
    api:{
        okrs:{
            index:'/api/okrs',
            show(id){ return '/api/okrs/' + id }
        },

    }
}
