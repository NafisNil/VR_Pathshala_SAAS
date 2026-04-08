
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Plan name</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Enter plan name"
                           value="{!!old('name',@$plan->name)!!}"
                          name="name" required
                        />
                
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Description</label>

                        <textarea name="description" class="form-control" id="description" rows="3">{!!old('description',@$plan->description)!!}</textarea>
                      </div>

                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Duration (in days)</label>
                        <input
                          type="number"
                          class="form-control"
                          placeholder="Enter plan duration"
                          value="{!!old('duration',@$plan->duration)!!}"
                          name="duration" required
                        />
                      </div>


                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Price</label>
                        <input
                          type="number" step="0.01"
                          class="form-control"
                          placeholder="Enter plan price"
                          value="{!!old('price',@$plan->price)!!}"
                          name="price" required
                        />
                        </div>


                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">SKU</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Enter plan SKU"
                          value="{!!old('sku',@$plan->sku)!!}"
                          name="sku" required
                        />
                        </div>

                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!--end::Footer-->
        