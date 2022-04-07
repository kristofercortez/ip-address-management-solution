<template>
    <div>
        <b-card-group deck>
            <b-card
                header="IP Addresses"
                header-tag="header"
            >
                <template #header>
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h2 class="mb-0">{{ objectTitle }}</h2>
                        </div>
                        <div class="col-6 text-right">
                            <h6 class="mb-0">
                                <b-button
                                    href="javascript:void(0)"
                                    @click="addNewObject"
                                    variant="primary"
                                >
                                    <i class="fa fa-plus"></i> Add New
                                </b-button>
                            </h6>
                        </div>
                    </div>
                </template>
                <b-table
                    striped
                    hover
                    :fields="tableFields"
                    :items="tableItems"
                    :busy="isTableBusy"
                    show-empty
                >
                    <template #table-busy>
                        <div class="text-center text-danger my-2">
                            <b-spinner class="align-middle"></b-spinner>
                            <strong>Loading...</strong>
                        </div>
                    </template>
                    <template #empty="scope">
                        <h4 class="text-center">No Data Found!</h4>
                    </template>
                    <template #cell(actions)="data">
                        <div>
                            <b-button-group>
                                <b-button
                                    :href="formatObjectFormURL(data.item.id)"
                                    variant="primary"
                                >
                                    <i class="fa fa-eye"></i> View
                                </b-button>
                            </b-button-group>
                        </div>
                    </template>
                </b-table>
                <b-pagination
                    v-model="currentPage"
                    :total-rows="totalRecords"
                    :per-page="perPage"
                    aria-controls="my-table"
                    @input="changePage"
                ></b-pagination>
            </b-card>
        </b-card-group>
        <vue-confirm-dialog></vue-confirm-dialog>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "IpAddressIndex",
    props: {
        objectTitle: {
            required: true,
            type: String
        },
        objectAddFormRoute: {
            required: true,
            type: String
        },
        objectEditFormRoute: {
            required: true,
            type: String
        }
    },
    data() {
        return {
            currentPage: 1,
            totalRecords: 0,
            perPage: 10,
            isTableBusy: false,
            tableFields: [
                {
                    key: 'ipAddress',
                    label: 'IP Address',
                    sortable: true
                },
                {
                    key: 'label',
                    label: 'Label',
                    sortable: true
                },
                {
                    key: 'actions',
                    sortable: false,
                    class: 'text-center'
                }
            ],
            tableItems: []
        };
    },
    mounted() {
        this.getAndDisplayTableData();
    },
    methods: {
        addNewObject() {
            location.replace(this.objectAddFormRoute);
        },
        getAndDisplayTableData() {
            this.isTableBusy = true;
            this.tableItems = [];

            axios.get(`/ip-addresses/list/${this.currentPage}/${this.perPage}`).then((response) => {
                let responseData = response.data;
                if (responseData.success) {
                    this.tableItems = responseData.data.tableData;
                    this.totalRecords = responseData.data.totalRecords;
                    this.currentPage = responseData.data.currentPage;
                }

                this.isTableBusy = false;
            })
        },
        formatObjectFormURL(id) {
            if (id) {
                let url = this.objectEditFormRoute;
                return url.replace(':id', id);
            }

            return 'javascript:void(0)';
        },
        changePage(newPage) {
            this.currentPage = newPage;
            this.getAndDisplayTableData();
        }
    }
}
</script>

<style scoped>

</style>