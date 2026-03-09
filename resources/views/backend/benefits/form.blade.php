
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Title</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Enter title"
                           value="{!!old('name',@$benefit->name)!!}"
                          name="name" required
                        />
                
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Description</label>

                        <textarea name="short_description" class="form-control" id="short_description" rows="3">{!!old('short_description',@$benefit->short_description)!!}</textarea>
                      </div>

                          <div class="mb-3 ">
                              <label for="Image" class="col-md-4 col-form-label text-md-right">(60 X 60)</label>
                              <div class="col-md-6">

                              <img id="showImage" src="{{(!empty($benefit->icon))?URL::to($benefit->icon):URL::to('image/no_image.png')}}"  style="widows: inherit; width:120px; height:120px; border:1px solid #042b3d" alt="">
                            </div>
                          </div>
                            <div class="mb-3">
                              <label for="exampleInputFile">Icon <span style="color:red" >*</span></label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" name="icon" class="custom-file-input"  id="image" value="{{ @$benefit->icon }}">
                                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>

                              </div>
                            </div>



                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!--end::Footer-->
        