<template>
    <div>
        <DataTable :value="companies" :paginator="true" dataKey="id" :rows="10"
            :rowHover="true"  v-model:selection="selectedCompanies" :loading="loading"
            paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
            :rowsPerPageOptions="[10,25,50]"
            currentPageReportTemplate="Showing {first} to {last} of {totalRecords} entries"
            >
            <template #header>
                 <div class="datatable-header">
                    <h1 class="p-m-0">Companies</h1>
                    <span class="p-input-icon-left">
                        <i class="pi pi-search" />
                        <InputText  placeholder="Search" />
                    </span>
                 </div>
            </template>
            <template #empty>
                No companies found.
            </template>
            <template #loading>
                Loading companies data. Please wait.
            </template>
            <Column field="name" header="Company Name"></Column>
            <Column field="email" header="Email"></Column>
            <Column field="contactCount" header="Contact Count"></Column>
            <Column bodyStyle="text-align: center; overflow: visible;">
                <template #body>
                    <Button icon="pi pi-pencil" class="p-button-success p-button-rounded" />
                    <Button icon="pi pi-trash" class="p-button-rounded p-button-warning" />

                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script>
// import {FilterMatchMode,FilterOperator} from 'primevue/api';
export default {
    data() {
        return {
            companies: null,
            selectedCompanies: null,
            loading: true,
            // filters: {
            //     'global': {value: null, matchMode: FilterMatchMode.CONTAINS},
            //     'name': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.STARTS_WITH}]},
            //     'country.name': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.STARTS_WITH}]},
            //     'representative': {value: null, matchMode: FilterMatchMode.IN},
            //     'date': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.DATE_IS}]},
            //     'balance': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.EQUALS}]},
            //     'status': {operator: FilterOperator.OR, constraints: [{value: null, matchMode: FilterMatchMode.EQUALS}]},
            //     'activity': {value: null, matchMode: FilterMatchMode.BETWEEN},
            //     'verified': {value: null, matchMode: FilterMatchMode.EQUALS}
            // },
        }
    },
    methods: {
        getCompanies() {
            axios.get('api/companies')
            .then( response => {
                // console.log(response.data.data);
                this.companies = response.data.data
                this.loading = false
                // console.log(this.companies);
            })
            .catch( error => {
                console.log(error);
            })
        }
    },
    created() {
        this.getCompanies();
    }

};
</script>

<style scoped>
.p-button {
    margin-right: .5rem;
}

.datatable-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>
