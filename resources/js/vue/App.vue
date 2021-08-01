<template>
    <div class="card">
        <div class="container">
            <h2 class="title">Company Management</h2>
            <div class="heading">
                <AddCompanyForm @add-company="getCompanies"></AddCompanyForm>
            </div>
            <CompanyDatatable :companies="companies" @company-update="getCompanies" ></CompanyDatatable>
        </div>
    </div>
</template>

<script>
import AddCompanyForm from "./Company/AddCompanyForm.vue";
import CompanyDatatable from "./Company/CompanyDatatable.vue";

export default {
    components: {
        AddCompanyForm,
        CompanyDatatable,
    },
    data() {
        return {
            companies: [],
        };
    },
    methods: {
        addCompany(name, email) {
            const newCompany = {
                id: new Date().toISOString(),
                name: name,
                email: email,
                contactCount: 0,
            };
            this.companies.unshift(newCompany);
        },
        getCompanies() {
            axios
                .get("api/companies")
                .then((response) => {
                    this.companies = response.data.data;
                    this.loading = false;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        deleteCompany(companyId) {
            console.log(companyId);
            const compIndex = this.companies.findIndex(comp => comp.id === companyId);
            this.companies.splice(compIndex, 1);
            // this.companies.filter(comp => comp.id !== companyId)
        }
    },
    created() {
        this.getCompanies();
    }
};
</script>

<style scoped>
.heading {
    background: rgb(236, 236, 236);
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
