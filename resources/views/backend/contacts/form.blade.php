
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Phone</label>
                        <input

                          type="tel"
                          class="form-control"
                          placeholder="Enter phone"
                           value="{!!old('phone',@$contact->phone)!!}"
                          name="phone" required
                        />
                
                      </div>

                                          <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Enter email"
                           value="{!!old('email',@$contact->email)!!}"
                          name="email" required
                        />
                
                      </div>

                                          <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Address</label>
                        <textarea name="address" class="form-control" id="address" rows="3">{!!old('address',@$contact->address)!!}</textarea>
                
                      </div>


                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!--end::Footer-->
        