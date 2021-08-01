<template>
    <Toast />
    <ConfirmDialog></ConfirmDialog>
    <div>
        <DataTable
            :value="companies"
            editMode="cell"
            :paginator="true"
            dataKey="id"
            :rows="10"
            :rowHover="true"
            :loading="loading"
            :globalFilterFields="['name']"
            v-model:filters="filters"
            paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
            :rowsPerPageOptions="[10, 25, 50]"
            currentPageReportTemplate="Showing {first} to {last} of {totalRecords} entries"
        >
            <template #header>
                <div class="datatable-header">
                    <h1 class="p-m-0">Companies</h1>
                    <span class="p-input-icon-left">
                        <i class="pi pi-search" />
                        <InputText
                            v-model="filters['global'].value"
                            placeholder="Search"
                        />
                    </span>
                </div>
            </template>
            <template #empty> No companies found. </template>
            <template #loading> Loading companies data. Please wait. </template>
            <Column field="name" header="Company Name"></Column>
            <Column field="email" header="Email"></Column>
            <Column field="contactCount" header="Contact Count"></Column>
            <Column bodyStyle="text-align: center; overflow: visible;">
                <template #body="slotProps">
                    <Button
                        icon="pi pi-pencil"
                        class="p-button-success p-button-rounded"
                        @click="
                            openModal(
                                slotProps.data.id,
                                slotProps.data.name,
                                slotProps.data.email
                            )
                        "
                    />

                    <!-- <Button icon="pi pi-trash" class="p-button-rounded p-button-warning" /> -->
                    <Button
                        @click="confirm(slotProps.data.id)"
                        icon="pi pi-trash"
                        class="p-button-rounded p-button-warning"
                    ></Button>
                </template>
            </Column>
        </DataTable>

        <EditCompanyForm
            :displayEditModal="displayEditModal"
            :id="selectedId"
            :name="selectedName"
            :email="selectedEmail"
            @close-modal="closeModal"
            @edit-company="editCompany"
        ></EditCompanyForm>
    </div>
</template>

<script>
import EditCompanyForm from "./EditCompanyForm.vue";
import { FilterMatchMode } from "primevue/api";

export default {
    components: { EditCompanyForm },
    props: ["companies"],
    emits: ["company-update"],
    data() {
        return {
            filters: {
                global: { value: null, matchMode: FilterMatchMode.CONTAINS },
            },
            loading: false,
            displayEditModal: false,
            selectedCompanies: null,
            selectedId: "",
            selectedName: "",
            selectedEmail: "",
            invalidInput: false,
        };
    },
    methods: {
        confirm(companyId) {
            this.$confirm.require({
                message: "Do you want to delete this record?",
                header: "Delete Confirmation",
                icon: "pi pi-info-circle",
                acceptClass: "p-button-danger",
                accept: () => {
                    this.deleteCompany(companyId);
                },
                reject: () => {
                    this.$toast.add({
                        severity: "error",
                        summary: "Rejected",
                        detail: "You have rejected",
                        life: 3000,
                    });
                },
            });
        },
        deleteCompany(companyId) {
            this.loading = true;
            axios
                .delete("api/company/" + companyId)
                .then((response) => {
                    if (response.status === 200) {
                        this.$emit("company-update");
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                    this.$toast.add({
                        severity: "info",
                        summary: "Confirmed",
                        detail: "Record deleted",
                        life: 3000,
                    });
                });
        },
        openModal(id, name, email) {
            this.selectedId = id;
            this.selectedName = name;
            this.selectedEmail = email;
            this.displayEditModal = true;
        },
        closeModal() {
            this.displayEditModal = false;
            this.$toast.add({
                severity: "error",
                summary: "Rejected",
                detail: "You have rejected",
                life: 3000,
            });
        },
        closeModal() {
            this.displayEditModal = false;
            this.$toast.add({
                severity: "error",
                summary: "Rejected",
                detail: "You have rejected",
                life: 3000,
            });
        },
        editCompany(id, name, email) {
            this.loading = true;
            axios
                .put("api/company/" + id, {
                    name: name,
                    email: email,
                })
                .then((response) => {
                    if (response.status === 200) {
                        this.$emit("company-update");
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.loading = false;
                    this.displayEditModal = false;
                    this.$toast.add({
                        severity: "info",
                        summary: "Confirmed",
                        detail: "Record edited",
                        life: 3000,
                    });
                });
        },
    },
};
</script>

<style scoped>
.p-button {
    margin-right: 0.5rem;
}

.datatable-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

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
