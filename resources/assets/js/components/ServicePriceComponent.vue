<template>
    <div class="card">
        <div class="card-header bg-transparent header-elements-inline">
            <h5 class="card-title">Override Service Price</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <select2 :options="customers" v-model="selectedCustomerId"></select2>
                    <div class="card my-2" v-if="selectedCustomer != null">
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
                                <li><b>Customer ID:</b> {{ selectedCustomer.id }}</li>
                                <li><b>Name:</b> {{ selectedCustomer.name }}</li>
                                <li><b>Email:</b> {{ selectedCustomer.email }}</li>
                            </ul> 
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row" v-if="selectedCustomer != null">
                        <div class="col-12">
                            <p class="text-muted">Note: Override service price. Leave it black if you want to use actual service price.</p>
                        </div>

                        <div class="col-xl-4" v-for="service in services">
                            <div class="card">
                                <div class="card-body p-1">
                                    <div class="card-img-actions">
                                        <img :src="service.absolute_img" class="card-img" alt="">
                                            
                                    </div>
                                </div>

                                <div class="card-body bg-light text-center p-2">
                                    <div class="mb-2">
                                        <h6 class="font-weight-semibold mb-0">
                                            {{ service.name }}
                                        </h6>
                                    </div>

                                    <h3 class="mb-0 font-weight-semibold">${{ service.price }}</h3>
                                    
                                    <label class="font-weight-semibold mt-2">Special Price</label>
                                    <div class="form-group form-group-feedback form-group-feedback-left mb-0">
                                        <input type="number" name="price" id="price" class="form-control" v-model.number="overridePrices[service.id]">
                                        <div class="form-control-feedback">
                                            $
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="col-12 py-2">
                            <button class="btn btn-primary btn-block btn-loading" @click="updatePrice" :disabled="isUpdating">
                                <i class="icon-spinner4 spinner mr-2" v-if="isUpdating"></i>
                                Update Price
                            </button>
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
        props: ["customers", "services", "customerPriceUrl", "updateUrl"],
        data() {
            return {
                selectedCustomerId: null,
                selectedCustomer: null,
                overridePrices: [],
                isUpdating: false
            }
        },
        watch: {
            selectedCustomerId: {
                immediate: true,
                handler(customerId) {
                    let vm = this;
                    
                    vm.selectedCustomer = vm.customers.find(customer => customer.id == customerId);

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
            }
        },
        methods: {
            updatePrice() {
                let customerServicePrice = [];
                let vm = this;
                this.overridePrices.forEach((value, key) => {
                    if(value !== undefined && value !== ""){
                        customerServicePrice[key] = {price: value}
                    }
                });

                vm.isUpdating = true;

                axios.post(this.updateUrl, {
                    customer_id: this.selectedCustomer.id,
                    customer_service_price: customerServicePrice
                }).then(() => vm.isUpdating = false);
            }
        }
    }
</script>