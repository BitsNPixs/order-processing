<template>
    <div class="card">
        <div class="card-header bg-transparent header-elements-inline">
            <h5 class="card-title">Create Order</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <select2 :options="customers" v-model="customerId"></select2>
                    <div class="card my-2" v-if="customer != null">
                        <div class="card-header bg-transparent header-elements-inline">
                            <span class="card-title font-weight-semibold">Customer Details</span>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li><b>Customer ID:</b> {{ customer.id }}</li>
                                <li><b>Name:</b> {{ customer.name }}</li>
                                <li><b>Email:</b> {{ customer.email }}</li>
                                <li><b>Periodic Billing:</b> {{ customer.periodic_billing ? 'Yes' : 'No' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row" v-if="customer != null">
                        <div class="card-header w-100">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Select Service:<span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                   <select2 :options="services" v-model="serviceId" placeholder="Select a service"></select2>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" v-if="service != null">
                            
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media flex-column flex-sm-row mt-0 mb-3">
                                            <div class="mr-sm-3 mb-2 mb-sm-0">
                                                <div class="card-img-actions">
                                                    <img :src="service.absolute_img" class="img-fluid img-preview rounded" alt="">
                                                </div>
                                            </div>

                                            <div class="media-body">
                                                <h6 class="media-title">{{ service.name }}</h6>
                                                <p>{{ service.description }}</p>
                                                <p class="font-weight-semibold">
                                                    <span>Service Price: ${{ service.price }}</span>
                                                    |
                                                    <span>Special Price: {{ overrideServicePrices ? '$' : '' }}{{ overrideServicePrices || 'N/A' }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-6">Price:</label>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" name="service-price" v-model.number="servicePrice">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-6">Quantity:</label>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" name="quantity" min="1" max="10" v-model.number="quantity">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-6">Communication Mode:</label>
                                            <div class="col-md-6">
                                                <select2 :options="communicationModes" v-model="communicationMode"></select2>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6 offset-md-6 custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="periodic-billing" name="periodic_billing" value="1" v-model="activateWithoutPayment">
                                                <label class="custom-control-label" for="periodic-billing">
                                                    Activate Order Without Payment
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="col-12 py-2">
                                <p class="alert alert-danger" v-if="errors.length">
                                    <ul class="mb-0 pl-3">
                                        <li v-for="error in errors">{{ error }}</li>
                                    </ul>
                                </p>
                                <button class="btn btn-primary btn-block btn-loading" @click="createOrder" :disabled="isUpdating">
                                    <i class="icon-spinner4 spinner mr-2" v-if="isUpdating"></i>
                                    Create Order
                                </button>
                            </div>
                        </div>
                        <div class="card-body" v-else>
                            <div class="alert alert-info">
                                Select service to continue.
                            </div>
                        </div>
                        
                    </div>
                    <div v-else>
                        <div class="alert alert-info">
                            Select customer on left side to override price.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["customers", "services", "communicationModes", "customerPriceUrl", "postUrl"],
        data() {
            return {
                customerId: 2,
                customer: null,
                serviceId: null,
                service: null,
                communicationMode: null,
                overridePrices: [],
                overrideServicePrices: null,
                quantity: 1,
                activateWithoutPayment: false,
                servicePrice: null,
                errors: [],
                isUpdating: false
            }
        },
        watch: {
            customerId: {
                immediate: true,
                handler(customerId) {
                    let vm = this;
                    vm.serviceId = null;
                    vm.customer = vm.customers.find(customer => customer.id == customerId);

                    axios.post(this.customerPriceUrl, {customer_id: customerId})
                    .then((response) => {
                        let dataObj = response.data;
                        let customerPrice = [];
                        $.map(dataObj, function(value, key){
                            customerPrice[key] = value;
                        });
                        vm.overridePrices = customerPrice;
                    });
                }
            },
            serviceId(serviceId){
                this.service = this.services.find(service => service.id == serviceId);
                this.overrideServicePrices = (serviceId != null && serviceId in this.overridePrices) ? this.overridePrices[serviceId] : null;
                this.servicePrice = this.overrideServicePrices || this.service?.price || null;
            }
        },
        methods: {
            createOrder() {
                let validationResult = this.validateData();

                if (!validationResult) {
                    return false;
                }

                let { customerId, serviceId, communicationMode, quantity, servicePrice, activateWithoutPayment, postUrl } = this;
                let vm = this;

                let data = {
                    customerId,
                    serviceId,
                    'communication-mode': communicationMode,
                    quantity,
                    servicePrice,
                    activateWithoutPayment
                };

                vm.isUpdating = true;

                axios.post(postUrl, data)
                    .then((response) => {
                        let data = response.data;
                        if (data.status == 'success') {
                            vm.serviceId = null;
                        }

                        if (data.action == 'redirect') {
                            window.location = data.actionUrl;
                        }
                    })
                    .finally(() => vm.isUpdating = false);
            },
            validateData() {
                let { customerId, serviceId, communicationMode, quantity, servicePrice, activateWithoutPayment, postUrl } = this;
                this.errors = [];

                if (quantity == null || quantity < 0) {
                    this.errors.push('Quantity should be greater than 0');
                    return false;
                }

                if (communicationMode == null) {
                    this.errors.push('Communication mode is required');
                    return false;
                }

                return true;
            }
        }
    }
</script>