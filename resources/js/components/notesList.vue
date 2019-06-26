<template>
    <div>
        <h3>Notes</h3>
        <ul>
            <li class="bg-light text-info" v-for="note in comments">
                <b-form inline class="float-right">
                    <label v-text="note.created_at" class="mr-2"
                    ></label>
                    <b-button size="sm"
                              title="Delete Note"
                              @click="deleteNote(note)"
                              variant="link"
                              class="text-danger">
                        <i class="fas fa-trash-alt"></i>
                    </b-button>

                </b-form>
                <p v-text="note.body"></p>
            </li>
        </ul>
        <b-form @submit="addNote" inline class="">
            <b-input-group class="mb-2 mr-2 form-note">
                <b-input
                    type="text"
                    required
                    placeholder="New Note"
                    v-model="newNote"
                ></b-input>
            </b-input-group>
            <b-button type="submit" class="mb-2" variant="outline-primary">Save</b-button>
        </b-form>
    </div>
</template>

<script>
  export default {
    name: "notesList",
      props:{ comments:{}, bo:"", bo_id:0 },
      data(){
        return {
            newNote: "",
        }
      },
      methods:{
          addNote(evt) {
              evt.preventDefault()
              let newNote = {
                  id: this.bo_id,
                  text: this.newNote,
                  model: "App\\"+ this.bo
              };
              this.postData("/api/comments", newNote, true);
              this.newNote = ""
          },
          deleteNote(note) {
              this.deleteData("/api/comments/" + note.id, note.id);
              this.comments = this.comments.filter(function(item){
                  return item != note
              })
          },
      }
  };
</script>

<style scoped>

</style>
