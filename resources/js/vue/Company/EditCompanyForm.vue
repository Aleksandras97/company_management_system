<template>
    <Dialog
        header="Header"
        v-model:visible="displayEditModal"
        :style="{ width: '30rem' }"
        :modal="true"
    >
        <template #header>
            <h2>Edit Company</h2>
        </template>
        <form :class="{ invalid: invalidInput === true }">
            <div class="form-control">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" v-model.trim="name" />
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input
                    id="email"
                    name="email"
                    type="text"
                    v-model.trim="email"
                />
            </div>
        </form>
        <p v-if="invalidInput" style="color: red">Input is invalid</p>
        <template #footer>
            <Button
                label="Close"
                icon="pi pi-times"
                @click="$emit('close-modal')"
                class="p-button-text"
            />
            <Button label="Add" icon="pi pi-check" @click="editCompany" />
        </template>
    </Dialog>
</template>

<script>
export default {
    props: ["displayEditModal", "id", "name", "email"],
    emits: ["close-modal", "edit-company"],
    data() {
        return {
            // companies: null,
            loading: false,
            invalidInput: false,
        };
    },
    methods: {
        editCompany() {
            if (this.name === "" && this.email === "") {
                this.invalidInput = true;
                console.log("invalid");
                return;
            }
            this.$emit("edit-company", this.id, this.name, this.email);
        },
    },
};
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
</style>
