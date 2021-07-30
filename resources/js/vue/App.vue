<template>
<div class="card">
    <div class="container">
        <h2 class="title">Company Management</h2>
        <div class="heading">
            <AddCompanyForm></AddCompanyForm>
        </div>
        <CompanyDatatable ></CompanyDatatable>
    </div>
</div>
</template>

<script>
import AddCompanyForm from './Company/AddCompanyForm.vue'
import CompanyDatatable from './Company/CompanyDatatable.vue'

    export default {
        components: {
            AddCompanyForm,
            CompanyDatatable
        },
        data() {
            return {
                companies: []
            }
        },
        methods: {
        }
    }
</script>

<style scoped>
.heading {
    background: #ccc;
    border-radius: 8px;
    margin: 2rem 0;
    padding: 10px;
}
.card {
    margin: auto;
    text-align: center;
    width: 70rem;
    max-width: 90%;
    background: white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
    border-radius: 8px;
    padding: 20px;
}
</style>
