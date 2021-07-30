<template>
    <form>
        <div>
            <label>Name</label>
            <InputText type="text" v-model="enteredName" />
        </div>
        <div>
            <label>Email</label>
            <InputText type="text" v-model="enteredEmail" />
        </div>
        <Button> Close</Button>
        <Button @click="addItem"> Add</Button>
    </form>
</template>

<script>
    export default {
        data(){
            return {
                enteredName: '',
                enteredEmail: '',
            }
        },
        methods: {
            addItem() {
                if(this.enteredName === '' && this.enteredEmail === ''){
                    return
                }
                axios.post('api/company/store', {
                    name: this.enteredName,
                    email: this.enteredEmail
                })
                .then( response => {
                    if(response.status == 201) {
                        this.enteredName = '';
                        this.enteredEmail = '';
                    }
                })
                .catch( error => {
                    console.log(error);
                });
            }
        }
    }
</script>

<style scoped>
input {
  font: inherit;
  padding: 0.15rem;
}

label {
  font-weight: bold;
  margin-right: 1rem;
  width: 7rem;
  display: inline-block;
}

form div {
  margin: 1rem 0;
}

Button {
    margin-right: 10px;
}
</style>
