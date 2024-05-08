<div>
    <div class="checkout">
        <div class="container">
            <h4 class="fonts">Checkout</h4>
            <hr>

            @if ($this->totalPriceAmount != 0)
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Item Total Amount :
                                <span class="float-end">₹{{ $this->totalPriceAmount }}</span>
                            </h4>
                            <hr>
                            <small>* Items will be delivered in 3 - 5 days.</small>
                            <br />
                            <small>* Tax and other charges are included ?</small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Basic Information
                            </h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Full Name</label>
                                    <input type="text" wire:model="name" id="name" class="form-control"
                                        placeholder="Enter Full Name" />
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone Number</label>
                                    <input type="number" wire:model="phone_no" id="phone_no" class="form-control"
                                        placeholder="Enter Phone Number" />
                                    @error('phone_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email Address</label>
                                    <input type="email" wire:model="email" id="email" class="form-control"
                                        placeholder="Enter Email Address" />
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Pin-code (Zip-code)</label>
                                    <input type="number" wire:model="pincode" id="pincode" class="form-control"
                                        placeholder="Enter Pin-code" />
                                    @error('pincode')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Full Address</label>
                                    <textarea wire:model="address" id="address" class="form-control" rows="2"></textarea>
                                    @error('address')
                                        <small class="text-danger"> {{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3" wire:ignore>
                                    <label>Select Payment Mode: </label>
                                    <div class="d-md-flex align-items-start">
                                        <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab"
                                            role="tablist" aria-orientation="vertical">
                                            <button class="nav-link active fw-bold" id="cashOnDeliveryTab-tab"
                                                data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button"
                                                role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true"
                                                wire:loading.attr="disabled">Cash
                                                on Delivery</button>

                                            <button class="nav-link fw-bold" id="onlinePayment-tab"
                                                data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button"
                                                role="tab" aria-controls="onlinePayment" aria-selected="false"
                                                wire:loading.attr="disabled">Online Payment</button>
                                        </div>
                                        <div class="tab-content col-md-9" id="v-pills-tabContent">
                                            <div class="tab-pane fade active show" id="cashOnDeliveryTab"
                                                role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                                <h6>Cash on Delivery Mode</h6>
                                                <hr />
                                                <button type="button" wire:loading.attr="disabled"
                                                    wire:click="codOrder" class="btn btn-primary">
                                                    <span wire:loading.remove wire:target="codOrder">
                                                        Place Order (Cash on Delivery)
                                                    </span>
                                                    <span wire:loading wire:target="codOrder">
                                                        Placeing Order...
                                                    </span>
                                                </button>

                                            </div>
                                            <div class="tab-pane fade" id="onlinePayment" role="tabpanel"
                                                aria-labelledby="onlinePayment-tab" tabindex="0">
                                                <h6>Online Payment Mode</h6>
                                                <hr />
                                                {{-- <button type="button"  wire:loading.attr="disabled" class="btn btn-warning">Pay Now (Online
                                                    Payment)</button> --}}
                                                <div>
                                                    <div id="paypal-button-container"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="card card-body shadow text-center p-md-5">
                    <h4>No items is available on cart to checkout</h4>
                    <a href="{{ url('/collections') }}" class="btn btn-warning">Shop Now</a>
                </div>
            @endif
        </div>
    </div>
</div>


@push('scripts')
    <script
        src="https://www.paypal.com/sdk/js?client-id=AfXO2KxWbqBTCkfjgm_1dyZYfhTgJ8KodBt3NR0_2UdbZcQ71q6qAKMFdNamak_Z9B2fbRCbeBCACYr-&currency=USD">
    </script>
    <script>
        window.paypal.Buttons({
            onClick() {
                // Show a validation error if the checkbox isn't checked
                if (!document.getElementById("name").value ||
                    !document.getElementById("phone_no").value ||
                    !document.getElementById("email").value ||
                    !document.getElementById("pincode").value ||
                    !document.getElementById("address").value
                ) {
                    window.dispatchEvent(new CustomEvent('validationForAll'));
                    return false;
                } else {
                    @this.set('name', document.getElementById("name").value),
                        @this.set('phone_no', document.getElementById("phone_no").value),
                        @this.set('email', document.getElementById("email").value),
                        @this.set('pincode', document.getElementById("pincode").value),
                        @this.set('address', document.getElementById("address").value)
                }
            },
            createOrder: function(data, actions) {
                // Create order logic
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '0.1' // Example amount
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Capture payment logic
                return actions.order.capture().then(function(details) {
                    // Payment successful, update UI
                  
                    const transaction = orderData.purchase_units[0].payment.captures[0];
                    alert(`Tranaction ${transaction.status}: ${transaction.id}\n\nSee console for more details`);
                    if(transaction.status == 'COMPLETED'){
                        window.dispatchEvent(new CustomEvent('paymentConfirmation',transaction.id));
                    }
                });
            }
        }).render('#paypal-button-container');
    </script>
@endpush
