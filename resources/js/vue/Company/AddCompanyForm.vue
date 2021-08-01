<template>


    <Button class="new-button" label="New" icon="pi pi-plus" @click="openModal" />
    <Dialog header="Header" v-model:visible="displayAddModal" :style="{width: '30rem'}" :modal="true">
        <template #header>
            <h2>Add Company</h2>
        </template>
        <form :class="{ invalid: invalidInput === true }" >
            <div class="form-control">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" v-model.trim="enteredName" />
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input id="email" name="email" type="text" v-model.trim="enteredEmail"  />
            </div>

        </form>
        <p v-if="invalidInput" style="color: red;">Input is invalid</p>
        <template #footer>
            <Button label="Close" icon="pi pi-times" @click="closeModal" class="p-button-text"/>
            <Button label="Add" icon="pi pi-check" @click="addItem"  />
        </template>
    </Dialog>
</template>

<script>
    export default {
        data(){
            return {
                enteredName: '',
                enteredEmail: '',
                displayAddModal: false,
                invalidInput: false,
            }
        },
        methods: {
            addItem() {
                if(this.enteredName === '' && this.enteredEmail === ''){
                    this.invalidInput = true
                    console.log('invalid');
                    return
                }
                axios.post('api/company/store', {
                    name: this.enteredName,
                    email: this.enteredEmail
                })
                .then( response => {
                    this.invalidInput = false;
                    if(response.status == 201) {
                        this.enteredName = '';
                        this.enteredEmail = '';
                    }
                    this.closeModal();
                })
                .catch( error => {
                    console.log(error);
                });
            },
            openModal() {
                this.displayAddModal = true;
            },
            closeModal() {
                this.displayAddModal = false;

            }
        }
    }
</script>

<style scoped>
input {
  display: block;
  width: 100%;
  font: inherit;
  padding: 0.15rem;
  border: 1px solid #ccc;
}

input:focus {
  outline: none;
  border-color: #3a0061;
  background-color: #f7ebff;
}

label {
  font-weight: bold;
  display: block;
  margin-bottom: 0.5rem;
}

.form-control {
  margin: 1rem 0;
}

form.invalid input {
  border-color: red;
}

form.invalid label {
  color: red;
}

.new-button {
    display: flex;
}
</style>
