<template>
    <div>
        <b-overlay :show="isLoading" rounded="sm">
            <b-card-group deck>
                <b-card
                    header="IP Addresses"
                    header-tag="header"
                >
                    <template #header>
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h3 class="mb-0">{{ headerText }}</h3>
                            </div>
                        </div>
                    </template>
                    <validation-observer ref="observer" v-slot="{ handleSubmit }">
                        <b-form id="object-form" @submit.stop.prevent="handleSubmit(onSubmit)">
                            <div class="row">
                                <div class="col-md-4">
                                    <ValidationProvider name="IP Address" :rules="{ required: true, ip_address: true }" v-slot="validationContext">
                                        <b-form-group label-cols="12" label-cols-lg="12" label="IP Address" label-for="ip-address-input">
                                            <b-form-input
                                                id="ip-address-input"
                                                v-model="ipAddress"
                                                :state="getValidationState(validationContext)"
                                                aria-describedby="ip-address-input-feedback"
                                                :readonly="isEditing"
                                            ></b-form-input>
                                            <b-form-invalid-feedback id="ip-address-input-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                                        </b-form-group>
                                    </ValidationProvider>
                                </div>
                                <div class="col-md-4">
                                    <ValidationProvider name="Label" :rules="{ required: true, min: 3 }" v-slot="validationContext">
                                        <b-form-group label-cols="12" label-cols-lg="12" label="Label" label-for="label-input">
                                            <b-form-input
                                                id="label-input"
                                                v-model="label"
                                                :state="getValidationState(validationContext)"
                                                aria-describedby="label-input-feedback"
                                            ></b-form-input>
                                            <b-form-invalid-feedback id="label-input-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                                        </b-form-group>
                                    </ValidationProvider>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 text-right">
                                    <b-button class="ml-2" type="submit" variant="primary" :disabled="isSaving"><b-spinner v-show="isSaving" class="align-middle mr-1" small></b-spinner> Save</b-button>
                                    <b-button class="ml-2" variant="danger" @click="goBack()" :disabled="isSaving">Back to List</b-button>
                                </div>
                            </div>
                        </b-form>
                    </validation-observer>
                </b-card>
            </b-card-group>
        </b-overlay>
        <vue-confirm-dialog></vue-confirm-dialog>
    </div>
</template>

<script>

import axios from "axios";

export default {
    props: {
        objectId: {
            type: String,
            required: false,
            default: null
        },
        objectIndexRoute: {
            required: true,
            type: String
        },
    },
    data() {
        return {
            ipAddress: null,
            label: null,
            isLoading: false,
            isSaving: false,
            headerText: 'Add a new IP Address',
            toastCount: 0
        };
    },
    computed: {
        isEditing() {
            return !!this.objectId;
        }
    },
    mounted() {
        if (this.objectId) {
            this.loadObjectData();
        }
    },
    methods: {
        saveData() {
            let data = {
                id: this.objectId,
                ipAddress: this.ipAddress,
                label: this.label
            };

            // Update data
            if (this.objectId !== "" && this.objectId !== null) {
                axios.put(`/ip-addresses/${this.objectId}`, data).then((response) => {
                    let responseData = response.data;
                    if (responseData.success) {
                        common.showToastSuccess('Success!', responseData.message);
                        setTimeout(() => {
                            window.location.reload();
                        }, 3000);
                        return;
                    }

                    common.showToastError('Error!', responseData.message);
                    this.isSaving = false;
                })
                return;
            }

            // Add data
            axios.post(`/ip-addresses`, data).then((response) => {
                let responseData = response.data;
                if (responseData.success) {
                    common.showToastSuccess('Success!', responseData.message);
                    setTimeout(() => {
                        window.location.replace(this.objectIndexRoute);
                    }, 3000);
                    return;
                }

                common.showToastError('Error!', responseData.message);
                this.isSaving = false;
            })
        },
        goBack() {
            this.$confirm(
                {
                    message: `Are you sure you want to go back to the data list? All unsaved changes will be lost.`,
                    button: {
                        no: 'No',
                        yes: 'Yes'
                    },
                    /**
                     * Callback Function
                     * @param {Boolean} confirm
                     */
                    callback: confirm => {
                        if (confirm) {
                            location.replace(this.objectIndexRoute);
                        }
                    }
                }
            )
        },
        getValidationState({ dirty, validated, valid = null }) {
            return dirty || validated ? valid : null;
        },
        onSubmit() {
            this.isSaving = true;
            this.saveData();
        },
        async loadObjectData() {
            this.isLoading = true;

            axios.get(`/ip-addresses/form/${this.objectId}`).then((response) => {
                let responseData = response.data;
                if (responseData.success) {
                    this.ipAddress = response.data.data.ipAddress;
                    this.label = response.data.data.label;
                    this.headerText = `IP Address information for ${this.ipAddress}`;
                    this.isLoading = false;
                    return;
                }

                common.showToastError('Error!', responseData.message);
                setTimeout(() => {
                    window.location.replace(this.objectIndexRoute);
                }, 3000);
            })
        }
    },
};
</script>