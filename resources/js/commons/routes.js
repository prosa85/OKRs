export default {
  ui:{
    okrs:{
        index:'okrs/'
    },
    krs:{
      index:'krs/',
      show: function(id=0){ return 'krs/' + id }
    }
  },
    users:{
    index:'api/users',
    current:'api/users/current'
  },
    okrs:{
      index:'api/okrs'
    }
}
